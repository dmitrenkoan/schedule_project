
<div class="nav-tabs-fixed">
    <section class="nav-tabs-scrollable-container reports-nav">
        @if(!empty($arSubMenu))
        <ul class="nav nav-tabs nav-tabs-simple nav-tabs-scrollable">
            @foreach($arSubMenu as $menuItem)
            <li @if($menuItem->active == "Y") class="active" @endif>
                <a href="{{$menuItem->link}}">{{$menuItem->name}}</a>
            </li>
            @endforeach
        </ul>
        @endif
    </section>
</div>