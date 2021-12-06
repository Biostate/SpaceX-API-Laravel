<?php

namespace Tests\Feature;

use App\Events\SpaceXAPISyncHasEndedEvent;
use App\Listeners\SendSpaceXAPISyncHasEndedListener;
use App\Models\User;
use App\Notifications\SpaceXAPISyncHasEndedNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class SpaceXCommandTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_command()
    {
        Event::fake();

        $this->artisan('spacex:start')->assertSuccessful();
        Event::assertDispatched(SpaceXAPISyncHasEndedEvent::class);
        Event::assertListening(
            SpaceXAPISyncHasEndedEvent::class,
            SendSpaceXAPISyncHasEndedListener::class
        );
        // TODO: Check Notification test
//        Notification::fake();
//        $user = User::admin()->first();
//        Notification::assertSentTo(
//            [$user], SpaceXAPISyncHasEndedNotification::class
//        );

    }
}
