<!-- Customer Info -->
<div class="mb-4">
        <div class="d-flex align-items-center mb-3">
        <i class="fas fa-user-circle text-primary me-2" style="font-size: 1.5rem;"></i>
        <h5 class="mb-0 text-dark fw-bold">Thông tin khách hàng</h5>
    </div>
    <div class="row g-3">
        <input type="hidden" name="customer_id" value="{{ $customer->id }}">
        <div class="col-md-6">
            <label for="fullname" class="form-label fw-medium">Họ và tên <span class="text-danger">*</span></label>
            <input type="text" 
                class="form-control py-2 {{ $errors->has('fullname') ? 'is-invalid border-danger' : '' }}" 
                name="fullname" 
                id="fullname" 
                value="{{ old('fullname', $customer->name ?? '') }}" 
                placeholder="Nhập họ và tên">
            @if($errors->has('fullname'))
                <div class="invalid-feedback d-flex align-items-center mt-1">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    {{ $errors->first('fullname') }}
                </div>
            @endif
        </div>
        
        <div class="col-md-6">
            <label for="email" class="form-label fw-medium">Email <span class="text-danger">*</span></label>
            <input type="email" 
                class="form-control py-2 {{ $errors->has('email') ? 'is-invalid border-danger' : '' }}" 
                name="email" 
                id="email" 
                value="{{ old('email', $customer->email ?? '') }}" 
                placeholder="Nhập email">
            @if($errors->has('email'))
                <div class="invalid-feedback d-flex align-items-center mt-1">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    {{ $errors->first('email') }}
                </div>
            @endif
        </div>
        
        <div class="col-md-12">
            <label for="phone" class="form-label fw-medium">Số điện thoại <span class="text-danger">*</span></label>
            <input type="tel" 
                class="form-control py-2 {{ $errors->has('phone') ? 'is-invalid border-danger' : '' }}" 
                name="phone" 
                id="phone" 
                value="{{ old('phone', $customer->phone ?? '') }}" 
                placeholder="Nhập số điện thoại">
            @if($errors->has('phone'))
                <div class="invalid-feedback d-flex align-items-center mt-1">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    {{ $errors->first('phone') }}
                </div>
            @endif
        </div>
    </div>
</div>