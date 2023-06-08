<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrderStatusMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(
        public $data
        )
    {
        $this->data = $data;
    }

    public function build()
    {
        return $this->view('emails.orders.orderStatus')->with(
            [
                'data' => $this->data,
                'user'=> $this->data->user,
                'color'=> $this->data->order_status->background_color,
                'status'=> $this->data->order_status->name,
                'number'=> $this->data->id
            ]
        );
    }
}
