<?php

namespace App\Listeners;

use App\Events\SpaceXAPISyncHasEndedEvent;
use App\Models\User;
use App\Notifications\SpaceXAPISyncHasEndedNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class SendSpaceXAPISyncHasEndedListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\SpaceXAPISyncHasEndedEvent  $event
     * @return void
     */
    public function handle(SpaceXAPISyncHasEndedEvent $event)
    {
        $user = User::admin()->firstOrFail();
        $user->notify(new SpaceXAPISyncHasEndedNotification());
    }
}
