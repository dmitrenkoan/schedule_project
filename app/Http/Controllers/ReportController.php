<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class ReportController extends Controller
{
    public function index(Request $request) {
        $pageTitle = \App\Title::getCurTitle();
        $result = array();
        $arInput = $request->all();
        $curUser = Auth::user()->toArray();
        $curRoute = '/'.$request->path();

        $arMainMenu = MenuController::getMenu('menu_main', $curRoute);
        $arSubMenu = MenuController::getMenu('menu_sub', $curRoute, 'reports');



        $arStaff = DB::table('staff')->where('salons_id', $curUser['salon_id'])->orderBy('name', 'asc')->get()->toArray();
        $arInventory = DB::table('inventory')->where('salons_id', $curUser['salon_id'])->orderBy('name', 'asc')->get()->toArray();

        if(!empty($request->date_begin && $request->date_end)) {
            if($request->inventory_action == 'issued') {

                $arInventoryTransfer = DB::table('inventory_transfer')
                    /*->join('inventory', 'inventory.id' , '=' , 'inventory_transfer.inventory_id')
                    ->join('unit_type', 'unit_type.id' , '=' , 'inventory.unit_type_id')
                    ->join('staff', 'staff.id' , '=' , 'inventory_transfer.staff_id')*/
                    ->where('salons_id', $curUser['salon_id'])
                ;

                $arInventoryTransfer = $arInventoryTransfer->where('inventory_transfer.created_at', '>=',$request->date_begin)
                    ->where('inventory_transfer.created_at', '<=',$request->date_end);
                if(!empty($request->staff_id)) {
                    $arInventoryTransfer = $arInventoryTransfer->where('inventory_transfer.staff_id', $request->staff_id);
                }
                if(!empty($request->inventory_id)){
                    $arInventoryTransfer = $arInventoryTransfer->where('inventory_transfer.inventory_id', $request->inventory_id);
                }

                $result = $arInventoryTransfer
                    //->select('inventory_transfer.*', 'inventory.name as inventory_name', 'unit_type.short_name as unit_type', 'staff.name as staff_name')
                    ->get()
                    ->toArray();
            }
            elseif($request->inventory_action == 'spent') {
                $arInventoryTransfer = DB::table('staff_inventory_transfer')
                    /*->join('inventory' , 'inventory.id', '=', 'staff_inventory_transfer.inventory_id')
                    ->join('staff', 'staff.id' , '=' , 'staff_inventory_transfer.staff_id')
                    ->join('unit_type', 'unit_type.id' , '=' , 'inventory.unit_type_id')*/
                    ->where('salons_id', $curUser['salon_id'])
                    ;

                $arInventoryTransfer = $arInventoryTransfer
                    ->where('staff_inventory_transfer.created_at', '>=',$request->date_begin)
                    ->where('staff_inventory_transfer.created_at', '<=',$request->date_end);

                if(!empty($request->staff_id)) {
                    $arInventoryTransfer = $arInventoryTransfer->where('staff_inventory_transfer.staff_id', $request->staff_id);
                }
                if(!empty($request->inventory_id)){
                    $arInventoryTransfer = $arInventoryTransfer->where('staff_inventory_transfer.inventory_id', $request->inventory_id);
                }
                $result = $arInventoryTransfer
                    //->select('staff_inventory_transfer.*', 'inventory.name as inventory_name', 'unit_type.short_name as unit_type', 'staff.name as staff_name')
                    ->get()
                    ->toArray();
            }


        }


        return view('layouts.reports', [
            'arMainMenu' => $arMainMenu,
            'arSubMenu' => $arSubMenu,
            'arStaff' => $arStaff,
            'arInventory' => $arInventory,
            'totalQuantity' => 0,
            'pageParam' => 'reports',
            'arInput' => $arInput,
            'arResult' => $result,
            'pageTitle' => $pageTitle,
        ]);
    }

    public function staff(Request $request) {
        $pageTitle = \App\Title::getCurTitle();
        $result = array();
        $arInput = $request->all();
        $curUser = Auth::user()->toArray();
        $curRoute = '/'.$request->path();

        $arMainMenu = MenuController::getMenu('menu_main', $curRoute);

        $arSubMenu = MenuController::getMenu('menu_sub', $curRoute, 'reports');

        $arStaff = DB::table('staff')->where('salons_id', $curUser['salon_id'])->orderBy('name', 'asc')->get()->toArray();

        if(!empty($request->date_begin && $request->date_end)) {
            $arStaffReport = DB::table('calendar')
                //->join('clients', 'clients.id' , '=' , 'calendar.clients_id')
                //->join('services', 'services.id' , '=' , 'calendar.services_id')
                //->join('staff', 'staff.id' , '=' , 'calendar.staff_id')
                ->join('calendar_event_log', 'calendar_event_log.calendar_id', '=', 'calendar.id')
            ;
            $arStaffReport = $arStaffReport->where('calendar.date_time_begin', '>=',$request->date_begin)
                ->where('calendar.date_time_end', '<=',$request->date_end);
            if(!empty($request->staff_id)) {
                $arStaffReport = $arStaffReport->where('calendar.staff_id', $request->staff_id);
            }
            if(!empty($request->status)) {
                $arStaffReport = $arStaffReport->where('calendar.status', $request->status);
            }


            //$result = $arStaffReport->select('calendar.*', 'clients.name as client_name', 'services.*', 'staff.name as staff_name', 'calendar_event_log.service_price as base_service_price', 'calendar_event_log.service_name as  base_service_name', 'calendar_event_log.expenses as expenses', 'calendar_event_log.worker_payment as base_worker_payment')->get()->toArray();
            $result = $arStaffReport->select('calendar.*', 'calendar_event_log.service_price as base_service_price', 'calendar_event_log.service_name as  base_service_name', 'calendar_event_log.expenses as expenses', 'calendar_event_log.worker_payment as base_worker_payment', 'calendar_event_log.staff_name as staff_name', 'calendar_event_log.client_name as client_name')->get()->toArray();
            //dd($result);
        }
        $arStatusName = array(
            "WA" => "Ожидается",
            "AC" => "Принят",
            "CA" => "Отменен",
        );
        $arPaymentName = [
            'card' => 'Картой',
            'cash' => 'Наличными',
            'bonus' => 'Бонусами'
        ];


        return view('layouts.reportsStaff', [
            'arMainMenu' => $arMainMenu,
            'arSubMenu' => $arSubMenu,
            'arStaff' => $arStaff,
            'totalWorkerPayment' => 0,
            'totalSum' => 0,
            'totalDiscount' => 0,
            'totalExpenses' => 0,
            'profit' => 0,
            'totalProfit' => 0,
            'pageParam' => 'reports',
            'arInput' => $arInput,
            'arResult' => $result,
            'arStatusName' => $arStatusName,
            'pageTitle' => $pageTitle,
            'arPaymentName' => $arPaymentName

        ]);
    }

}
