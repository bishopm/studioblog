<?php

namespace Bishopm\Studioblog\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Console\Scheduling\Schedule;

class ScheduleServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->app->booted(function () {
            $schedule = $this->app->make(Schedule::class);
            // $schedule->command('skeleton:monthlyemails')->monthlyOn(1, '07:15');
        });
    }

    public function register()
    {
    }
}
