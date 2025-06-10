<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Job;
use App\Policies\JobPolicy;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Job::class => JobPolicy::class,
    ];

    public function boot(): void
    {
        //
    }
}
