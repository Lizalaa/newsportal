<?php

namespace App\Mail;

use App\Admin;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AdminVerifyEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $admin;
    // Mail::to($user = App\Admin::first())->send(new App\Mail\AdminVerifyEmail($user));

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Admin $admin)
    {
        $this->admin = $admin;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('admin/email/verification_email');
    }
}
