<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\User;
use App\Models\Event;
use App\Models\Paper;
use App\Models\PvtMember;
use App\Models\PvtEventTeam;
use Illuminate\Http\Request;
use App\Mail\RevisionNotification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use App\Models\pvtAssesmentTeamJudge;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
    
        // Memuat tim beserta paper dan event
        $teamIds = PvtMember::where('employee_id', $user->employee_id)->pluck('team_id');
    
        // Memuat event aktif yang sedang diikuti
        $activeEvents = Event::whereHas('pvtEventTeams', function ($query) use ($teamIds) {
            $query->whereIn('team_id', $teamIds);
        })->where('status', 'active')->get();
    
        // Check if user is an active judge and retrieve event details
        $isActiveJudge = DB::table('judges')
            ->join('events', 'judges.event_id', '=', 'events.id')
            ->where('judges.employee_id', $user->employee_id)
            ->where('judges.status', 'active')
            ->where('events.status', 'finish')
            ->exists();
    
        $judgeEvents = DB::table('judges')
            ->join('events', 'judges.event_id', '=', 'events.id')
            ->leftJoin('certificates', 'events.id', '=', 'certificates.event_id')
            ->select(
                'events.id as event_id',
                'events.event_name',
                'events.date_end as event_end',
                'events.year',
                'certificates.template_path'
            )
            ->where('judges.employee_id', $user->employee_id)
            ->where('judges.status', 'active')
            ->where('events.status', 'finish')
            ->distinct('events.id')
            ->get();

        if (Session::get('data_query') != NULL) {
            $data_query = Session::get('data_query');
            Session::forget('data_query');
            $manager = User::where('employee_id', $data_query[0]->manager_id)->first();
    
            $_arr = [
                'name' => $data_query[0]->name,
                'manager' => $manager->name,
                'email' => $data_query[0]->email,
                'position' => $data_query[0]->position_title,
                'company' => $data_query[0]->company_name,
                'directorate' => $data_query[0]->directorate_name,
                'department' => $data_query[0]->department_name,
                'unit' => $data_query[0]->unit_name,
                'section' => $data_query[0]->section_name,
                'jobLevel' => $data_query[0]->job_level,
                'userId' => $data_query[0]->employee_id,
                'profilePicture' => $data_query[0]->photo_profile
            ];
        } else {
            $manager = User::where('employee_id', auth()->user()->manager_id)->first();
    
            $_arr = [
                'name' => auth()->user()->name,
                'manager' => $manager->name,
                'email' => auth()->user()->email,
                'position' => auth()->user()->position_title,
                'company' => auth()->user()->company_name,
                'directorate' => auth()->user()->directorate_name,
                'department' => auth()->user()->department_name,
                'unit' => auth()->user()->unit_name,
                'section' => auth()->user()->section_name,
                'jobLevel' => auth()->user()->job_level,
                'userId' => auth()->user()->employee_id,
                'profilePicture' => auth()->user()->photo_profile
            ];
        }
    
        return view('auth.user.profile.index', compact('user', 'activeEvents', 'teamIds', 'isActiveJudge', 'judgeEvents', 'judgeEvents'))->with($_arr);
    }

    public function showPaperDetail($teamId)
    {
        $team = Team::with(['paper', 'pvtEventTeams'])->find($teamId);
        return view('auth.user.profile.paper-detail', compact('team'));
    }
    
    public function updatePasswordUser($employeeId, Request $request)
    {
        $validated = $request->validate([
            'password' => 'required|string|max:255',
        ]);
    
        $user = User::where('employee_id', $employeeId)->first();
    
        if (!$user) {
            return redirect()->back()->with('error', 'User tidak ditemukan.');
        }
    
        $user->update([
            'password' => Hash::make($validated['password']),
        ]);
    
        return redirect()->back()->with('success', 'Password berhasil diperbarui.');
    }
    
    public function updateProfilePicture($employeeId, Request $request)
    {
        $validated = $request->validate([
            'photo_profile' => 'required|file|mimes:jpg,png,jpeg|max:5120'
        ]);
    
        $user = User::where('employee_id', $employeeId)->first();
    
        if (!$user) {
            return redirect()->back()->with('error', 'User tidak ditemukan.');
        }
    
        if ($request->hasFile('photo_profile')) {
            try {
                // Hapus file lama jika ada
                if ($user->photo_profile && Storage::exists($user->photo_profile)) {
                    Storage::delete($user->photo_profile);
                }
    
                $extension = strtolower($request->file('photo_profile')->getClientOriginalExtension());
                $randomNumber = mt_rand(1000, 9999);
                $baseName = $user->employee_id . '_' . $randomNumber;
                $fileName = $baseName . '.' . $extension;
    
                $relativePath = "photo_profile/" . str_replace(' ', '_', $user->name) . '/' . $fileName;

                $request->file('photo_profile')->storeAs("public", $relativePath);
                
                $user->update([
                    'photo_profile' => $relativePath
                ]);

    
                return redirect()->back()->with('success', 'Photo Profile berhasil diperbarui.');
            } catch (\Exception $e) {
                return back()->with('error', 'Gagal mengunggah file. Error: ' . $e->getMessage());
            }
        }
    
        return redirect()->back()->with('error', 'Tidak ada file yang diunggah.');
    }

    public function revision($teamId, Request $request)
    {
        $team = Team::with(['paper', 'pvtEventTeams'])->find($teamId);
        $event_team_id = $request->pvt_event_team_id;
        $eventTeam = PvtEventTeam::find($event_team_id);
        $paper = Paper::find($team->paper->id);
        $eventType = Event::whereHas('pvtEventTeams', function ($query) use ($teamId) {
            $query->where('team_id', $teamId);
        })->first()->type;
        $stage = "full_paper";
        $paper->updateAndHistory([
            $stage => "f: " . $request->file('file_stage')->storeAs(
                'internal/' . $eventType . '/' . $team->team_name,
                $stage . "." . $request->file('file_stage')->getClientOriginalExtension(),
                'public'
            ),
        ]);

        // **Mengambil email admin berdasarkan company_code**
        $adminEmails = User::where('role', 'Admin')
            ->where('company_code', $team->company_code)
            ->pluck('email')
            ->toArray();

        // **Mengambil email juri terkait tim ini**
        $pvtAssememtTeamJudges = pvtAssesmentTeamJudge::where('event_team_id', $event_team_id)
            ->where('stage', $eventTeam->sofi->last_stage)
            ->with(['judge' => function ($query) {
                $query->with(['userEmployeeId' => function ($query) {
                    $query->select('employee_id', 'email'); // Select only employee_id and email
                }]);
            }])
            ->get();

        // Extract emails and remove duplicates
        $judgeEmails = $pvtAssememtTeamJudges->pluck('judge.userEmployeeId.email')->filter()->unique()->toArray();

        // **Menggabungkan email admin dan juri**
        $recipients = array_merge($adminEmails, $judgeEmails);

        // **Mengirim email ke semua penerima**
        Mail::to($recipients)->send(new RevisionNotification($team));
        return redirect()->route('profile.showPaperDetail', ['teamId' => $teamId])->with('success', 'Makalah berhasil diperbarui.');
    }
}