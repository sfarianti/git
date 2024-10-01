<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Paper;
use Illuminate\Support\Facades\Storage;

class EmailNotificationBenefitGM extends Mailable
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
    public $inovasi_lokasi;

    public function __construct(Paper $paper, $status, $innovation_title, $team_name, $gmData, $benefitFinancial, $benefitPotential, $potensiReplikasi, $benefitNonFinancial, $leaderData, $inovasi_lokasi)
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
        $this->inovasi_lokasi = $inovasi_lokasi;
    }

    public function build()
    {
        // $attachment = Storage::path('public/' . $this->paper->file_review);
        // ambil attachment dari EmailApprovalBenefit
        $emailApprovalBenefit = new EmailApprovalBenefit(
            $this->paper,
            $this->status,
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
        $attachment = $emailApprovalBenefit->getAttachment();

        if ($this->status == 'accepted benefit by facilitator') {
            return $this->view('emails.email_benefit_notification')
                ->subject('Notification: Request Approval Benefit GM')
                ->attach($attachment, [
                    'as' => 'Berita Acara Benefit.pdf',
                    'mime' => 'application/pdf',
                ]);
        } else {
            throw new \Exception('Invalid status for sending email');
        }
    }
}
