@extends('template')

@section('pageTitle', $pageTitle)

@section('content')
<section class="main-content">
    <div class="js-loading-image" id="loading_image" style="display: none">
        <i class="icon-refresh icon-spin"></i>
        Loading...
    </div>
    <div  class="row" >
        <div class="second-lvl-nav-container margin-bottom">
            @include('blocks.topTabulator')



        </div>
    </div>
    <div  class="row" style="padding: 0px 20px">
        <div class="components-Calendar-components-Toolbar-Toolbar___self___2bY9- padding-left">
            <form method="GET" id="filter_form">
                <div class="components-Calendar-components-Toolbar-Toolbar___column___DULhp">
                    <div class="components-Calendar-components-Toolbar-Toolbar___row___1XRXG">
                        <div class="components-Form-FormField___self___10VZD">
                            <span class="components-Select-Select___self___13CJj">

                                <input type="text" required class="components-Input-Input___input___1fuFB datetimepicker" placeholder="Начало периода" name="date_begin" value="{{ isset($arInput['date_begin']) ? $arInput['date_begin']: ''}}">
                                                                </span>
                        </div>

                        <div class="components-Form-FormField___self___10VZD">
                            <span class="components-Select-Select___self___13CJj">

                                <input type="text" required class="components-Input-Input___input___1fuFB datetimepicker" name="date_end" placeholder="Окончание периода" value="{{isset($arInput['date_end']) ? $arInput['date_end'] : ''}}">
                                                                </span>
                        </div>

                        <div class="components-Form-FormField___self___10VZD">
                            <span class="components-Select-Select___self___13CJj">

                                <select name="staff_id" class="components-Select-Select___select___1ytQc" >
                                    <option value="" >Все сотрудники</option>
                                    @if(!empty($arStaff))
                                        @foreach($arStaff as $staffItem)
                                            <option value="{{$staffItem->id}}" @if(!empty($arInput['staff_id']) && $staffItem->id == $arInput['staff_id']) selected @endif>{{$staffItem->name}}</option>
                                        @endforeach
                                    @endif
                                </select>

                                                                    <span class="components-Icon-Icon___self___2zpSX components-Icon-Icon___self-span___yjOO0 components-Icon-Icon___color-gray___eeS_g components-Select-Select___icon-right___1gDJ1"><svg version="1.1" xmlns:x="&amp;ns_extend;" xmlns:i="&amp;ns_ai;" xmlns:graph="&amp;ns_graphs;" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 48 48" enable-background="new 0 0 48 48" xml:space="preserve"><path d="M24,36c-0.256,0-0.512-0.098-0.707-0.293l-22-22c-0.391-0.391-0.391-1.023,0-1.414s1.023-0.391,1.414,0 L24,33.586l21.293-21.293c0.391-0.391,1.023-0.391,1.414,0s0.391,1.023,0,1.414l-22,22C24.512,35.902,24.256,36,24,36z"></path></svg></span>
                                                                </span>
                        </div>
                        <div class="components-Form-FormField___self___10VZD">
                            <span class="components-Select-Select___self___13CJj">

                                <select name="inventory_id"  class="components-Select-Select___select___1ytQc" >
                                    <option value="" selected="selected">Весь инвентарь</option>
                                    @if(!empty($arInventory))
                                        @foreach($arInventory as $inventoryItem)
                                            <option value="{{$inventoryItem->id}}" @if(!empty($arInput['inventory_id']) && $inventoryItem->id == $arInput['inventory_id']) selected @endif>{{$inventoryItem->name}}</option>
                                        @endforeach
                                    @endif
                                </select>

                                                                    <span class="components-Icon-Icon___self___2zpSX components-Icon-Icon___self-span___yjOO0 components-Icon-Icon___color-gray___eeS_g components-Select-Select___icon-right___1gDJ1"><svg version="1.1" xmlns:x="&amp;ns_extend;" xmlns:i="&amp;ns_ai;" xmlns:graph="&amp;ns_graphs;" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 48 48" enable-background="new 0 0 48 48" xml:space="preserve"><path d="M24,36c-0.256,0-0.512-0.098-0.707-0.293l-22-22c-0.391-0.391-0.391-1.023,0-1.414s1.023-0.391,1.414,0 L24,33.586l21.293-21.293c0.391-0.391,1.023-0.391,1.414,0s0.391,1.023,0,1.414l-22,22C24.512,35.902,24.256,36,24,36z"></path></svg></span>
                                                                </span>
                        </div>
                        <div class="components-Form-FormField___self___10VZD">
                            <span class="components-Select-Select___self___13CJj">

                                <select name="inventory_action"  class="components-Select-Select___select___1ytQc" >
                                    <option value="issued" @if(!empty($arInput['inventory_action']) && $arInput['inventory_action'] == 'issued') selected @endif>Выданный</option>
                                    <option value="spent" @if(!empty($arInput['inventory_action']) && $arInput['inventory_action'] == 'spent') selected @endif>Потраченный</option>
                                </select>

                                                                    <span class="components-Icon-Icon___self___2zpSX components-Icon-Icon___self-span___yjOO0 components-Icon-Icon___color-gray___eeS_g components-Select-Select___icon-right___1gDJ1"><svg version="1.1" xmlns:x="&amp;ns_extend;" xmlns:i="&amp;ns_ai;" xmlns:graph="&amp;ns_graphs;" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 48 48" enable-background="new 0 0 48 48" xml:space="preserve"><path d="M24,36c-0.256,0-0.512-0.098-0.707-0.293l-22-22c-0.391-0.391-0.391-1.023,0-1.414s1.023-0.391,1.414,0 L24,33.586l21.293-21.293c0.391-0.391,1.023-0.391,1.414,0s0.391,1.023,0,1.414l-22,22C24.512,35.902,24.256,36,24,36z"></path></svg></span>
                                                                </span>
                        </div>
                        <div class="components-Form-FormField___self___10VZD">
                            <span class="components-Select-Select___self___13CJj">
                        <button name="button" type="submit" class="btn btn-success m-l-5 sm-pull-right sm-m-b-10 report-view-button"><span class="">Сформировать</span>
                        </button>
                            </span>
                        </div>

                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <div class="components-Inventory-components-Index___container___Fqh7F">

        @if(!empty($arResult))
            <div class="row m-t-20 clearfix">
                <div class="col-sm-12 col-md-12 col-lg-12" id="customers_list"><div class="table-responsive">
                        <table class="table table-hover table-sortable">
                            <thead>
                            <tr>
                                <th><a >Наименование</a></th>
                                <th><a >Сотрудник</a></th>
                                <th><a >Количество @if(!empty($arInput['inventory_action']) && $arInput['inventory_action'] == 'issued') выданого @elseif(!empty($arInput['inventory_action']) && $arInput['inventory_action'] == 'spent') потраченного @endif</a></th>
                                <th>
                                    <a >
                                        @if(!empty($arInput['inventory_action']) && $arInput['inventory_action'] == 'issued') Остаток на складе @elseif(!empty($arInput['inventory_action']) && $arInput['inventory_action'] == 'spent') Остаток у сотрудника @endif
                                    </a>
                                </th>
                                <th><a >Дата выдачи</a></th>
                            </tr>
                            </thead>
                            <tbody data-type="insert-target">
                            @foreach($arResult as $arReport)
                                <?php $totalQuantity+= $arReport->quantity?>
                                <tr class="clickable-row">
                                    <td>{{$arReport->inventory_name}}</td>
                                    <td>{{$arReport->staff_name}}</td>
                                    <td>{{$arReport->quantity}} {{$arReport->unit_short_name}}</td>
                                    <td>{{$arReport->quantity_left}} {{$arReport->unit_short_name}}</td>
                                    <td>{{$arReport->created_at}}</td>
                                </tr>
                            @endforeach
                            <tr>
                                <td></td>
                                <td></td>
                                <td><b>Итого выдано:</b> {{$totalQuantity ? $totalQuantity: 0}}</td>
                                <td></td>
                                <td></td>
                            </tr>

                            </tbody>
                        </table>
                    </div>
                    <div class="pagination-container">

                        <div class="pagination-info paging">Displaying <b>all {{count($arResult)}}</b> clients</div>
                    </div>
                </div>
            </div>
        @else
            <div class="row full-height sm-padding-10">
                <div class="col-sm-8 col-sm-offset-2 full-height">
                    <div class="text-center placeholder-text center-margin">
                        <p class="hint-text">
                            <i class="s-icon-reports-b placeholder-icon hint-text"></i>
                        </p>
                        <h3 class="m-b-10">Нет найденных элементов</h3>
                        <p class="m-b-20">
                            Заполните данные для формирования отчета
                        </p>
                    </div>
                </div>
            </div>
        @endif

    </div>

    <footer></footer>
</section>

@endsection