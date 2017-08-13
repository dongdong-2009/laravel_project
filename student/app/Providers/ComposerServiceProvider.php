<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
//View Facades会调用Illuminate\Contracts\View\Factory contract 的底层实现
use Illuminate\Support\Facades\View;

/*
    新创建的服务提供者需要将这个 服务提供者 添加到配置文件 config/app.php 的 providers 数组中。
 */
class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //下面的视图welcome会调用App\Http\ViewComposers\ProfileComposer视图合成器中的composer方法
        //第一个参数是要将视图合成器附加到的视图名称，可以使用多个用,分割，可以使用通配符*给所有视图附加
        View::composer(
            'dir.hello', 'App\Http\ViewComposers\ProfileComposer'
        );

        // Using Closure based composers...
        View::composer('dashboard', function ($view) {
            //
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
