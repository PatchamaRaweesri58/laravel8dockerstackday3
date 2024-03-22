<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use App\Models\Test;

class ImportJsonData extends Command
{
  
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:json';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import JSON data into the database';


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

        set_time_limit(180);

        $json = Storage::disk('local')->get('manuf.json');

        $data = json_decode($json, true);

       
        foreach ($data['data'] as $macPrefix => $vendor) {
            Test::updateOrCreate([
                'mac_prefix' => $macPrefix,
                'vendor' => $vendor
            ]);
        }
        $this->info('Data imported successfully.');
    }
}
