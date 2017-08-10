<?php

namespace App\Http\Middleware;

use Closure;

class Activity
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
        //前置中间件
        if(time() < strtotime('2017-08-11')){
            return redirect('student/activity0');
        }

        //正常将请求扔给闭包
        return $next($request);

        //后置中间件
       /* $res = $next($request);
        //var_dump($res);
        echo "<p>hello</p>";
        return $res;*/
    }
}
