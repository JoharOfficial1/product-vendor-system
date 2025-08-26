<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewProductAlert extends Notification implements ShouldQueue
{
    use Queueable;
    protected $product, $vendor;

    public function __construct($product, $vendor)
    {
        $this->product = $product;
        $this->vendor = $vendor;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('New Product Created')
            ->line('A new product has been added by vendor "' . $this->vendor->name . '". Your decision is required')
            ->line('Product: ' . $this->product->name)
            ->action('Review Products', url('/admin/products'));
    }
}
