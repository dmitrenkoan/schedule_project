<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('pageTitle')</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/application.css') }}" rel="stylesheet">
    <link href="{{ asset('css/fonts.css') }}" rel="stylesheet">
    <link href="{{ asset('css/calendar.css') }}" rel="stylesheet">
    <link href="{{ asset('css/template.css') }}" rel="stylesheet">

        <link href="{{ asset('css/inventory.css') }}" rel="stylesheet">
        <link href="{{ asset('css/common.css') }}" rel="stylesheet">

    @if(!empty($pageParam) && $pageParam == 'calendar')
        <link href="{{ asset('css/fullcalendar.css') }}" rel="stylesheet">

    @endif

    @if(!empty($pageParam) && $pageParam == 'reports')
        <link href="{{ asset('css/jquery.datetimepicker.css') }}" rel="stylesheet">
    @endif





</head>






<body>

<body class="main-layout win  pace-done"><div class="pace  pace-inactive"><div class="pace-progress" data-progress-text="100%" data-progress="99" style="transform: translate3d(100%, 0px, 0px);">
        <div class="pace-progress-inner"></div>
    </div>
    <div class="pace-activity"></div></div>


<div class="sidebar sidebar--open">
    <div class="sidebar__toggle">
        <a href="/calendar"><img alt="Shedul" width="30" height="30" class="hidden-mobile sidebar__logo sidebar__logo--short" src="./services_files/logo-4f9a7517326c2b32df13e21a7049304c1adc2739a956a309f7e859fc4904b13b.png">
            <img alt="Shedul" height="26" class="sidebar__logo sidebar__logo--full" src="./services_files/logo-nav-a8d227207ca837ff3b4bc007d3f8e851296937d076524dbf50f7054e712622b0.png">
        </a></div>
    <div class="sidebar-scrollable">
        <div class="sidebar-scrollable-container">
            <div class="sidebar-nav-wrapper">
                @include('blocks.menuMain');
            </div>
        </div>
    </div>
</div>

<div class="mobile-menu-overlay" id="sidebar-menu-overlay"></div>
<header class="main-header">
    <div class="sidebar__toggle visible-mobile">
        <div class="page-title">Services</div>
        <nav class="pull-left visible-mobile js-sidebar-toggle">
            <button class="sidebar-toggle-btn sidebar-toggle-btn--mobile">
                <span class="sidebar-toggle-btn__icon"></span>
            </button>
        </nav>
    </div>
    <nav class="inline hidden-mobile">
        <ul class="top-nav hidden-mobile">
            <li class="top-nav__item">
                <button class="js-sidebar-toggle js-sidebar-toggle-btn sidebar-toggle-btn sidebar-toggle-btn--active sidebar-toggle-btn--active" onclick="history.back()">
                    <span class="sidebar-toggle-btn__icon"></span>
                </button>
            </li>
            <li class="top-nav__item">
                <div class="top-nav__title">
                    <span class="top-nav__title--item">@yield('pageTitle')</span>

                </div>
            </li>
        </ul>
    </nav>
    <nav class="pull-right">

        <ul class="top-nav">
            <li class="top-nav__item hidden-mobile">
                <a class="top-nav__link" data-toggle="search" href="/services#" id="main-search-link">
                    <i class="s-icon-search-b icon-large"></i>
                </a>
            </li>
            <li class="dropdown alerts hidden-mobile top-nav__item">
                <a class="alerts-menu-toggle dropdown-toggle top-nav__link" data-toggle="dropdown" href="/services#" id="alerts-dropdown-toggle" title="Alerts">
                    <i class="s-icon-bell-b icon-large alert-bell-icon"></i>
                </a>
                <ul class="dropdown-menu navbar-dropdown alerts-dropdown top-nav__dropdown">
                    <div class="empty-state">
                        <div class="row full-height sm-padding-10">
                            <div class="col-sm-12 full-height">
                                <div class="text-center placeholder-text center-margin">
                                    <p>
                                        <i class="s-icon-anti-clock placeholder-icon hint-text"></i>
                                    </p>
                                    <h3 class="m-b-10">No updates</h3>
                                    <p class="m-b-20">
                                        This is where you can find the latest updates from the Shedul team, check back here to see what's new!
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </ul>
            </li>


            <li class="top-nav__item dropdown">
                <a class="dropdown-toggle top-nav__link hidden-mobile" data-toggle="dropdown" href="/services#" title="Profile">
                    <i class="s-icon-user-b icon-large"></i>
                </a>
                <a class="top-nav__link visible-mobile--flex" href="/services#" id="user-menu" title="Profile">
                    <span class="top-nav__settings"></span>
                </a>
                <ul class="dropdown-menu top-nav__dropdown" id="user-menu-dropdown">
                    <div class="top-nav__user visible-mobile">
                        anatoly
                    </div>
                    <li class="top-nav__dropdown--item">
                        <a class="top-nav__dropdown--link" href="/account">My Settings</a>
                    </li>
                    <li class="top-nav__dropdown--item">
                        <a class="top-nav__dropdown--link" href="/provider/settings">Account Setup</a>
                    </li>
                    <li class="top-nav__dropdown--item" id="user-menu-contact-support">
                        <a target="_blank" class="top-nav__dropdown--link" data-uv-trigger="" href="https://shedul.uservoice.com/" data-uv-scanned="true" id="uv-1">Contact Support</a>
                    </li>
                    <li class="top-nav__dropdown--item">
                        <a target="_blank" class="top-nav__dropdown--link" href="https://shedul.uservoice.com/">Help Center</a>
                    </li>
                    <li class="top-nav__dropdown--item">
                        <a class="top-nav__dropdown--link" rel="nofollow" data-method="delete" href="/sign-out">Logout</a>
                    </li>
                </ul>
                <div class="mobile-menu-overlay" id="user-menu-overlay"></div>
            </li>
        </ul>

    </nav>
