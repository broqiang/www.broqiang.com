<?php

namespace App\Providers;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class PostProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->whetherFollow();

        /**
         * 博客侧边栏
         */
        view()->composer('posts._sidebar', function ($view) {
            // 这里的菜单是随意写的，可以根据实际情况去获取，比如从数据库中     $menus = ['主页','文章'];
            $view->with('archives', Post::archive());
        });

    }

    protected function whetherFollow()
    {
        // 自定义标签
        Blade::if ('whether_follow', function ($follows) {
            if (!Auth::check()) {
                return false;
            }
            foreach ($follows as $user) {
                if ($user->id == Auth::id()) {
                    return true;
                }
            }
            return false;
        });
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
