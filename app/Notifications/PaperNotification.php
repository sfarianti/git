<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PaperNotification extends Notification
{
    // use queue adalah untuk menentukan apakah notifikasi harus dijalankan
    // secara berurutan atau tidak di latar belakang
    use Queueable;

    // membuat konstruktor dengan parameter $title, message, url
    // title digunakan untuk menyimpan nama dari notifikasi
    // message digunakan untuk menyimpan isi dari notifikasi
    // url digunakan untuk menyimpan url dari notifikasi, jika notifikasi ditekan
    // akan menuju rute url ini
    public $title;
    public $message;
    public $url;

    public function __construct( $title, $message, $url)
    {
        $this->title = $title;
        $this->message = $message;
        $this->url = $url;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    // membuat fungsi via untuk menentukan channel notifikasi
    // di sini menggunakan database untuk menampilkan notifikasi pada tabel notifications
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    // membuat fungsi toArray untuk menentukan isi dari notifikasi
    public function toArray($notifiable)
    {
        return [
            'title' => $this->title,
            'message' => $this->message,
            'url' => $this->url,
        ];
    }
}
