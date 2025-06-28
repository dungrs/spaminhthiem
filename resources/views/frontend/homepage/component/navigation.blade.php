<div class="col-lg-15 d-xl-block d-none navigation-wrapper">
    <nav class="h-100">
        <ul class="navigation list-group list-group-flush scroll modern-nav">
            @foreach ($menus['product-category'] as $menuItem) @php $item = $menuItem['item']; $hasChildren = !empty($menuItem['children']); @endphp

            <li class="menu-item list-group-item {{ $hasChildren ? 'has-submenu' : '' }}">
                <a href="{{ writeUrl($item->canonical, true, true) ?: '#' }}" class="menu-item__link" title="{{ $item->name }}">
                    <span class="menu-text">{{ $item->name }}</span>
                    @if ($hasChildren)
                    <i class="icon-wrapper" data-toggle-submenu>
                        <svg class="icon">
                            <use xlink:href="#icon-arrow" />
                        </svg>
                    </i>
                    @endif
                </a>

                @if ($hasChildren)
                <div class="submenu scroll">
                    <ul class="submenu__list grid grid-cols-2 gap-2">
                        @foreach($menuItem['children'] as $child)
                        <li class="submenu__item submenu__item--main">
                            <a class="link" href="{{ writeUrl($child['item']->canonical, true, true) }}" title="{{ $child['item']->name }}">
                                {{ $child['item']->name }}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
                @endif
            </li>
            @endforeach
        </ul>
    </nav>
</div>
