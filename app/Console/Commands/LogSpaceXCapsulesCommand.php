<?php

namespace App\Console\Commands;

use App\Classes\SpaceXAPI;
use App\Events\SpaceXAPISyncHasEndedEvent;
use App\Events\SpaceXAPISyncStartedEvent;
use App\Models\Capsule;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class LogSpaceXCapsulesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'spacex:start';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command syncs and logs SpaceX Capsules\' data';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        SpaceXAPISyncStartedEvent::dispatch();
        $plain_text_data = SpaceXAPI::fetch_all();
        $spacex_capsules = json_decode($plain_text_data);

        \App\Models\CapsuleMission::truncate();
        foreach ($spacex_capsules as $spacex_capsule) {
            // Update or Create Capsule
            $capsule = Capsule::updateOrCreate([
                'serial_code' => $spacex_capsule->capsule_serial
            ], [
                'serial_code' => $spacex_capsule->capsule_serial,
                'capsule_id' => $spacex_capsule->capsule_id,
                'status' => $spacex_capsule->status,
                'original_launch' => new \DateTime($spacex_capsule->original_launch),
                'original_launch_unix' => $spacex_capsule->original_launch_unix,
                'landings' => $spacex_capsule->landings,
                'type' => $spacex_capsule->type,
                'details' => $spacex_capsule->details,
                'reuse_count' => $spacex_capsule->reuse_count,
            ]);


            foreach ($spacex_capsule->missions as $mission) {
                $mission_model = \App\Models\Mission::updateOrCreate(
                    ['name' => $mission->name],
                    ['flight' => $mission->flight],
                );
                \App\Models\CapsuleMission::create([
                    'capsule_id' => $capsule->id,
                    'mission_id' => $mission_model->id
                ]);
            }

        }
        // Log to spacex_daily channel
        Log::channel('spacex_daily')->info($plain_text_data);
        SpaceXAPISyncHasEndedEvent::dispatch();

        return Command::SUCCESS;
    }
}
