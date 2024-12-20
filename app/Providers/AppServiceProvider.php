<?php

namespace App\Providers;

use App\Http\Resources\Branch\BranchResource;
use App\Http\Resources\Message\MessageResource;
use App\Http\Resources\Section\SectionResource;
use App\Http\Resources\Section\SectionWithBranchesResource;
use App\Services\Branch\BranchService;
use App\Services\Message\MessageService;
use App\Services\Section\SectionService;
use App\Services\Theme\ThemeService;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {

        $this->app->bind('section_service', SectionService::class);
        $this->app->bind('branch_service', BranchService::class);
        $this->app->bind(ThemeService::class, ThemeService::class);
        $this->app->bind(MessageService::class, MessageService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        SectionResource::withoutWrapping();
        SectionWithBranchesResource::withoutWrapping();
        BranchResource::withoutWrapping();
        MessageResource::withoutWrapping();
        Vite::prefetch(concurrency: 3);
    }
}
