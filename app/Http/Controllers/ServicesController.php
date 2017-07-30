<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\ServicesModel;
use DB;
use App\ServiceInventoryModel;


class ServicesController extends Controller
{
    public function index(Request $request) {
        $arStaffList = array();
        $pageTitle = \App\Title::getCurTitle();
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

        $obServices = new ServicesModel();
        $curUser = Auth::user()->toArray();
        $arStaff = DB::table('staff')->where('salons_id', $curUser['salon_id'])->get()->toArray();
        foreach($arStaff as $staffItem) {
            $arStaffList[$staffItem->id] = $staffItem;
        }
        $arServices = $obServices->where('salon_id' , $curUser['salon_id'])->paginate(20);

        return view('layouts.services', [
            'arServices' => $arServices,
            'arStaff' => $arStaffList,
            'arMainMenu' => $arMainMenu,
            'pageTitle' => $pageTitle
        ]);
    }

    public function add(Request $request) {
        $obServices = new ServicesModel();
        $curUser = Auth::user()->toArray();
        $obServices->name = $request->name;
        $obServices->time_duration = $request->time_duration;
        $obServices->price = $request->price;
        $obServices->worker_payment = $request->worker_payment;
        $obServices->staff_id = $request->staff_id;
        $obServices->salon_id = $curUser['salon_id'];
        $obServices->save();
        if(!empty($obServices->id) && is_array($request->data_inventory)) {
            foreach($request->data_inventory as $arInventoryItem) {
                $obInventory = DB::table('inventory')->where('name', $arInventoryItem['inventory_name'])->where('salons_id', $curUser['salon_id'])->first();
                if($arInventoryItem['inventory_quantity'] > 0 && $obInventory->id > 0) {
                    $newServiceInventory = new ServiceInventoryModel();
                    $newServiceInventory->service_id = $obServices->id;
                    $newServiceInventory->inventary_id = $obInventory->id;
                    $newServiceInventory->quantity = $arInventoryItem['inventory_quantity'];
                    $newServiceInventory->save();
                }

            }
        }
        $arStaff = DB::table('staff')->where('id', $obServices->staff_id)->get()->toArray();
        return view('layouts.serviceAdd', [
            'obServices' => $obServices,
            'arStaff' => $arStaff
        ]);
    }

    public function update_form($id) {
        $curUser = Auth::user()->toArray();
        $arStaff = DB::table('staff')->where('salons_id', $curUser['salon_id'])->get()->toArray();
        foreach($arStaff as $staffItem) {
            $arStaffList[$staffItem->id] = $staffItem;
        }
        $obService = DB::table('services')->where('salon_id', $curUser['salon_id'])->where('id' , $id)->first();
        $arServiceInventory = DB::table('service_inventory')
            ->where('service_inventory.service_id', $obService->id)
            ->join('inventory', 'inventory.id' , '=' , 'service_inventory.inventary_id')
            ->select('service_inventory.*', 'inventory.name', 'inventory.unit_type_id')
            ->get()
            ->toArray();
        if(!empty($arServiceInventory)) {
            $inventoryRowsCount = count($arServiceInventory);
        }
        else{
            $inventoryRowsCount = 1;
        }
        $obUnitType = DB::table('unit_type')->get()->toArray();
        foreach($obUnitType as $UnitItem) {
            $arUnitType[$UnitItem->id] = $UnitItem;
        }

        $arTimePeriod = [
            "5" => "5мин",
            "10" => "10мин",
            "15" => "15мин",
            "20" => "20мин",
            "25" => "25мин",
            "30" => "30мин",
            "35" => "35мин",
            "40" => "40мин",
            "45" => "45мин",
            "50" => "50мин",
            "55" => "55мин",
            "60" => "1ч",
            "65" => "1ч 5мин",
            "70" => "1ч 10мин",
            "75" => "1ч 15мин",
            "80" => "1ч 20мин",
            "85" => "1ч 25мин",
            "90" => "1ч 30мин",
            "95" => "1ч 35мин",
            "100" => "1ч 40мин",
            "105" => "1ч 45мин",
            "110" => "1ч 50мин",
            "115" => "1ч 55мин",
            "120" => "2ч",
            "135" => "2ч 15мин",
            "150" => "2ч 30мин",
            "165" => "2ч 45мин",
            "180" => "3ч",
            "195" => "3ч 15мин",
            "210" => "3ч 30мин",
            "225" => "3ч 45мин",
            "240" => "4ч",
            "270" => "4ч 30мин",
            "300" => "5ч",
            "330" => "5ч 30мин",
            "360" => "6ч",
            "390" => "6ч 30мин",
            "420" => "7ч",
            "450" => "7ч 30мин",
            "480" => "8ч",
            "540" => "9ч",
            "600" => "10ч",
            "660" => "11ч",
            "720" => "12ч",
            ];
        return view('forms.serviceUpdate' , [
            'arStaff' => $arStaff,
            'obService' => $obService,
            'arServiceInventory' => $arServiceInventory,
            'arTimePeriod' => $arTimePeriod,
            'arUnitType' => $arUnitType,
            'inventoryRowsCount' => $inventoryRowsCount,
        ]);
    }

    public function update($id, Request $request) {
        $obServices = ServicesModel::where('id' , $id)->first();
        $curUser = Auth::user()->toArray();
        $obServices->name = $request->name;
        $obServices->time_duration = $request->time_duration;
        $obServices->price = $request->price;
        $obServices->worker_payment = $request->worker_payment;
        $obServices->staff_id = $request->staff_id;
        $obServices->salon_id = $curUser['salon_id'];
        $obServices->save();
        if(!empty($obServices->id) && is_array($request->data_inventory)) {
            DB::table('service_inventory')->where('service_id', '=', $id)->delete();
            foreach($request->data_inventory as $arInventoryItem) {
                $obInventory = DB::table('inventory')->where('name', $arInventoryItem['inventory_name'])->where('salons_id', $curUser['salon_id'])->first();
                if($arInventoryItem['inventory_quantity'] > 0 && $obInventory->id > 0) {
                    $newServiceInventory = new ServiceInventoryModel();
                    $newServiceInventory->service_id = $obServices->id;
                    $newServiceInventory->inventary_id = $obInventory->id;
                    $newServiceInventory->quantity = $arInventoryItem['inventory_quantity'];
                    $newServiceInventory->save();
                }

            }
        }
        $obStaff = DB::table('staff')->where('id', $obServices->staff_id)->first();
        return view('layouts.serviceUpdate' , [
            'obServices' => $obServices,
            'obStaff' => $obStaff,
        ]);
    }

    public function delete($id) {
        $curUser = Auth::user()->toArray();
        if(DB::table('services')->where('id', $id)->where('salon_id', $curUser['salon_id'])->delete()) {
            $result['success'] = "Y";
        }
        else {
            $result['success'] = "N";
        }
        return json_encode($result);
    }
}
