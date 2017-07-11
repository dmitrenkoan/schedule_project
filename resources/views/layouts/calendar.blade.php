@extends('template')

@section('content')

    <section class="main-content">
        <div class="js-loading-image" id="loading_image" style="display: none">
            <i class="icon-refresh icon-spin"></i>
            Loading...
        </div>

        @if(!empty($arStaff))
        <div class="components-Calendar-components-Toolbar-Toolbar___self___2bY9-">
            <form method="GET" id="filter_form">
            <div class="components-Calendar-components-Toolbar-Toolbar___column___DULhp"><div class="components-Calendar-components-Toolbar-Toolbar___row___1XRXG">
                    <div class="components-Form-FormField___self___10VZD">
                        <span class="components-Select-Select___self___13CJj">

                            <select name="staff_id" required="" class="components-Select-Select___select___1ytQc" onchange="$('#filter_form').submit()">
                                                        @foreach($arStaff as $key => $staffItem)
                                                            <option value="{{$staffItem->id}}" @if($staffItem->id == $curStaffID) selected="selected" @endif>{{$staffItem->name}}</option>>
                                                        @endforeach
                                                    </select>

                                                                <span class="components-Icon-Icon___self___2zpSX components-Icon-Icon___self-span___yjOO0 components-Icon-Icon___color-gray___eeS_g components-Select-Select___icon-right___1gDJ1"><svg version="1.1" xmlns:x="&amp;ns_extend;" xmlns:i="&amp;ns_ai;" xmlns:graph="&amp;ns_graphs;" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 48 48" enable-background="new 0 0 48 48" xml:space="preserve"><path d="M24,36c-0.256,0-0.512-0.098-0.707-0.293l-22-22c-0.391-0.391-0.391-1.023,0-1.414s1.023-0.391,1.414,0 L24,33.586l21.293-21.293c0.391-0.391,1.023-0.391,1.414,0s0.391,1.023,0,1.414l-22,22C24.512,35.902,24.256,36,24,36z"></path></svg></span>
                                                            </span>
                    </div></div>
            </div>
            </form>
        </div>
        @endif


        <div  class="row" style="padding: 0px 20px">
            <div class="col-lg-12" id="calendar"></div>

        </div>

        <footer></footer>
    </section>

@endsection