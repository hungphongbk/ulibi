<?php

namespace App\Providers;

use Auth;
use HTML;
use Illuminate\Support\ServiceProvider;

class MacroServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        HTML::macro(/**
         * @param \App\Ulibier $ulibier
         * @return string
         */
            "profileEditable", function ($ulibier, $type=0) {
            $html = "";
            if ($ulibier!=null && Auth::user()!=null && $ulibier->username == Auth::user()->username)
                $html = <<<HTML
<span class="replace-text-inline edit-information" href="#editInformation" data-tab="$type">
    <a href=""><i class="fa fa-pencil"></i></a>
</span>
HTML;
            return $html;
        });

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
