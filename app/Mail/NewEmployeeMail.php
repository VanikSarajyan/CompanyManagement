<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewEmployeeMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $employee;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($employee)
    {
        $this->employee = $employee;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.new-employee')->with([
            'first_name' => $this->employee->first_name,
            'last_name' => $this->employee->last_name,
        ]);
    }
}
