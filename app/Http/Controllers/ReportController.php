<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class ReportController extends Controller
{
    public function index(Request $request) {
        $result = array();
        $arInput = $request->all();
        $curUser = Auth::user()->toArray();
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
        $arSubMenu = DB::table('menu_sub')->where('group', "reports")->orderBy('sort')->get()->toArray();
        foreach($arSubMenu as  $key => $MenuItem) {
            if($MenuItem->link == $curRoute) {
                $arSubMenu[$key]->active = "Y";
            }
            else {
                $arSubMenu[$key]->active = "N";
            }
        }

        $arStaff = DB::table('staff')->where('salons_id', $curUser['salon_id'])->orderBy('name', 'asc')->get()->toArray();
        $arInventory = DB::table('inventory')->where('salons_id', $curUser['salon_id'])->orderBy('name', 'asc')->get()->toArray();

        if(!empty($request->date_begin && $request->date_end)) {
            $arInventoryTransfer = DB::table('inventory_transfer')
                ->join('inventory', 'inventory.id' , '=' , 'inventory_transfer.inventory_id')
                ->join('unit_type', 'unit_type.id' , '=' , 'inventory.unit_type_id')
                ->join('staff', 'staff.id' , '=' , 'inventory_transfer.staff_id')
            ;
            $arInventoryTransfer = $arInventoryTransfer->where('inventory_transfer.created_at', '>=',$request->date_begin)
                ->where('inventory_transfer.created_at', '<=',$request->date_end);
            if(!empty($request->staff_id)) {
                $arInventoryTransfer = $arInventoryTransfer->where('inventory_transfer.staff_id', $request->staff_id);
            }
            if(!empty($request->inventory_id)){
                $arInventoryTransfer = $arInventoryTransfer->where('inventory_transfer.inventory_id', $request->inventory_id);
            }


            $result = $arInventoryTransfer->select('inventory_transfer.*', 'inventory.name as inventory_name', 'unit_type.short_name as unit_type', 'staff.name as staff_name')->get()->toArray();
        }


        return view('layouts.reports', [
            'arMainMenu' => $arMainMenu,
            'arSubMenu' => $arSubMenu,
            'arStaff' => $arStaff,
            'arInventory' => $arInventory,
            'totalQuantity' => 0,
            'pageParam' => 'reports',
            'arInput' => $arInput,
            'arResult' => $result
        ]);
    }

    public function staff(Request $request) {
        $result = array();
        $arInput = $request->all();
        $curUser = Auth::user()->toArray();
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
        $arSubMenu = DB::table('menu_sub')->where('group', "reports")->orderBy('sort')->get()->toArray();
        foreach($arSubMenu as  $key => $MenuItem) {
            if($MenuItem->link == $curRoute) {
                $arSubMenu[$key]->active = "Y";
            }
            else {
                $arSubMenu[$key]->active = "N";
            }
        }

        $arStaff = DB::table('staff')->where('salons_id', $curUser['salon_id'])->orderBy('name', 'asc')->get()->toArray();

        if(!empty($request->date_begin && $request->date_end)) {
            $arStaffReport = DB::table('calendar')
                ->join('clients', 'clients.id' , '=' , 'calendar.clients_id')
                ->join('services', 'services.id' , '=' , 'calendar.services_id')
                ->join('staff', 'staff.id' , '=' , 'calendar.staff_id')
            ;
            $arStaffReport = $arStaffReport->where('calendar.date_time_begin', '>=',$request->date_begin)
                ->where('calendar.date_time_end', '<=',$request->date_end);
            if(!empty($request->staff_id)) {
                $arStaffReport = $arStaffReport->where('calendar.staff_id', $request->staff_id);
            }
            if(!empty($request->status)) {
                $arStaffReport = $arStaffReport->where('calendar.status', $request->status);
            }


            $result = $arStaffReport->select('calendar.*', 'clients.name as client_name', 'services.*', 'staff.name as staff_name')->get()->toArray();
            //dd($result);
        }
        $arStatusName = array(
            "WA" => "Ожидается",
            "AC" => "Принят",
            "CA" => "Отменен",
        );


        return view('layouts.reportsStaff', [
            'arMainMenu' => $arMainMenu,
            'arSubMenu' => $arSubMenu,
            'arStaff' => $arStaff,
            'totalWorkerPayment' => 0,
            'totalSum' => 0,
            'totalDiscount' => 0,
            'pageParam' => 'reports',
            'arInput' => $arInput,
            'arResult' => $result,
            'arStatusName' => $arStatusName
        ]);
    }

}
