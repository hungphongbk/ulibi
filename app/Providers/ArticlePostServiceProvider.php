<?php

namespace App\Providers;

use App\Helpers\Contracts\ArticlePost;
use Illuminate\Support\ServiceProvider;

class ArticlePostServiceProvider extends ServiceProvider
{

    protected $defer=true;

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('\App\Helpers\Contracts\IArticlePost', function(){
            return new ArticlePost();
        });
    }

    public function provides()
    {
        return ['\App\Helpers\Contracts\IArticlePost'];
    }
}
