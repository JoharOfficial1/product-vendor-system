<?php

namespace App\Listeners;

use App\Events\ProductCreated;
use App\Models\User;
use App\Notifications\NewProductAlert;

class SendProductCreatedNotification
{
  public function handle(ProductCreated $event)
  {
    \Log::info('Listener fired', debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS));
    $admins = User::role('admin')->get();
    
    foreach ($admins as $admin) {
      $admin->notify(new NewProductAlert($event->product, $event->vendor));
    }
  }
}
