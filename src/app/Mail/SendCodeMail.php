<?php

namespace SecurityTools\LaravelAccess\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

/**
 * @codeCoverageIgnore
 */
class SendCodeMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Code
     */
    public $code;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($code)
    {
        $this->code = $code;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('vendor.laravel-access.mail.send-access-code')
            ->subject(config('access.mail.subject'))
            ->with([
                'code' => $this->code,
            ]);
    }
}
