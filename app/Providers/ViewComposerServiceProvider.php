<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // die;
        View::composer(['admin.category', 'user.detailStory', 'user.viewChapter', 'user.category'], 'App\Http\ViewComposers\CategoryViewComposer');
        view()->composer('*', 'App\Http\ViewComposers\LanguageViewComposer');
        view()->composer('admin.permission', 'App\Http\ViewComposers\LanguageViewComposer');
        view()->composer('admin.returnFile.selectRole', 'App\Http\ViewComposers\RoleViewComposer');
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // $this->app->singleton(ViewComposer::class);
    }
}
