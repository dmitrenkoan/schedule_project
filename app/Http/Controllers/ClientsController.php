<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Clients;
use Auth;
use DB;
use Illuminate\Support\Facades\App;
use DateTime;

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
    public function updateForm($id) {
        $curUser = Auth::user()->toArray();
        $client = DB::table('clients')->where('salons_id', $curUser['salon_id'])->where('id', $id)->first();
        //dd($client);
        $arBirtday = array(
            'month' => '',
            'day' => '',
        );
        if(!empty($client->birthday)) {
            $birtdayDate = new DateTime($client->birthday);
            $arBirtday['month'] = $birtdayDate->format('m');
            $arBirtday['day'] = $birtdayDate->format('d');
        }
        //dd($arBirtday);
        $arMonth = array(
            "01" => "Январь",
            "02" => "Февраль",
            "03" => "Март",
            "04" => "Апрель",
            "05" => "Май",
            "06" => "Июнь",
            "07" => "Июль",
            "08" => "Август",
            "09" => "Сентябрь",
            "10" => "Октябрь",
            "11" => "Ноябрь",
            "12" => "Декабрь"
        );
        return view(
            'forms.customersUpdate', [
                'client' => $client,
                'arBirtday' => $arBirtday,
                'arMonth' => $arMonth
            ]
        );
    }

    public function update($id, Request $request) {
        $obClient = Clients::find($id);
        $obClient->name = $request->name;
        $obClient->email = $request->email;
        $obClient->phone = $request->phone;
        $obClient->sex = $request->sex;
        $obClient->note	= $request->note;
        if(!empty($request->birthday_month) && !empty($request->birthday_day)) {
            $obClient->birthday = date('Y').'-'.$request->birthday_month.'-'.$request->birthday_day;
        }
        $obClient->save();

        return view('layouts.customersUpdate', [
            'obClient' => $obClient,
        ]);

    }

    public function delete($id) {
        $curUser = Auth::user()->toArray();
        if(DB::table('clients')->where('id', $id)->where('salons_id', $curUser['salon_id'])->delete()) {
            $result['success'] = "Y";
        }
        else {
            $result['success'] = "N";
        }
        return json_encode($result);
    }

}
