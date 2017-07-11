<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class ScheduleController extends Controller
{
    public function index(Request $request) {
        $curRoute = '/'.$request->path();
        $arMainMenu = DB::table('menu_main')->orderBy('sort')->get()->toArray();
        foreach($arMainMenu as  $key => $MenuItem) {
            if($MenuItem->link == $curRoute) {
                $arMainMenu[$key]->active = "Y";
            }
            else {
                $arMainMenu[$key]->active = "N";
            }
        }
        $arSubMenu = DB::table('menu_sub')->where('group', "staff")->orderBy('sort')->get()->toArray();
        foreach($arSubMenu as  $key => $MenuItem) {
            if($MenuItem->link == $curRoute) {
                $arSubMenu[$key]->active = "Y";
            }
            else {
                $arSubMenu[$key]->active = "N";
            }
        }
        return view('layouts.schedule', [
            'arSubMenu' => $arSubMenu,
            'arMainMenu' => $arMainMenu,
        ]);
    }

}
