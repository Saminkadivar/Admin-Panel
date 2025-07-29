<?php
namespace App\Notifications;


use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class ProductChangedNotification extends Notification
{
    use Queueable;

    protected $product;
    protected $action;

    public function __construct($product, $action)
    {
        $this->product = $product;
        $this->action = $action; // 'created' or 'updated'
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'product_id' => $this->product->id,
            'name' => $this->product->p_name,
            'message' => "Product '{$this->product->p_name}' was {$this->action}.",
            'action' => $this->action
        ];
    }
}
