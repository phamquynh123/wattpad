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
        $this->app->bind("App\\Repositories\\User\\UserRepositoryInterface","App\\Repositories\\User\\UserRepository");
        $this->app->bind("App\\Repositories\\StoryAuthor\\StoryAuthorRepositoryInterface","App\\Repositories\\StoryAuthor\\StoryAuthorRepository");
        $this->app->bind("App\\Repositories\\Permission\\PermissionRepositoryInterface","App\\Repositories\\Permission\\PermissionRepository");
        $this->app->bind("App\\Repositories\\Role\\RoleRepositoryInterface","App\\Repositories\\Role\\RoleRepository");
        $this->app->bind("App\\Repositories\\PermissionRole\\PermissionRoleRepositoryInterface","App\\Repositories\\PermissionRole\\PermissionRoleRepository");
        $this->app->bind("App\\Repositories\\CategoryStory\\CategoryStoryRepositoryInterface","App\\Repositories\\CategoryStory\\CategoryStoryRepository");
        $this->app->bind("App\\Repositories\\Vote\\VoteRepositoryInterface","App\\Repositories\\Vote\\VoteRepository");

        $repositories = [ 
            'NewsRepositoryInterface' => 'NewsRepository',
        ];
        foreach ($repositories as $key => $val){
            $this->app->bind("App\\Repositories\\Contracts\\$key", "App\\Repositories\\Eloquents\\$val");
        }
    }
}
