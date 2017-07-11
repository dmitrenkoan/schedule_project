@if(!empty($arMainMenu))
    <ul class="main-nav">
        @foreach($arMainMenu as $menuItem)
            <li class="main-nav__item">
                <a class="main-nav__link @if($menuItem->active == "Y") active @endif js-main-nav__tooltip" title="{{$menuItem->name}}" href="{{$menuItem->link}}">
                    <i class="s-icon-{{$menuItem->picture}}-b icon-large"></i>
                    {{$menuItem->name}}
                </a>
            </li>
        @endforeach

    </ul>
@endif