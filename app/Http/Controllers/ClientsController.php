<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Clients;
use Auth;
use DB;
use Illuminate\Support\Facades\App;
use DateTime;
use App\Title;
use App\ClientBonus;
use App\BonusEventLog;


class ClientsController extends Controller
{
    public function index(Request $request) {
        $pageTitle = \App\Title::getCurTitle();
        //dd(config('debug'));
        $curRoute = '/'.$request->path();
        $arMainMenu = MenuController::getMenu('menu_main', $curRoute);
        $obClients = new Clients();
        $curUser = Auth::user()->toArray();
        $arClients = $obClients->where('salons_id' , $curUser['salon_id'])->paginate(20);
        //dd($arClients);
        return view('layouts.customers' , [
            'arResult' => $arClients,
            'arMainMenu' => $arMainMenu,
            'pageTitle' => $pageTitle
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

        $client = Clients::with('bonus')->where('salons_id', $curUser['salon_id'])->where('id', $id)->first();
        //$client = DB::table('clients')->with('bonus')->where('salons_id', $curUser['salon_id'])->where('id', $id)->first();
        //dd($client->bonus);
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
        if(!empty($request->add_bonus_value) || !empty($request->reduce_bonus_value)) {
            if(!empty($request->add_bonus_value)) {
                $value = $request->add_bonus_value;
                $action = 'add';
                $comment = $request->add_bonus_value_comment;
            } else {
                $value = $request->reduce_bonus_value;
                $action = 'reduce';
                $comment = $request->reduce_bonus_value_comment;
            }

            $this->reduceBonus($id, $value, $action, $comment);

        }


        $obClient->save();

        return view('layouts.customersUpdate', [
            'obClient' => $obClient,
        ]);

    }

    public function reduceBonus($id, $quantity, $action = 'reduce', $comment = '') {
        $bonusEvent = new BonusEventLog();
        $clientBonus = ClientBonus::where('clients_id', $id)->first();
        if(empty($clientBonus->id)) {
            $clientBonus = new ClientBonus();
        }
        $bonusEvent->clients_id = $id;
        $clientBonus->clients_id = $id;
        if($action == 'add') {
            $clientBonus->balance += $quantity;
            $bonusEvent->quantity = $quantity;
            $bonusEvent->action = 'inc';
            $bonusEvent->balance = $clientBonus->balance;
            $bonusEvent->comment = $comment;

        } elseif($action = 'reduce') {
            if($clientBonus->balance - $quantity < 0) {
                $quantity = $clientBonus->balance;
            }
            $clientBonus->balance -= $quantity;
            $bonusEvent->quantity = $quantity;
            $bonusEvent->action = 'desc';
            $bonusEvent->balance = $clientBonus->balance;
            $bonusEvent->comment = $comment;
        }

        $bonusEvent->save();
        $clientBonus->save();
        return $clientBonus->save();
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
