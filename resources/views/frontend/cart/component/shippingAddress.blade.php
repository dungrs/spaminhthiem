<!-- Shipping Address -->
<div class="mb-4">
    <div class="d-flex align-items-center mb-3">
        <i class="fas fa-map-marker-alt text-primary me-2" style="font-size: 1.4rem;"></i>
        <h5 class="mb-0 fw-bold text-dark">Địa chỉ giao hàng</h5>
    </div>

    <div class="row g-3">
        <!-- Address Row -->
        <div class="col-md-4 mb-1">
            <label for="province">Tỉnh/Thành phố</label>
            <select class="form-control rounded location provinces choice-single-location" data-value="{{ $customer->province_id }}" data-target="districts" name="province_id">
                <option value="">Chọn tỉnh/thành phố</option>
                @if (isset($provinces))
                    @foreach ($provinces as $province)
                        <option
                        @if (old('province_id', $customer->province_id) == $province->code)
                            selected
                        @endif 
                        value="{{ $province->code }}">{{ $province->name }}</option>
                    @endforeach
                @endif
            </select>
        </div>
        <div class="col-md-4 mb-1">
            <label for="district">Quận/Huyện</label>
            <select class="form-control rounded location districts choice-single-location" data-value="{{ $customer->district_id }}" data-target="wards" name="district_id">
                <option value="">Chọn quận/huyện</option>
            </select>
        </div>
        <div class="col-md-4 mb-1">
            <label for="ward">Phường/Xã</label>
            <select class="form-control rounded wards choice-single-location" data-value="{{ $customer->ward_id }}" name="ward_id">
                <option value="">Chọn phường/xã</option>
            </select>
        </div>
        <div class="col-12 mb-2">
            <label for="address" class="form-label fw-medium">Địa chỉ chi tiết <span class="text-danger">*</span></label>
            <input type="address" 
                class="form-control py-2 {{ $errors->has('address') ? 'is-invalid border-danger' : '' }}" 
                name="address" 
                id="address" 
                value="{{ old('address', $customer->address ?? '') }}" 
                placeholder="Số nhà, tên đường...">
            @if($errors->has('address'))
                <div class="invalid-feedback d-flex align-items-center mt-1">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    {{ $errors->first('address') }}
                </div>
            @endif
        </div>
        <div class="col-12 mt-2">
            <label for="notes" class="form-label fw-medium">Ghi chú</label>
            <textarea name="description" class="form-control py-2" id="notes" rows="3" 
                    placeholder="Nhập ghi chú cá nhân">{{ old('description', $customer->description ?? '') }}</textarea>
            <div class="form-text">Ghi chú này sẽ giúp chúng tôi phục vụ bạn tốt hơn</div>
        </div>
    </div>
</div>