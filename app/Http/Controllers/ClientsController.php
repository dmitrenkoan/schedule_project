<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Clients;
use Auth;
use DB;
class ClientsController extends Controller
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
        $obClients = new Clients();
        $curUser = Auth::user()->toArray();
        $arClients = $obClients->where('salons_id' , $curUser['salon_id'])->get()->toArray();
        return view('layouts.customers' , [
            'arResult' => $arClients,
            'arMainMenu' => $arMainMenu,
        ]);
    }

    public function add(Request $request) {
        $obClient = new Clients();
        $curUser = Auth::user()->toArray();
        if(!empty($request->name)) {
            $obClient->name = $request->name;
            $obClient->email = $request->email;
            $obClient->phone = $request->phone;
            $obClient->sex = $request->sex;
            $obClient->note	= $request->note;
            if(!empty($request->birthday_month) && !empty($request->birthday_day)) {
                $obClient->birthday = date('Y').'-'.$request->birthday_month.'-'.$request->birthday_day;
            }
            $obClient->salons_id	= $curUser['salon_id'];
            $obClient->save();
        }
        return view('layouts.clientNew', [
            'obClient' => $obClient
        ]);
    }
}
