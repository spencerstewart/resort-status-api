<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Chair;
use App\Resort;

class updateChairStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:chairstatus';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Updates chair status and persists to DB';

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
     * @return mixed
     */
    public function handle()
    {
        $resorts = Resort::all();
        foreach ($resorts as $resort) {
            echo $resort->api_endpoint;
            Chair::saveChairStatus($resort->api_endpoint, $resort->id);
        }
    }
}
