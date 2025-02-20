<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Http\Services\Contact\ContactAdminService;
use App\Http\Services\Review\ReviewAdminService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(ContactAdminService $contactAdminService, ReviewAdminService $reviewAdminService): void
    {
        $reviewAdminCount = $reviewAdminService->getReviewAdminCount();
        $messageCount = $contactAdminService->getMessageCount();
        View::composer('*', function ($view) use ($contactAdminService, $messageCount, $reviewAdminService, $reviewAdminCount){
            $view->with('messageCount', $messageCount);
            $view->with('reviewAdminCount', $reviewAdminCount);
        });
    }
}
