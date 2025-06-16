<div class="topnav">
    <nav class="navbar navbar-light navbar-expand-sm topnav-menu">
        <div class="collapse navbar-collapse active" id="topnav-menu-content">
            <ul class="navbar-nav active">
                @foreach($menus['menu-header'] as $menuItem)
                    @php
                        $hasChildren = !empty($menuItem['children']);
                    @endphp
                    <li class="nav-item dropdown">
                        <a class="nav-link {{ $hasChildren ? 'dropdown-toggle' : '' }}" 
                           href="{{ writeUrl($menuItem['item']->canonical, true, true) ?: '#' }}" 
                           id="topnav-{{ $menuItem['item']->id }}" 
                           role="button" 
                           data-bs-toggle="{{ $hasChildren ? 'dropdown' : '' }}" 
                           aria-haspopup="{{ $hasChildren ? 'true' : 'false' }}" 
                           aria-expanded="false">
                            <span class="text-dark fw-bold">
                                {{ $menuItem['item']->name }}
                            </span>
                            @if($hasChildren)
                                <div class="arrow-down text-dark"></div>
                            @endif
                        </a>

                        @if($hasChildren)
                            <div class="dropdown-menu mega-dropdown-menu px-2 dropdown-mega-menu-xl" aria-labelledby="topnav-{{ $menuItem['item']->id }}">
                                <div class="container-fluid py-3">
                                    <div class="row">
                                        @php
                                            $childrenChunks = array_chunk($menuItem['children'], 4);
                                        @endphp
                        
                                        @foreach($childrenChunks as $chunk)
                                            <div class="col-12">
                                                <div class="row">
                                                    @foreach($chunk as $child)
                                                        <div class="col-lg-3 col-md-6 mb-3 mb-md-0">
                                                            <div class="mb-2">
                                                                <a href="{{ writeUrl($child['item']->canonical, true, true) }}" class="menu-title fw-bold mb-2">{{ $child['item']->name }}</a>
                                                            </div>
                                                            @if(!empty($child['children']))
                                                                <div class="d-flex flex-column mb-2">
                                                                    @foreach($child['children'] as $subChild)
                                                                        <a href="{{ writeUrl($subChild['item']->canonical, true, true) }}" class="dropdown-item py-2">
                                                                            {{ $subChild['item']->name }}
                                                                        </a>
                                                                    @endforeach
                                                                </div>
                                                            @endif
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endif
                    </li>
                @endforeach
            </ul>
        </div>
    </nav>
</div>
