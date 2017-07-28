<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Route;
use Request;
use DB;

class Title extends Model
{
    public $timestamps = false;

    public static function getCurTitle() {
        $path = Request::path();
        $curUrl = $path == '/' ? $path : '/'.$path;
        $pageTitle = DB::table('titles')->where('link' , $curUrl)->first();
        $result = $pageTitle ? $pageTitle->title : "Салон красоты";
        return $result;
    }
}
