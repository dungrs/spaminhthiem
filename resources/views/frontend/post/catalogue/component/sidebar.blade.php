<!-- Sidebar -->
<div class="col-lg-3 col-md-4">
    <!-- Categories Widget -->
    <div class="category-sidebar mb-4">
        <div class="card-header bg-white border-bottom-0 pb-2">
            <h3 class="h6 mb-0 text-primary"><i class="fas fa-list-alt me-2"></i> Danh mục
        </div>

        <div class="category-body bg-white p-3 rounded-bottom border border-top-0">
            <ul class="category-list list-unstyled mb-0">
                @foreach($postCatalogues->where('level', 2) as $parent)
                    @php
                        $children = $postCatalogues->where('parent_id', $parent->id);
                        $collapseId = 'cat-' . $parent->id;
                    @endphp
                    <li class="category-item">
                        <a class="category-link d-flex align-items-center justify-content-between py-2 px-3 rounded collapsed"
                        data-bs-toggle="collapse"
                        href="#{{ $collapseId }}"
                        aria-expanded="false">
                            <span>{{ $parent->name }}</span>
                            <i class="fas fa-chevron-down category-arrow"></i>
                        </a>

                        @if($children->count())
                            <div class="collapse" id="{{ $collapseId }}">
                                <ul class="subcategory-list list-unstyled ps-4 mt-2">
                                    @foreach($children as $child)
                                        <li class="subcategory-item mb-1">
                                            <a href="{{ writeUrl($child->canonical,true, true) }}"
                                            class="subcategory-link d-block py-1 px-2 rounded text-decoration-none">
                                                <i class="fas fa-caret-right me-2 text-primary"></i>
                                                {{ $child->name }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

    <!-- Popular Posts -->
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white border-bottom-0 pb-2">
            <h3 class="h6 mb-0 text-danger"><i class="fas fa-fire me-2"></i> {{ $widgets['post-hl']['name'] }}</h3>
        </div>
        <div class="card-body pt-2 px-3">
            <div class="list-group list-group-flush">
                @foreach ($widgets['post-hl']['object']->take(4) as $post)
                    <a href="{{ writeUrl($post->canonical, true, true) }}" class="list-group-item list-group-item-action px-0 py-3">
                        <div class="d-flex align-items-start">
                            <img src="{{ $post->image }}"
                                class="rounded me-3 flex-shrink-0" width="60" height="60" alt="Top 9 Spa tại Bắc Giang">
                            <div>
                                <div class="small fw-bold text-dark mb-1">{{ Str::limit($post->name, 30, '...') }}</div>
                                <div class="text-muted small mb-1">{{ Str::limit($post->meta_description, 25, '...') }}</div>
                                <div class="text-muted small"><i class="far fa-calendar-alt me-1"></i> {{ $post->created_at->format('d/m/Y') }}</div>
                            </div>
                        </div>
                    </a>
                @endforeach
                
                <!-- Thêm tin nổi bật khác -->
            </div>
        </div>
    </div>
</div>