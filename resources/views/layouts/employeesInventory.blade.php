@extends('template')

@section('pageTitle', $pageTitle)

@section('content')
    <section class="main-content">
        <div class="js-loading-image" id="loading_image" style="display: none">
            <i class="icon-refresh icon-spin"></i>
            Loading...
        </div>


        <div class="second-lvl-nav-container">
            @include('blocks.topTabulator')


            <section class="page-wrapper">
                <div class="row sm-m-t-20">
                    <div class="col-md-12">
                        <div class="row m-b-10" id="filters-second-row">
                            <div class="col-lg-12">
                                <div class="filters-description sm-m-b-15"><p class="report-options no-margin"> Инвентарь сотрудника <h5>{{$obStaff->name}}</h5></p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-6"></div>
                            <div class="col-xs-6 text-right">

                            </div>
                        </div>
                        @if(!empty($arStaffInventory))
                        <div class="row m-t-20">
                            <div class="col-sm-12">
                                <div class="table-responsive">
                                    <table class="components-Table-Table___table___1jlfS">
                                        <thead>

                                            <th class="components-Table-TableHeader___self___1cVGw components-Table-TableHeader___sortable___BKF2P">Инвентарь</th>
                                            <th class="components-Table-TableHeader___self___1cVGw components-Table-TableHeader___sortable___BKF2P">Количество</th>
                                            <th class="components-Table-TableHeader___self___1cVGw components-Table-TableHeader___sortable___BKF2P">Еденицы</th>

                                        </thead>
                                        <tbody class="employees ui-sortable" data-type="insert-target">

                                            @foreach($arStaffInventory as $inventoryItem)
                                                <tr class="class="components-Table-TableRow___self___26NdW components-Table-TableRow___hoverable___G9APj"">

                                                    <td class="components-Table-TableRow___cell___jStEe components-Table-TableCell___self___3K_6A" style="width: 282px;">
                                                        {{$inventoryItem->inventory_name}}
                                                    </td>
                                                    <td class="components-Table-TableRow___cell___jStEe components-Table-TableCell___self___3K_6A" style="width: 308px;">
                                                        {{$inventoryItem->quantity}}
                                                    </td>
                                                    <td class="components-Table-TableRow___cell___jStEe components-Table-TableCell___self___3K_6A" style="width: 308px;">
                                                        {{$inventoryItem->short_name}}
                                                    </td>
                                                </tr>
                                            @endforeach


                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        @else
                            <div class="components-Inventory-components-Index___container___Fqh7F">
                                <!-- react-empty: 134 --><!-- react-empty: 28 --><div><!-- react-empty: 263 --><div><div><div class="components-Placeholder-Placeholder___self___mcVVR">
                                                <div class="components-Placeholder-Placeholder___name___3fO02">У данного сотрудника нет инвентаря</div><div class="components-Placeholder-Placeholder___content___Nk31z"></div></div></div></div></div><!-- react-empty: 273 --><!-- react-empty: 31 --><!-- react-empty: 32 --></div>
                        @endif
                    </div>
                </div>
            </section>
        </div>



        <footer></footer>
    </section>
@endsection