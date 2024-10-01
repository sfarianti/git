<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Paper;
use Illuminate\Support\Facades\Storage;

class EmailNotificationPaperFasil extends Mailable
{
    use Queueable, SerializesModels;

    public $paper;
    public $stage;
    public $innovation_title;
    public $team_name;
    public $leaderName;
    public $fasilName;
    public $inovasi_lokasi;

    public function __construct(Paper $paper, $stage, $innovation_title, $team_name, $leaderData, $fasilData, $inovasi_lokasi)
    {
        $this->paper = $paper;
        $this->stage = $stage;
        $this->innovation_title = $innovation_title;
        $this->team_name = $team_name;
        $this->leaderName = $leaderData->name;
        $this->fasilName = $fasilData->name;
        $this->inovasi_lokasi = $inovasi_lokasi;
    }

    public function build()
    {
        $attachmentPath = mb_substr(Paper::where('id', '=', $this->paper->id)->pluck('full_paper')[0], 3);
        $attachment = Storage::disk('public')->path($attachmentPath);

        // dd($attachment);

        if ($this->stage == 'full_paper') {
            return $this->view('emails.email_paper_notification')
                ->subject('Notification: Request Approval Full Paper')
                ->attach($attachment, [
                    'as' => 'Makalah Full Paper.pdf',
                    'mime' => 'application/pdf',
                ]);
        } else {
            throw new \Exception('Invalid status for sending email');
        }
    }
}
