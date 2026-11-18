<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Periksa tiket yang melewati batas konfirmasi setiap menit
Schedule::command('tickets:close-expired-resolved')
    ->everyMinute();
