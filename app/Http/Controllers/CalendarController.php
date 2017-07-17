<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use App\ServicesModel;
use App\CalendarModel;
use App\Clients;
use DateTime;
use DateInterval;
use App\staffSalary;
use App\ServiceInventoryModel;
use App\StaffInventory;
use \stdClass;
use Validator;



class CalendarController extends Controller
{
    public function index(Request $request) {
        $arServicesID = array();
        $arJSEventsData = array();
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
        $arStaff = DB::table('staff')->where('salons_id' , $curUser['salon_id'])->orderBy('name')->get()->toArray();
        if(!empty($request->staff_id)) {
            $curStaffID = $request->staff_id;
        }
        else {
            $curStaffID = $arStaff[0]->id;
        }


        $arCalendarItems = DB::table('calendar')->where('staff_id', $curStaffID)->where('salons_id' , $curUser['salon_id'])->get()->toArray();

        foreach($arCalendarItems as $calItem) {
            $arServicesID[] = $calItem->services_id;
        }
        $arServices = ServicesModel::find($arServicesID);
        foreach($arServices as $key => $obService) {
            $arCalendarServices[$obService->id] = $obService;
        }
        foreach($arCalendarItems as $obElement) {
            if($obElement->status == 'CA') {
                continue;
            }
            $arButtonsHtml = $this->createHtmlButtons($obElement);



            $arJSItem = [
                'id' => $obElement->id,
                'title' => $arCalendarServices[$obElement->services_id]->name,
                'start' => $obElement->date_time_begin,
                'end' => $obElement->date_time_end,
                'backgroundColor' => $arButtonsHtml['backgroundColor'],
                'advHTML' => $arButtonsHtml['buttonsHtml'],
            ];

            $arJSEventsData[] = $arJSItem;
        }
        //dd($arJSEventsData);
        $arJSData['events_data'] = json_encode($arJSEventsData);

        return view('layouts.calendar', [
            'arMainMenu' => $arMainMenu,
            'pageParam' => 'calendar',
            'arStaff' => $arStaff,
            'arJSData' => $arJSData,
            'curStaffID' => $curStaffID,
        ]);
    }

    public function addForm(Request $request) {
        $curUser = Auth::user()->toArray();
        $arServices = DB::table('services')->where('staff_id', $request->curStaffID)->where('salon_id' , $curUser['salon_id'])->get()->toArray();
        $arStaff = DB::table('staff')->where('id', $request->curStaffID)->first();
        $arDateBegin = explode('T', $request->dateBegin);
        return view('forms.calendarFormAdd', [
            'arServices' => $arServices,
            'arStaff' => $arStaff,
            'arDateBegin' => $arDateBegin,
        ]);
    }

    public function addEvent(Request $request) {
        $obCalendar = new CalendarModel();
        $curUser = Auth::user()->toArray();
        if($this->validateCalendarData($request->all())) {
            if(!empty($request->client_name)) {
                $obClient = DB::table('clients')->where('name', $request->client_name)->first();
                $clientID = $obClient->id;
            }
            elseif (!empty($request->new_client_name)) {
                $obClients = new Clients();
                $obClients->name = $request->new_client_name;
                $obClients->phone = $request->new_client_phone;
                $obClients->salons_id = $curUser['salon_id'];
                if($obClients->save()) {
                    $clientID = $obClients->id;
                }
            }
            if(!empty($clientID)) {
                $obCalendar->clients_id = $clientID;
            }
            if(!empty($request->calendar_note)) {
                $obCalendar->note = $request->calendar_note;
            }
            if(!empty($request->date) && !empty($request->time_begin)) {
                $obDateBegin = new DateTime($request->date.' '.$request->time_begin);
                $obCalendar->date_time_begin = $obDateBegin->format("Y-m-d H:i:s");
                $obEndDateTime = $obDateBegin->add(new DateInterval('PT'.$request->service_duration.'M'));
                $obCalendar->date_time_end = $obEndDateTime->format("Y-m-d H:i:s");
            }
            if(!empty($request->service_name)) {
                $obService = DB::table('services')->where('name', $request->service_name)->where('staff_id', $request->staff_id)->first();
                $obCalendar->services_id = $obService->id;
            }
            $obCalendar->salons_id = $curUser['salon_id'];

            $obCalendar->staff_id = $request->staff_id;

            $obCalendar->status = 'WA';

            $obCalendar->save();

            $arButtonsHtml = $this->createHtmlButtons($obCalendar);

            $arResult['title'] = $obService->name;
            $arResult['start'] = $obCalendar->date_time_begin;
            $arResult['end'] = $obCalendar->date_time_end;
            $arResult['backgroundColor'] = $arButtonsHtml['backgroundColor'];
            $arResult['advHTML'] = $arButtonsHtml['buttonsHtml'];

            return json_encode($arResult);
        }
        else {
            return false;
        }

    }

    public function validateCalendarData($arData) {
        //dd($arData);
        $v = Validator::make($arData,
          array(
              "service_name" => "exists:services,name",
              "new_client_name" => "required_without:client_name",
              "client_name" => "required_without:new_client_name",
          )
        );
        if($v->fails()) {
            dd($v->errors());
            return false;
        }
        else {
            return true;
        }

    }

