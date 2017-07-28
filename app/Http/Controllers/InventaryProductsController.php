<?php

namespace App\Http\Controllers;

use Auth;
use DB;
use App\InventaryModel;
use Illuminate\Http\Request;


class InventaryProductsController extends Controller
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

        $curUser = Auth::user()->toArray();

        $arUnitTypesDB = DB::table('unit_type')->get()->toArray();

        foreach($arUnitTypesDB as $obUnit) {
            $arUnit = (array) $obUnit;
            $arUnitResult[$arUnit['id']] = $arUnit;
        }
        $dbInventory = new InventaryModel();
        $arResult['inventory'] = $dbInventory ->where('salons_id', $curUser['salon_id'])
            ->paginate(20);


        $arResult['unit_types'] = $arUnitResult;



        //dd($arStaffList);

        return view('layouts.products', [
            'page_param' => 'productsList',
            'arResult' => $arResult,
            'arMainMenu' => $arMainMenu,
            'pageTitle' => $pageTitle
        ]);
    }

    public function add(Request $request) {
        $curUser = Auth::user()->toArray();
        $inventary = new InventaryModel();
        $inventary->name = $request->name;
        $inventary->unit_price = $request->unit_price;
        $inventary->quantity = $request->quantity;
        $inventary->salons_id = $curUser['salon_id'];
        $inventary->unit_type_id = $request->unit_type_id;
        $inventary->save();
        $arUnitType = DB::table('unit_type')->where('id' , $inventary->unit_type_id)->get()->toArray();

        return view('layouts.product_new', [
            'result' => $inventary,
            'arUnitType' => $arUnitType
        ]);
    }

    public function update($id , Request $request) {
        $curUser = Auth::user()->toArray();
        $inventary = InventaryModel::where('id' , '=' , $id)->first();
        $inventary->id = $id;
        $inventary->name = $request->name;
        $inventary->unit_price = $request->unit_price;
        $inventary->quantity = $request->quantity;
        $inventary->salons_id = $curUser['salon_id'];
        $inventary->unit_type_id = $request->unit_type_id;
        $inventary->save();
        $arUnitType = DB::table('unit_type')->where('id' , $inventary->unit_type_id)->get()->toArray();
        return view('layouts.productUpdate' , [
            'result' => $inventary,
            'arUnitType' => $arUnitType,
        ]);
    }

    public function update_form($id) {
        $obInventary = new InventaryModel();
        $curUser = Auth::user()->toArray();
        $arStaff = DB::table('staff')->where('salons_id', $curUser['salon_id'])->get()->toArray();
        $arInventary = $obInventary->where('id' , $id)->get()->toArray();
        $arUnitType = DB::table('unit_type')->get()->toArray();
        //dd($arUnitType);
        return view('layouts.updateForm' , [
            'arInventary' => $arInventary,
            'arStaff' => $arStaff,
            'arUnitType' => $arUnitType,
        ]);
    }

    public function issue_form($id , Request $request) {
        $curUser = Auth::user()->toArray();
        $arStaff = DB::table('staff')->where('salons_id', $curUser['salon_id'])->get()->toArray();
        $obInventory = DB::table('inventory')->where('id', $id)->first();
        $obUnitType = DB::table('unit_type')->where('id' , $obInventory->unit_type_id)->first();
        return view('forms.issueForm' , [
            'arStaff' => $arStaff,
            'obInventory' => $obInventory,
            'obUnitType' => $obUnitType,
        ]);
    }
}
