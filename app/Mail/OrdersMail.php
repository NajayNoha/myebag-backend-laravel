<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrdersMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(
        public $user,
        public $order_items,
        // public $details,
        // public $payment_detail
        )
    {
        //
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    // public function envelope()
    // {
    //     return new Envelope(
    //         subject: 'Orders Tracking',
    //     );
    // }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    // public function content()
    // {
    //     return new Content(
    //         view: 'emails.orders.OrdersStatus',
    //         with: [
    //             'customerName'=> $this->user->lastname . ' '.$this->user->firstname ,
    //             'orderStatus'=> $this->details->order_status->name,
    //             'orderItems'=> $this->order_items,
    //             'viewOrderUrl'=> 'http://localhost:8080/orders'
    //             // ''=>,
    //             // ''=>,
    //             // ''=>,
    //         ]
    //     );
    // }

    /**
     * Get the message content definition.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.orders.OrdersStatus');
    }
    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    // public function attachments()
    // {
    //     return [];
    // }
}
