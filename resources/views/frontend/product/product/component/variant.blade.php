@foreach ($attributeCatalogue as $key => $val)
    <div class="{{ $key == 0 ? 'mt-2' : 'mt-4' }}" data-group-index="{{ $key }}">
        <h6 class="fw-bold mb-2 text-uppercase">{{ $val->name }}</h6>
        <div class="d-flex flex-wrap gap-2">
            @if (!is_null($val->attributes))
                @foreach ($val->attributes as $attrKey => $attr)
                    <a class="btn btn-outline-dark rounded-pill px-3 py-1 choose-attribute {{ $attrKey == 0 ? 'active' : '' }}"
                        data-attributeid="{{ $attr->id }}"
                        title="{{ $attr->name }}"
                        style="font-size: 0.85rem; border-width: 1.5px;">
                        {{ $attr->name }}
                    </a>
                @endforeach
            @endif
        </div>
    </div>
@endforeach

<div class="attribute-wrapper"></div>

<input type="hidden" name="product_id" value="{{ $product->id }}">
<input type="hidden" name="language_id" value="{{ $languageId }}">
