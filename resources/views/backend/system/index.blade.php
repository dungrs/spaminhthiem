<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <form action="" id="form-store-modal">
                        @if ($availableLanguages)
                        <div class="col-md-12">
                            <div class="collapse multi-collapse show">
                                <div class="card mb-0">
                                    @include('backend.system.component.cardHeader')
                                    <div class="card-body" style="padding-top: 12px; !important">
                                        <ul class="nav nav-tabs nav-tabs-custom" role="tablist" id="language-tabs">
                                            @foreach ($availableLanguages as $key => $language)
                                                <li class="nav-item">
                                                    <a class="nav-link" data-bs-toggle="tab" data-canonical="{{ $language->canonical }}" href="#{{ $language->canonical }}" role="tab">
                                                        <div class="d-flex gap-1">
                                                            <div class="language-name">
                                                                {{ $language->name }} 
                                                            </div>
                                                            @if (count($systems->where('language_id', $language->id)) > 0)
                                                                <i class="uil-check-circle text-success"></i>
                                                            @else
                                                                <i class="uil uil-exclamation-circle text-danger"></i>
                                                            @endif
                                                        </div>
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                        <!-- Tab panes -->
                                        <div class="tab-content" style="padding-top: 19px;" id="language-tabs-content">
                                            @foreach ($availableLanguages as $language)
                                                <div class="tab-pane fade needs-validation" id="{{ $language->canonical }}" role="tabpanel">
                                                    <input type="hidden" name="language_id" value="{{ $language->id }}">
                                                    @foreach ($systemConfigs as $key => $value)
                                                        <div class="card shadow-sm">
                                                            <a href="#add-{{ $key }}-parent-collapse" class="text-dark" data-bs-toggle="collapse" aria-expanded="true">
                                                                <div class="p-4">
                                                                    <div class="d-flex align-items-center">
                                                                        <div class="flex-shrink-0 me-3">
                                                                            <div class="avatar">
                                                                                <div class="avatar-title rounded-circle bg-soft-primary text-primary">{{ $value['index'] }}</div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="flex-grow-1 overflow-hidden">
                                                                            <h5 class="font-size-16 mb-1">{{ $value['label'] }}</h5>
                                                                            <p class="text-muted text-truncate mb-0">{{ $value['description'] }}</p>
                                                                        </div>
                                                                        <div class="flex-shrink-0">
                                                                            <i class="mdi mdi-chevron-up accor-down-icon font-size-24"></i>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        
                                                            <div id="add-{{ $key }}-parent-collapse" class="collapse show">
                                                                <div class="p-4 border-top">
                                                                    @include('backend.component.requiredFields')
                                                                    <div class="row">
                                                                        @php
                                                                            $systemLanguage = (convert_array($systems->where('language_id', $language->id), 'keyword', 'content')) ?? null;
                                                                        @endphp
                                                                        @foreach ($value['value'] as $keyValue => $item)
                                                                            @php
                                                                                $name = $key . '_' . $keyValue;
                                                                                $placeholder = $item['placeholder'];
                                                                            @endphp
                                                                            <div class="col-md-6 mb-3">
                                                                                <label for="">{{ $item['label'] }}</label>
                                                                                @switch($item['type'])
                                                                                    @case('text')
                                                                                        {!! renderSystemInput($name, $placeholder, $systemLanguage) !!}
                                                                                        @break
                                                                                    @case('image')
                                                                                        {!! renderSystemImage($name, $placeholder, $systemLanguage) !!}
                                                                                        @break
                                                                                    @case('textarea')
                                                                                        {!! renderSystemTextarea($name, $placeholder, $systemLanguage) !!}
                                                                                        @break
                                                                                    @case('select')
                                                                                        {!! renderSystemSelect($item, $placeholder, $name, $systemLanguage) !!}
                                                                                        @break
                                                                                    @case('editor')
                                                                                        {!! renderSystemEditor($name, $placeholder, $systemLanguage) !!}
                                                                                        @break
                                                                                    @break
                                                                                @endswitch
                                                                            </div>
                                                                        @endforeach
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- end col -->
                        @endif
                        <div class="row my-4">
                            <div class="col text-end">
                                <button type="submit" class="btn btn-success submitButton">
                                    <i class="bx bx-file me-1"></i> {{ __('messages.save') }}
                                </button>
                            </div> <!-- end col -->
                        </div> <!-- end row-->
                    </form>
                </div>
            </div>
            <!-- end row -->
        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->

    @include('backend.component.footer')
</div>

<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
<script>
        function initSortable(element, level = 1, maxDepth = 5) {
        if (level > maxDepth) return;

        const listItems = element.querySelectorAll(':scope > li');
        listItems.forEach((item) => {
            const nestedList = item.querySelector(':scope > ul');
            if (nestedList) {
                initSortable(nestedList, level + 1, maxDepth);
            }
        });

        Sortable.create(element, {
            group: 'nested',
            animation: 150,
            fallbackOnBody: true,
            swapThreshold: 0.65,
            onEnd: function (evt) {
                if (getDepth(evt.item) > maxDepth) {
                    alert(`Không thể vượt quá ${maxDepth} cấp!`);
                    evt.from.insertBefore(evt.item, evt.from.children[evt.oldIndex]); // hoàn tác
                }
            }
        });
    }

    function getDepth(el) {
        let depth = 1;
        let current = el;
        while (current.parentElement) {
            if (current.parentElement.matches('.nested-sortable, .nested-sortable ul')) {
                depth++;
            }
            current = current.parentElement;
        }
        return depth - 1; // vì root không tính
    }

    document.addEventListener('DOMContentLoaded', () => {
        const rootList = document.getElementById('menu');
        initSortable(rootList);
    });
</script>