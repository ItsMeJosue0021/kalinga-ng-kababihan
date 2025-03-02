<?php

namespace App\Providers;

use App\Repositories\MemberRepository;
use Illuminate\Support\ServiceProvider;
use App\Repositories\EmergencyContactRepository;
use App\Repositories\Interfaces\MemberRepositoryInterface;
use App\Repositories\Interfaces\EmergencyContactRepositoryInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(MemberRepositoryInterface::class, MemberRepository::class);
        $this->app->bind(EmergencyContactRepositoryInterface::class, EmergencyContactRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
