@if (array_key_exists("header", $item))
    <li class="header">{{ $item['header'] }}</li>
@else
    @php
        $item['href'] = isset($item['route']) ? route($item['route']) : (isset($item['url']) ? $item['url'] : "#");
        $item['class'] = isset($item['submenu']) ? 'treeview' : "";
        $item['submenu_class'] = isset($item['submenu']) ? 'treeview-menu' : "";
    @endphp

    <li class="{{ $item['class'] }}">
        <a href="{{ $item['href'] }}"
           @if (isset($item['target'])) target="{{ $item['target'] }}" @endif
           @if (isset($item['tooltip'])) data-toggle="tooltip" data-placement="{{ $item['tooltip']['direction'] }}" title="{{ $item['tooltip']['title'] }}" @endif 
        >
            <i class="fa fa-fw fa-{{ $item['icon'] or 'circle-o' }} {{ isset($item['icon_color']) ? 'text-' . $item['icon_color'] : '' }}"></i>
            <span>{{ $item['text'] }}</span>
            @if (isset($item['label']))
                <span class="pull-right-container">
                    <span class="label label-{{ $item['label_color'] or 'primary' }} pull-right">{{ $item['label'] }}</span>
                </span>
            @elseif (isset($item['submenu']))
                <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
                </span>
            @endif
        </a>
        @if (isset($item['submenu']))
            <ul class="{{ $item['submenu_class'] }}">
                @each('partials.menu-item', $item['submenu'], 'item')
            </ul>
        @endif
    </li>
@endif
