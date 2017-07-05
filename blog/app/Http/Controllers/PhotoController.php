<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/*
    php artisan make:controller PhotoController --resource
    创建资源控制器
 */
class PhotoController extends Controller
{
    /**
     * 
     */
    public function liuyan(){
        return [
            'Controller.method' => __METHOD__ ,
            'Controller.function' => __FUNCTION__,
        ];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return [
            'Controller.method' => __METHOD__ ,
            'Controller.function' => __FUNCTION__,
            'Controller.class' => __CLASS__,
        ];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return [
            'Controller.method' => __METHOD__ ,
            'Controller.function' => __FUNCTION__,
        ];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return [
            'Controller.method' => __METHOD__ ,
            'Controller.function' => __FUNCTION__,
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request,依赖注入实例request，使用了laravel的服务器容器注入
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {
        return [
            'Controller.method' => __METHOD__ ,
            'Controller.function' => __FUNCTION__,
            'id' => $id,
            'request[\'age\']' => $request->input('age'),
        ];
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return [
            'Controller.method' => __METHOD__ ,
            'Controller.function' => __FUNCTION__,
        ];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return [
            'Controller.method' => __METHOD__ ,
            'Controller.function' => __FUNCTION__,
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return [
            'Controller.method' => __METHOD__ ,
            'Controller.function' => __FUNCTION__,
        ];
    }
}
