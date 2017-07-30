<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\StaffModel;
use App\InventaryModel;
use App\StaffInventory;
use App\InventoryTransfer;
use Auth;
use URL;
use DB;
use Illuminate\Routing\Route;

class StaffController extends Controller
{
    public function index(Request $request) {
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


        $arSubMenu = DB::table('menu_sub')->where('group', "staff")->orderBy('sort')->get()->toArray();
        foreach($arSubMenu as  $key => $MenuItem) {
            if($MenuItem->link == $curRoute) {
                $arSubMenu[$key]->active = "Y";
            }
            else {
                $arSubMenu[$key]->active = "N";
            }
        }
        $obStaff = new StaffModel();
        $curUser = Auth::user()->toArray();
        $arStaff = $obStaff->where('salons_id' , $curUser['salon_id'])->paginate(20);
        return view('layouts.employees' , [
           'arStaff' => $arStaff,
           'arSubMenu' => $arSubMenu,
           'arMainMenu' => $arMainMenu,
           'pageTitle' => $pageTitle,
        ]);
    }

    public function add(Request $request) {
        $curUser = Auth::user()->toArray();
        $obStaff = new StaffModel();
        $obStaff->name = $request->name;
        $obStaff->phone = $request->phone;
        $obStaff->salons_id = $curUser['salon_id'];
        $obStaff->save();
        return view('layouts.employeesAdd', [
           'obStaff' => $obStaff
        ]);

    }

    public function update_form($id) {
        $obStaff = new StaffModel();
        $arStaff = $obStaff->where('id' , $id)->get()->toArray();
        return view('forms.staffFormUpdate' , [
            'arStaff' => $arStaff,
        ]);
    }

    public function update($id, Request $request) {
        $curUser = Auth::user()->toArray();
        $obStaff = StaffModel::where('id' , '=' , $id)->first();
        $obStaff->name = $request->name;
        $obStaff->phone = $request->phone;
        $obStaff->id = $id;
        $obStaff->salons_id = $curUser['salon_id'];
        $obStaff->save();

        return view('layouts.employeesUpdate' , [
            'obStaff' => $obStaff,
        ]);

    }

    public function InventoryAdd(Request $request) {
        $curUser = Auth::user()->toArray();
        $obStore = InventaryModel::where('salons_id', $curUser['salon_id'])->where('id', $request->item_id)->first();
        //dd($obStore->id);
        if($obStore->id > 0 && ($obStore->quantity >= $request->quantity)) {
            $obStaffInventory = StaffInventory::where('staff_id' , '=' , $request->staff_id)->where('inventory_id' , '=' , $obStore->id)->first();
            //dd($obStaffInventory);
            if(empty($obStaffInventory->id)) {
                $obStaffInventory = new StaffInventory();
                $obStaffInventory->staff_id = $request->staff_id;
                $obStaffInventory->inventory_id = $obStore->id;
            }
            $obStaffInventory->quantity = $obStaffInventory->quantity + $request->quantity;

            if($obStaffInventory->save()) {
                $obStore->quantity = $obStore->quantity - $request->quantity;
                if($obStore->save()){
                    $curUser = Auth::user()->toArray();
                    $obTransferHistory = new InventoryTransfer();
                    $obTransferHistory->quantity = $request->quantity;
                    $obTransferHistory->staff_id = $request->staff_id;
                    $obTransferHistory->inventory_id = $obStore->id;
                    $obTransferHistory->user_id = $curUser['id'];
                    $obTransferHistory->quantity_left = $obStore->quantity;
                    $obTransferHistory->save();
                }



                $arUnitType = DB::table('unit_type')->where('id' , $obStore->unit_type_id)->get()->toArray();
            }
        }
        else{
            echo 'error';
        }
        return view('layouts.productUpdate', [
            'result' => $obStore,
            'arUnitType' => $arUnitType
        ]);
        //dd($request->toArray());
    }

    public function InventoryShow($id , Request $request) {
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
        $obStaff = StaffModel::where('id' , $id)->first();
        $arStaffInventory = DB::table('staff_inventory')
            ->where('staff_inventory.staff_id' , $id)
            ->join('inventory' , 'staff_inventory.inventory_id', '=' , 'inventory.id')
            ->join('unit_type' , 'inventory.unit_type_id', '=' , 'unit_type.id')
            ->select('staff_inventory.*', 'inventory.name as inventory_name' , 'unit_type.short_name')
            ->get()->toArray();
        return view('layouts.employeesInventory' , [
            'arMainMenu' => $arMainMenu,
            'obStaff' => $obStaff,
            'arStaffInventory' => $arStaffInventory
        ]);
    }
    public function delete($id) {
        $curUser = Auth::user()->toArray();
        if(DB::table('staff')->where('id', $id)->where('salons_id', $curUser['salon_id'])->delete()) {
            $result['success'] = "Y";
        }
        else {
            $result['success'] = "N";
        }
        return json_encode($result);
    }
}
