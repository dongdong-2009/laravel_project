<?php

namespace App\Http\Middleware;

use Closure;

class HaosiMiddle
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {  
        if($request->input('age') <= 10){
            //此处不能return 数组
            return redirect('/Haosi');
        }
        return $next($request);
    }

    /**
     * 终止中间件,执行完路由会执行该中间件
     * @param  [type] $request  [description]
     * @param  [type] $response [description]
     * @return [type]           [description]
     */
    public function terminate($request, $response){
        //echo "--------------------------------------";
    }
}
