<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Schema::defaultStringLength(191);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind("App\\Repositories\\Category\\CategoryRepositoryInterface","App\\Repositories\\Category\\CategoryRepository");
        $this->app->bind("App\\Repositories\\Language\\LanguageRepositoryInterface","App\\Repositories\\Language\\LanguageRepository");
        $this->app->bind("App\\Repositories\\Story\\StoryRepositoryInterface","App\\Repositories\\Story\\StoryRepository");
        $this->app->bind("App\\Repositories\\Chapter\\ChapterRepositoryInterface","App\\Repositories\\Chapter\\ChapterRepository");
        $this->app->bind("App\\Repositories\\Comment\\CommentRepositoryInterface","App\\Repositories\\Comment\\CommentRepository");
    }
}
