<?php

namespace App\Console\Commands;

use App\Http\Controllers\CityController;
use Illuminate\Console\Command;

class FetchCountriesTask extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'data:import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Parses the website from setup in config, and saves information about cities in the databasesites of it that is setup in the config, and saves ';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $cityController = new CityController();
        $cityController->fetch();
    }
}
