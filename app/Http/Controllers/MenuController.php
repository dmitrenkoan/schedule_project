<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class MenuController extends Controller
{
    public static function getMenu($table, $curRoute, $group = NULL) {

        if(!empty($group)) {
            $arMenu = DB::table($table)->where('group', $group)->orderBy('sort')->get();
        }
        else {
            $arMenu = DB::table($table)->orderBy('sort')->get();
        }
        $arMenu->toArray();
        foreach($arMenu as  $key => $MenuItem) {
            if($MenuItem->link == $curRoute) {
                $arMenu[$key]->active = "Y";
            }
            else {
                $arMenu[$key]->active = "N";
            }
        }
        return $arMenu;
    }
}

