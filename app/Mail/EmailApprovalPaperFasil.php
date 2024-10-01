<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Paper;
use Illuminate\Support\Facades\Storage;

class EmailApprovalPaperFasil extends Mailable
{
    use Queueable, SerializesModels;

    public $paper;
    public $status;
    public $innovation_title;
    public $team_name;
    public $leaderName;
    public $inovasi_lokasi;

    public function __construct(Paper $paper, $status, $innovation_title, $team_name, $leaderData, $inovasi_lokasi)
    {
        $this->paper = $paper;
        $this->status = $status;
        $this->innovation_title = $innovation_title;
        $this->team_name = $team_name;
        $this->leaderName = $leaderData->name;
        $this->inovasi_lokasi = $inovasi_lokasi;
    }

    public function build()
    {
        $attachmentPath = mb_substr(Paper::where('id', '=', $this->paper->id)->pluck('full_paper')[0], 3);
        $attachment = Storage::disk('public')->path($attachmentPath);

        if ($this->status == 'accepted paper by facilitator') {
            return $this->view('emails.email_paper_approval')
                ->subject('Notification: Paper Accepted')
                ->attach($attachment, [
                    'as' => 'Makalah Full Paper.pdf',
                    'mime' => 'application/pdf',
                ]);
        } elseif ($this->status == 'rejected paper by facilitator') {
            return $this->view('emails.email_paper_approval')
                ->subject('Notification: Paper Rejected')
                ->attach($attachment, [
                    'as' => 'Makalah Full Paper.pdf',
                    'mime' => 'application/pdf',
                ]);
        }
    }
}
