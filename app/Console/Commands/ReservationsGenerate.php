<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class ReservationsGenerate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reservations:generate {number}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate {number} reservations.';

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
        if ($this->argument('number')) {
            for ($i = 0; $i < $this->argument('number'); $i++) {
                Artisan::call('db:seed', ['--class' => 'ReservationSeeder']);
            }

            $this->info(sprintf('Generated %d reservation(s).', $this->argument('number')));
        }

        return 0;
    }
}
