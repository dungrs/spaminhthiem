<!-- Payment & Shipping -->
<div class="row g-3">
    <div class="col-md-6">
        <div class="d-flex align-items-center mb-3">
            <i class="fas fa-credit-card text-primary me-2" style="font-size: 1.4rem;"></i>
            <h5 class="mb-0 fw-bold text-dark">Phương Thức Thanh Toán</h5>
        </div>
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
        <div class="d-flex align-items-center mb-3">
            <i class="fas fa-truck text-primary me-2" style="font-size: 1.4rem;"></i>
            <h5 class="mb-0 fw-bold text-dark">Phương Thức Vận Chuyển</h5>
        </div>
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