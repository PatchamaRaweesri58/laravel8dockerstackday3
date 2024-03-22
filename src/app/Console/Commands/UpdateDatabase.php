<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\Test;

class UpdateDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:database';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
       // ดึงข้อมูลจากแหล่งอื่น ๆ (ตัวอย่างเช่นการใช้งาน API)
       $response = Http::get('http://localhost:8100/api/data');
       $data = $response->json();

       // ทำการอัปเดตข้อมูลในฐานข้อมูล
       foreach ($data as $item) {
           Test::updateOrCreate(['id' => $item['id']], $item);
       }

       $this->info('Database updated successfully!');
   }
    }

