<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Trail;

class updateTrailStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:trailstatus';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Updates trail status and persists to DB';

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
        Trail::saveTrailStatus();
    }
}
