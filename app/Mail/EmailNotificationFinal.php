<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Paper;
use Illuminate\Support\Facades\Storage;

class EmailNotificationFinal extends Mailable
{
    use Queueable, SerializesModels;

    public $paper;
    public $status;
    public $innovation_title;
    public $team_name;
    public $gmName;
    public $benefitFinancial;
    public $benefitPotential;
    public $potensiReplikasi;
    public $benefitNonFinancial;
    public $leaderName;
    public $adminName;
    public $inovasi_lokasi;

    public function __construct(Paper $paper, $status, $innovation_title, $team_name, $gmData, $benefitFinancial, $benefitPotential, $potensiReplikasi, $benefitNonFinancial, $leaderData, $adminData, $inovasi_lokasi)
    {
        $this->paper = $paper;
        $this->status = $status;
        $this->innovation_title = $innovation_title;
        $this->team_name = $team_name;
        $this->gmName = $gmData->name;
        $this->benefitFinancial = $benefitFinancial;
        $this->benefitPotential = $benefitPotential;
        $this->potensiReplikasi = $potensiReplikasi;
        $this->benefitNonFinancial = $benefitNonFinancial;
        $this->leaderName = $leaderData->name;
        $this->adminName = $adminData->name;
        $this->inovasi_lokasi = $inovasi_lokasi;
    }

    public function build()
    {
        // $attachment1 = Storage::path(mb_substr(Paper::where('id', '=', $this->paper->id)->pluck('full_paper')[0], 3));
        //$attachment2 = Storage::path('public/' . $this->paper->file_review);
        $attachmentPath = mb_substr(Paper::where('id', '=', $this->paper->id)->pluck('full_paper')[0], 3);
        $attachment1 = Storage::disk('public')->path($attachmentPath);

        // Ambil attachment yang sama dengan yang dikirim saat status accepted benefit by general manager
        $emailApprovalBenefit = new EmailApprovalBenefit(
            $this->paper,
            'accepted benefit by general manager',
            $this->innovation_title,
            $this->team_name,
            (object)['name' => $this->gmName],
            $this->benefitFinancial,
            $this->benefitPotential,
            $this->potensiReplikasi,
            $this->benefitNonFinancial,
            (object)['name' => $this->leaderName],
            $this->inovasi_lokasi
        );
        $attachment2 = $emailApprovalBenefit->getAttachment();

        if ($this->status == 'accepted benefit by general manager') {
            return $this->view('emails.email_final_notification')
                ->subject('Notification: Request Approval Final Admin')
                ->attach($attachment1, [
                    'as' => 'Makalah Full Paper.pdf',
                    'mime' => 'application/pdf',
                ])
                ->attach($attachment2, [
                    'as' => 'Berita Acara Benefit.pdf',
                    'mime' => 'application/pdf',
                ]);
        } else {
            throw new \Exception('Invalid status for sending email');
        }
    }
}
