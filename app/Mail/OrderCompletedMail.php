<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderCompletedMail extends Mailable
{
    use Queueable, SerializesModels;

    private Order $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $url = $this->order->project->domain_url
            ? "https://{$this->order->project->domain_url}"
            : "https://{$this->order->project->subdomain_url}.websiter.com";

        return $this->markdown('mail.order-completed', [
            'order'    => $this->order->load('project'),
            'shipping' => $this->order->shippingMethod->price ?? 0,
            'url'      => $url,
        ]);
    }
}
