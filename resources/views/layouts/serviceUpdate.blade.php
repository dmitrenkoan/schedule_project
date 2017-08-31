
<div class="row item clickable-row" >
    <div class="media">
        <div class="media-left media-middle ui-sortable-handle">
            <i class="icon-reorder icon fs-12"></i>
        </div>
        <div class="media-body media-middle">
            <div class="col-sm-4 col-md-4 col-lg-4">
                <a class="service__name event-link" >{{$obServices->name}}</a>
            </div>
            <div class="col-sm-3 col-md-3 col-lg-3">

                <a class="service__name event-link" >
                    @if(!empty($obStaff))
                        @foreach($obStaff as $key => $serviceStaffItem)
                            {{($key >0)?', ':''}}{{$serviceStaffItem->name}}
                        @endforeach
                    @endif
                </a>
            </div>
            <div class="col-sm-3 col-md-3 col-lg-3 pull-right text-right">
                <span>{{$obServices->price}} грн</span>
            </div>
            <div class="col-sm-2 col-md-2 col-lg-2 pull-right text-right">
                {{$obServices->time_duration}} мин
            </div>
        </div>
    </div>
</div>