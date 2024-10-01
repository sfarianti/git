<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\SyncController;

class RunSyncController extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'run:RunSyncController';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run SyncController via Command';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Synchronization Process...');
        $response = app()->call(SyncController::class . '@sync');
        $this->info($response);
        $this->info('Synchronization Database executed successfully.');
    }
}
