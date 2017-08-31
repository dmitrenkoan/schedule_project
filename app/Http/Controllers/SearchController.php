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
                $arResult = DB::table('inventory')
                    ->where('salons_id', $curUser['salon_id'])
                    //->where('staff_inventory.staff_id', $request->staff_id)
                    ->where('name', 'like' ,"%{$arRequest['searchRequest']}%")
                    //->join('staff_inventory', 'staff_inventory.inventory_id', '=', 'inventory.id')
                    ->get()
                    ->toArray();
                $arUnitTypes = DB::table('unit_type')->get()->toArray();
                foreach($arUnitTypes as $arUnitItem) {
                    $arUnits[$arUnitItem->id] = $arUnitItem;
                }
                if(!empty($arResult)) {
                    foreach($arResult as $arItem) {
                        $result .= "<li data-itemID='{$arItem->id}' data-unitType='{$arUnits[$arItem->unit_type_id]->short_name}' data-quantity='{$arItem->quantity}' data-row-number='{$arRequest["rowNumber"]}' onclick='showNewItemResult($(this))'>{$arItem->name}</li>";
                    }

                }
            break;
            case 'services':
                $arResult = DB::table('services')->where('salon_id', $curUser['salon_id'])
                    ->join('service_staff' , 'service_staff.service_id' , '=', 'services.id')
                    ->where('service_staff.staff_id', '=' ,$request->staff_id)
                    ->where('services.name', 'like' ,"%{$arRequest['searchRequest']}%")->paginate(10);
                if(!empty($arResult)) {
                    foreach($arResult as $arItem) {
                        $result .= "<li data-itemID='{$arItem->id}' data-duration='{$arItem->time_duration}' onclick='showNewServiceResult($(this))'>{$arItem->name}</li>";
                    }

                }
            break;
            case 'clients':
                $arResult = DB::table('clients')->where('name', 'like' ,"%{$arRequest['searchRequest']}%")->orWhere('phone', 'like' ,"%{$arRequest['searchRequest']}%")->get()->toArray();
                if(!empty($arResult)) {
                    foreach($arResult as $arItem) {
                        $result .= "<li data-itemID='{$arItem->id}' onclick='showNewClientsResult($(this))'>{$arItem->name} [{$arItem->phone}]</li>";
                    }

                }
            break;
            default:
                break;
        }

        if(empty($result)) {
            if($arRequest['searchTarget'] == 'inventory') {
                $result = '<span class="noResult">У заданого сотрудника не найдено указаного инвернтаря. Проверьте правильность выбора сотрудника, либо правильность названия инвентаря</span>';
            }
            else {
                $result = '<span class="noResult">Не найдено ни одного совпадения, проверьте правильность ввода данных</span>';
            }

        }
        $result = "<ul>".$result."</ul>";
        return $result;

    }
}
