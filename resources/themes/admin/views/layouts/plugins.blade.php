@if(! empty(plugin_menus()))
    
    @foreach(plugin_menus() as $key => $val)
        @php
            if(count($val) === 0) continue;
            $menu = $val['admin'];
        @endphp
        <li class="{{ (config('site.menu') == $menu['name'] )? 'active': '' }}">
        @if(isset($menu['child']) && !empty($menu['child']))
            <a href="#" class="auto">
                <span class="pull-right text-muted">
                    <i class="fa fa-angle-left text"></i>
                    <i class="fa fa-angle-down text-active"></i>
                </span>
                <i class="{{ $menu['icon'] }}">
                </i>
                <span>{{ $menu['name'] }}</span>
            </a>
            <ul class="nav text-sm">
                @foreach($menu['child'] as $k => $submenu)
                <li class="{{ (config('site.submenu') == $submenu['name'] )? 'active': '' }}">
                    <a href="{{ $submenu['url'] }}">
                        <i class="fa fa-angle-right text-xs"></i>
                        <span>{{ $submenu['name'] }}</span>
                    </a>
                </li>
                @endforeach
            </ul>
        @else
            <a href="{{ $menu['url'] }}">
                <i class="{{ $menu['icon'] }}"></i>
                <span>{{ $menu['name'] }}</span>
            </a>
        @endif
        </li>
    @endforeach
@endif