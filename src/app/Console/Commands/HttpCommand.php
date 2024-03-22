<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
class HttpCommand extends Command
{
    protected $signature = 'http:get {url}';
    protected $description = 'Make an HTTP GET request to a specified URL';

    public function handle()
    {
        $url = $this->argument('url');

        $response = Http::get($url);

        $this->info($response->body());
    }
}