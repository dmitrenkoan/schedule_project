<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class SearchController extends Controller
{
    public function index(Request $request) {
        $result = '';
        $arRequest = $request->toArray();
        $curUser = Auth::user()->toArray();
        switch($arRequest['searchTarget']) {
            case 'inventory':
                $arResult = DB::table('inventory')->where('salons_id', $curUser['salon_id'])->where('name', 'like' ,"%{$arRequest['searchRequest']}%")->get()->toArray();
                $arUnitTypes = DB::table('unit_type')->get()->toArray();
                foreach($arUnitTypes as $arUnitItem) {
                    $arUnits[$arUnitItem->id] = $arUnitItem;
                }
                if(!empty($arResult)) {
                    foreach($arResult as $arItem) {
                        $result .= "<li data-itemID='{$arItem->id}' data-unitType='{$arUnits[$arItem->unit_type_id]->short_name}' data-quantity='{$arItem->quantity}' data-row-number='{$arRequest["rowNumber"]}' onclick='showNewItemResult($(this))'>{$arItem->name}</li>";
                    }
                    $result = "<ul>".$result."</ul>";
                }
            break;
            case 'services':
                $arResult = DB::table('services')->where('salon_id', $curUser['salon_id'])->where('staff_id' , $request->staff_id)->where('name', 'like' ,"%{$arRequest['searchRequest']}%")->get()->toArray();
                if(!empty($arResult)) {
                    foreach($arResult as $arItem) {
                        $result .= "<li data-itemID='{$arItem->id}' data-duration='{$arItem->time_duration}' onclick='showNewServiceResult($(this))'>{$arItem->name}</li>";
                    }
                    $result = "<ul>".$result."</ul>";
                }
            break;
            case 'clients':
                $arResult = DB::table('clients')->where('name', 'like' ,"%{$arRequest['searchRequest']}%")->orWhere('phone', 'like' ,"%{$arRequest['searchRequest']}%")->get()->toArray();
                if(!empty($arResult)) {
                    foreach($arResult as $arItem) {
                        $result .= "<li data-itemID='{$arItem->id}' onclick='showNewClientsResult($(this))'>{$arItem->name} [{$arItem->phone}]</li>";
                    }
                    $result = "<ul>".$result."</ul>";
                }
            break;
            default:
                break;
        }
        if(empty($result)) {
            $result = '<span class="noResult">Не найдено ни одного совпадения, проверьте правильность ввода данных</span>';
        }
        return $result;

    }
}
