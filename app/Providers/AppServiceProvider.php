<?php

namespace App\Providers;

use App\Models\Skill;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \Carbon\Carbon::setLocale('zh');

        /**
         * 顶部菜单
         */
        view()->composer('layouts._header', function ($view) {
            // 这里的菜单是随意写的，可以根据实际情况去获取，比如从数据库中     $menus = ['主页','文章'];
            $view->with('skills', Skill::orderBy('sort','desc')->get());
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
