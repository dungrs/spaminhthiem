<!-- Payment & Shipping -->
<div class="row g-3">
    <div class="col-md-6">
        <h5 class="mb-3 fw-bold text-danger">
            <i class="fas fa-credit-card me-2"></i>Phương Thức Thanh Toán
        </h5>
        <select class="form-control rounded choice-single-location" name="method">
            @foreach (__('checkout.method') as $key => $val)
                <option 
                @if (old('method') == $val['name'])
                    selected
                @endif 
                value="{{ $val['name'] }}"
                >{{ $val['label'] }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-6">
        <h5 class="mb-3 fw-bold text-danger">
            <i class="fas fa-truck me-2"></i>Phương Thức Vận Chuyển
        </h5>
        <select class="form-select rounded choice-single-location" name="method_shipping">
            @foreach (__('checkout.shipping') as $key => $val)
                <option 
                @if (old('method') == $val['name'])
                    selected
                @endif 
                value="{{ $val['name'] }}"
                >{{ $val['label'] }}</option>
            @endforeach
        </select>
    </div>
</div>