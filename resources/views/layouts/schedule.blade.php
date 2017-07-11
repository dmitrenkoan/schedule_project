@extends('template')

@section('content')
    <section class="main-content">
        <div class="js-loading-image" id="loading_image" style="display: none">
            <i class="icon-refresh icon-spin"></i>
            Loading...
        </div>


        <div class="second-lvl-nav-container">
            @include('blocks.topTabulator')


            <div class="page-wrapper">
                <div class="schedule-box" id="schedule-container">
                    <div class="row schedule-filters">
                        <div class="col-sm-5">
                            <div class="form-inline">
                                <div class="form-group">
                                    <div class="select-wrapper hidden">
                                        <select name="location_id" id="location_id" class="form-control js-schedule-location m-r-5">[]</select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="select-wrapper">
                                        <select name="employee_id" id="employee_id" class="form-control js-schedule-employee"><option value="">All staff</option><option value="172085">anatoly dmitrenko</option><option value="172086">Wendy Smith</option></select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-7">
                            <div class="pull-right schedule-date-toolbar">
                                <div class="btn-group js-date-toolbar">
                                    <div class="btn btn-default navigate" data-action="previous" title="Previous">
                                        <i class="s-icon-left-arrow-b"></i>
                                    </div>
                                    <div class="btn btn-default hidden-xs navigate active" data-action="today">
                                        Today
                                    </div>
                                    <div class="btn btn-default select-date" title="Change Date">
                                        <span class="display-date">23 - 29 Apr, 2017</span>
                                        <input type="text" name="date_from" id="date_from" value="Tuesday, 25 Apr 2017" class="datepicker-input hasDatepicker" readonly="readonly">
                                    </div>
                                    <div class="btn btn-default navigate" data-action="next" title="Next">
                                        <i class="s-icon-right-arrow-b"></i>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="schedule-wrapper">
                        <div class="js-schedule-table schedule-scrollable"><div class="schedule-tables"><div class="schedule-employees"><table class="employee-table"><thead><tr style="height: 41px;"><th>Staff</th></tr></thead><tbody><tr style="height: 41px;"><td class="employee-name"><div class="schedule-employee-name js-full-text">anatoly dmitrenko</div><small>48h</small></td></tr><tr style="height: 41px;"><td class="employee-name"><div class="schedule-employee-name js-full-text">Wendy Smith</div><small>48h</small></td></tr></tbody></table></div><div class="schedule-employee-hours"><table class="schedule-table"><thead><tr class="closed-dates"><th></th><th></th><th></th><th></th><th></th><th></th><th></th></tr><tr><th>Sun 23 Apr</th><th>Mon 24 Apr</th><th>Tue 25 Apr</th><th>Wed 26 Apr</th><th>Thu 27 Apr</th><th>Fri 28 Apr</th><th>Sat 29 Apr</th></tr></thead><tbody><tr><td class="empty js-schedule-cell clickable"></td><td class="range"><div title="" data-toggle="" class="schedule-hours js-schedule-cell clickable">09:00 - 17:00</div></td><td class="range"><div title="" data-toggle="" class="schedule-hours js-schedule-cell clickable">09:00 - 17:00</div></td><td class="range"><div title="" data-toggle="" class="schedule-hours js-schedule-cell clickable">09:00 - 17:00</div></td><td class="range"><div title="" data-toggle="" class="schedule-hours js-schedule-cell clickable">09:00 - 17:00</div></td><td class="range"><div title="" data-toggle="" class="schedule-hours js-schedule-cell clickable">09:00 - 17:00</div></td><td class="range"><div title="" data-toggle="" class="schedule-hours js-schedule-cell clickable">09:00 - 17:00</div></td></tr><tr><td class="empty js-schedule-cell clickable"></td><td class="range"><div title="" data-toggle="" class="schedule-hours js-schedule-cell clickable">09:00 - 17:00</div></td><td class="range"><div title="" data-toggle="" class="schedule-hours js-schedule-cell clickable">09:00 - 17:00</div></td><td class="range"><div title="" data-toggle="" class="schedule-hours js-schedule-cell clickable">09:00 - 17:00</div></td><td class="range"><div title="" data-toggle="" class="schedule-hours js-schedule-cell clickable">09:00 - 17:00</div></td><td class="range"><div title="" data-toggle="" class="schedule-hours js-schedule-cell clickable">09:00 - 17:00</div></td><td class="range"><div title="" data-toggle="" class="schedule-hours js-schedule-cell clickable">09:00 - 17:00</div></td></tr></tbody></table></div></div></div>
                        <div class="schedule-loading-overlay js-loading-overlay hidden">
                            <i class="icon-refresh icon-spin"></i>
                            Loading roster
                        </div>
                    </div>








                </div>
            </div>
        </div>
        <script>
            Schedule.Browser.init($('#schedule-container'), {"locations":[{"id":62929,"name":"test company","schedulable_employee_ids":[172086,172085]}],"employees":[{"id":172085,"full_name":"anatoly dmitrenko","first_name":"anatoly","last_name":"dmitrenko"},{"id":172086,"full_name":"Wendy Smith","first_name":"Wendy","last_name":"Smith"}]});
        </script>

        <footer></footer>
    </section><div id="ui-datepicker-div" class="ui-datepicker ui-widget ui-widget-content ui-helper-clearfix ui-corner-all"></div>
@endsection