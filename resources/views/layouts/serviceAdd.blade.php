<li class="b-b b-grey bg-white service" id="service_{{$obServices->id}}">
    <div class="row item clickable-row" >
        <div class="media">
            <div class="media-left media-middle ui-sortable-handle">
                <i class="icon-reorder icon fs-12"></i>
            </div>
            <div class="media-body media-middle">
                <div class="col-sm-4 col-md-4 col-lg-4">
                    <a class="service__name event-link" data-type="update" data-link="/services/update_form/{{$obServices->id}}" >{{$obServices->name}}</a>
                </div>
                <div class="col-sm-3 col-md-3 col-lg-3">
                    <a class="service__name event-link" data-type="update" data-link="/services/update_form/{{$obServices->id}}" >{{$arStaff[0]->name}}</a>
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
</li>