</header>


@yield('content')



<div class="components-Modal-Modal___background___59VHw" id="update_modal" data-window="modal" style="display:none">
</div>

<div class="overlay" data-pages="search" style="display: none">
    <div class="overlay-content has-results m-t-20">
        <div class="container-fluid">
            <div class="close-icon-light overlay-close text-black fs-16">
                <i class="s-icon-close"></i>
            </div>
        </div>
        <div class="container-fluid">
            <form id="global-search-form" action="/search" accept-charset="UTF-8" method="get"><input name="utf8" type="hidden" value="✓">
                <input type="text" name="term" id="overlay-search" class="no-border overlay-search bg-transparent m-t-30" data-toggle="dropdown" placeholder="Search..." autocomplete="off" spellcheck="false">
            </form>

            <br>
        </div>
        <div class="container-fluid">
<span>
<h5>Search by client name, mobile number or booking reference...</h5>
</span>
            <span></span>
            <br>
            <div class="search-results m-t-40">
                <div class="row overlay-search-results-container" id="overlay-search-results">
                    <div class="col-md-6 col-md-push-6">
                        <p class="bold">UPCOMING APPOINTMENTS</p>
                        <div class="scrollable overlay-search-results" id="overlay-search-bookings">
                            <div>
                                <p class="no-reults"></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-md-pull-6">
                        <p class="bold">CLIENTS</p>
                        <div class="scrollable overlay-search-results" id="overlay-search-customers">
                            <div>
                                <p class="no-reults"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="modal_form"><!-- Сaмo oкнo -->
    <span id="modal_close">X</span> <!-- Кнoпкa зaкрыть -->
    <!-- Тут любoе сoдержимoе -->
</div>
<div id="overlay"></div><!-- Пoдлoжкa -->


<!-- Scripts -->
<script src="{{ asset('js/jquery-3.2.1.min.js')}}"></script>
@if(!empty($pageParam) && $pageParam == 'calendar' && !empty($arJSData))
    <script src="{{ asset('js/moment.min.js')}}"></script>
    <script src="{{ asset('js/fullcalendar.min.js')}}"></script>
    <script src='{{ asset('js/locale/ru.js')}}'></script>

    <script>
        var calendarItems = {!! $arJSData['events_data'] !!};
        // full calendar plugin
        $('#calendar').fullCalendar({
            header: {
                left:   'title',
                center: 'prev,next',
                right: 'today',
            },
            firstDay: "1",
            //"weekNumbersWithinDays": true,
            defaultDate: '{{date('Y-m-d')}}',
            slotLabelFormat: 'H:mm',
            columnFormat: "ddd DD.MM",
            //editable: true,
            businessHours: [ // specify an array instead
                {
                    dow: [ 0, 1, 2, 3, 4, 6, 7 ], // Monday, Tuesday, Wednesday
                    start: '09:00', // 8am
                    end: '20:00' // 6pm
                },
            ],
            defaultView: "agendaWeek",
            locale: 'ru',
            slotDuration: "00:15:00",
            events: calendarItems,
            eventClick: function(event, element) {


                //console.log(event, element);
                /*event.title = "CLICKED!";

                $('#calendar').fullCalendar('updateEvent', event);*/

            },
            dayClick: function(date, jsEvent, view) {
                $.ajax({
                    type: "POST",
                    url: "/calendar/add_form",
                    data: {dateBegin:date.format(), curStaffID: '{{$curStaffID}}'},
                    dataType: "html",
                    success: function(html) {
                        $('#update_modal').html(html);
                        $('#update_modal').fadeIn();
                    }
                });


            },
            eventRender: function(event, element) {
                //console.log(event,element);
                //console.log(element);
                element.html(event.advHTML + "<p class=\"period\">" + moment(event.start).format('H:mm') + ' - ' + moment(event.end).format('H:mm') + "</p>" + event.title);
            }



        })
        /*var test = ;
        console.log(test.id);
        $('#calendar').fullCalendar( 'removeEvents' , Number(test.id) );*/
    </script>

    <script src="{{ asset('js/fullcalendar-actions.js') }}"></script>

@endif
@if(!empty($pageParam) && $pageParam == 'reports')
    <script src="{{ asset('js/jquery.datetimepicker.full.min.js') }}"></script>
    <script>
        jQuery.datetimepicker.setLocale('ru');

        $('.datetimepicker').datetimepicker({
            format:'Y-m-d H:i'
        });
    </script>


@endif
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/fastSearch.js') }}"></script>






</body>
</html>