    public function confirmFormEvent($id) {
        $calendar = new CalendarModel();
        $obCalendar = $calendar->find($id);
        $obService = DB::table('services')->where('id', $obCalendar->services_id)->first();
        return view('forms.eventConfirm', [
            "obCalendar" => $obCalendar,
            "obService" => $obService,
        ]);
    }

    public function confirmEvent($id,Request $request) {
        $curUser = Auth::user()->toArray();
        $obCalendar = CalendarModel::find($id);
        $arResult = array();
        $continue = true;
        $obService = DB::table('services')->where('id', $obCalendar->services_id)->first();
        $obServiceInventory = DB::table('service_inventory')->where('service_id', $obService->id)->first();
        if(!empty($obServiceInventory)) {
            $obStaffInventory = DB::table('staff_inventory')->where('staff_id', $obCalendar->staff_id)->where('inventory_id',$obServiceInventory->inventary_id)->first();
            $continue = $this->staffInventoryReduce($obServiceInventory, $obStaffInventory);
        }
        if($continue) {
            $this->staffSalaryAdd($obService, $obCalendar, $curUser['salon_id']);
        }
        if ($continue ) {
            if ($request->discount_value > $obService->price) {
                $discount = $obService->price;
            }
            elseif($request->discount_value > 0) {
                $discount = $request->discount_value;
            }
            else {
                $discount = 0;
            }
            if($discount > 0) {
                $obCalendar->discount = $discount;
            }
            $obCalendar->status = "AC";
            $obCalendar->note = $request->discount_note;

            if($obCalendar->save()) {
                $htmlButtons = $this->createHtmlButtons($obCalendar);
                $arResult = [
                    'id' => strval($obCalendar->id),
                    'title' => $obService->name,
                    'start' => $obCalendar->date_time_begin,
                    'end' => $obCalendar->date_time_end,
                    'backgroundColor' => $htmlButtons['backgroundColor'],
                    'advHTML' => $htmlButtons['buttonsHtml'],
                ];
            }


        }
        //dd(json_encode($arResult));
        return (json_encode($arResult));


    }

    protected function staffSalaryAdd($obService, $obCalendar, $salonID) {
        $obSalary = new staffSalary();
        $obSalary->staff_id = $obService->staff_id;
        $obSalary->salons_id = $salonID;
        $obSalary->service_id = $obService->id;
        $obSalary->payment = $obService->worker_payment;
        $obSalary->service_date_begin = $obCalendar->date_time_begin;
        return $obSalary->save();
    }

    protected function staffInventoryReduce($obServiceInventory, $obStaffInventory) {
        $newObStaffInventory = StaffInventory::find($obStaffInventory->id);
        $newObStaffInventory->quantity = $obStaffInventory->quantity - $obServiceInventory->quantity;
        return $newObStaffInventory->save();
    }

    public function createHtmlButtons ($obElement) {
        switch($obElement->status) {
            case "WA":
                $result['backgroundColor'] = '#1eb2ca';
                $result['buttonsHtml'] = '<span class="event-buttons"><button class="accept" data-type="update" data-link="/calendar/event/confirm_form/'.$obElement->id.'">Подтвердить</button><button class="cancel" data-type="update" data-link="/calendar/event/cancel_form/'.$obElement->id.'">Отменить</button></span>';
                break;
            case "CA":
                $result['backgroundColor'] = '#da4545';
                $result['buttonsHtml'] = '<span class="event-buttons"><span class="status-canceled">Отменена</span></span>';
                break;
            case "AC":
                $result['backgroundColor'] = '#1db14a';
                $result['buttonsHtml'] = '<span class="event-buttons"><span class="status-accepted">Подтверждена</span></span>';

        }
        return $result;
    }

    public function cancelFormEvent($id) {
        $dateObject = new stdClass();
        $obCalendar = CalendarModel::find($id);
        $dateBegin = new DateTime($obCalendar->date_time_begin);
        $dateEnd = new DateTime($obCalendar->date_time_end);

        $dateObject->dateBegin = $dateBegin->format("d.m");
        $dateObject->timeBegin = $dateBegin->format("H:i");
        $dateObject->timeEnd = $dateEnd->format("H:i");
        $obService = DB::table('services')->where('id', $obCalendar->services_id)->first();
        return view('forms.eventCancel', [
            'obCalendar' => $obCalendar,
            'obService' => $obService,
            'dateObject' => $dateObject,
        ]);
    }

    public function cancelEvent($id, Request $request) {
        $obCalendar = CalendarModel::find($id);
        $obService = DB::table('services')->where('id', $obCalendar->services_id)->first();
        $obCalendar->note = $request->discount_note;
        $obCalendar->status = "CA";
        if($obCalendar->save()) {
            $htmlButtons = $this->createHtmlButtons($obCalendar);
            $arResult = [
                'id' => $obCalendar->id,
                'title' => $obService->name,
                'start' => $obCalendar->date_time_begin,
                'end' => $obCalendar->date_time_end,
                'backgroundColor' => $htmlButtons['backgroundColor'],
                'advHTML' => $htmlButtons['buttonsHtml'],
            ];
        }
        return (json_encode($arResult));
    }

}
