<?php

namespace App\Providers;

use App\Http\Resources\Branch\BranchResource;
use App\Http\Resources\Message\MessageResource;
use App\Http\Resources\Section\SectionResource;
use App\Http\Resources\Section\SectionWithBranchesResource;
use App\Http\Resources\User\UserResource;
use App\Services\Branch\BranchService;
use App\Services\Message\MessageService;
use App\Services\Notification\NotificationService;
use App\Services\Section\SectionService;
use App\Services\Theme\ThemeService;
use App\Services\User\UserService;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        if ($this->app->environment('local') && class_exists(\Laravel\Telescope\TelescopeServiceProvider::class)) {
            $this->app->register(\Laravel\Telescope\TelescopeServiceProvider::class);
            $this->app->register(TelescopeServiceProvider::class);
        }

        $this->app->bind('section_service', SectionService::class);
        $this->app->bind('branch_service', BranchService::class);
        $this->app->bind(ThemeService::class, ThemeService::class);
        $this->app->bind(MessageService::class, MessageService::class);
        $this->app->bind(UserService::class, UserService::class);
        $this->app->bind(NotificationService::class, NotificationService::class);
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
        UserResource::withoutWrapping();
        Vite::prefetch(concurrency: 3);
    }
}
