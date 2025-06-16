<div class="container py-4">
    <div class="card border-0 shadow-lg rounded-3">
        <div class="card-body p-4">
            <h4 class="mb-4 fw-bold text-danger">Thông tin cá nhân</h4>
            <form method="post" action="{{ route("customer.update", ['id' => $customer->id]) }}" enctype="multipart/form-data">
                <div class="row">
                    <!-- Cột avatar -->
                    <div class="col-12 col-md-3 mb-4 mb-md-0">
                        <div class="d-flex flex-column align-items-center text-center p-4 border rounded-3 bg-light shadow-sm">
                            <div class="position-relative mb-3">
                                <img id="avatarPreview"
                                     src="{{ $customer->image ?? asset('frontend/img/no-image.jpg') }}" 
                                     class="img-fluid rounded-circle border border-2" 
                                     alt="Avatar" 
                                     style="width: 120px; height: 120px; object-fit: cover;">
                                <label for="avatar" class="position-absolute bottom-0 end-0 bg-white rounded-circle p-2 border cursor-pointer shadow-sm">
                                    <i class="fas fa-camera text-muted"></i>
                                </label>
                            </div>
                            <input type="file" name="image" value="{{ $customer->image ?? asset('frontend/img/no-image.jpg') }}" id="avatar" class="d-none" accept="image/*">
                            <small class="text-muted mt-2">Chỉnh sửa ảnh đại diện</small>
                        </div>
                    </div>
                    
                    <!-- Cột thông tin -->
                    <div class="col-12 col-md-9">
                        <div class="row g-3">
                            @csrf
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label fw-medium">Họ và tên <span class="text-danger">*</span></label>
                                <input type="text" 
                                       class="form-control py-2 {{ $errors->has('name') ? 'is-invalid border-danger' : '' }}" 
                                       name="name" 
                                       id="name" 
                                       value="{{ old('name', $customer->name ?? '') }}" 
                                       placeholder="Nhập họ và tên">
                                @if($errors->has('name'))
                                    <div class="invalid-feedback d-flex align-items-center mt-1">
                                        <i class="fas fa-exclamation-circle me-2"></i>
                                        {{ $errors->first('name') }}
                                    </div>
                                @endif
                            </div>
                            
                            <div class="col-md-6 mb-3">
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
                            
                            <div class="col-md-6 mb-3">
                                <label for="phone" class="form-label fw-medium">Số điện thoại</label>
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
                            
                            <div class="col-md-6 mb-3">
                                <label for="birthday" class="form-label fw-medium">Ngày sinh <span class="text-danger">*</span></label>
                                <input type="text" 
                                       class="form-control py-2 datepicker-basic birthday {{ $errors->has('birthday') ? 'is-invalid border-danger' : '' }}" 
                                       name="birthday" 
                                       id="birthday" 
                                       value="{{ old('birthday', convertDateTime($customer->birthday, 'd/m/Y') ?? '') }}" 
                                       placeholder="Nhập ngày sinh">
                                @if($errors->has('birthday'))
                                    <div class="invalid-feedback d-flex align-items-center mt-1">
                                        <i class="fas fa-exclamation-circle me-2"></i>
                                        {{ $errors->first('birthday') }}
                                    </div>
                                @endif
                            </div>
                            
                            <!-- Password Fields -->
                            <div class="col-md-6 mb-3 password-section">
                                <label for="password">Mật khẩu mới <span class="text-danger">(*)</span></label>
                                <div class="position-relative password-form">
                                    <input value="{{ old('password') }}" 
                                           id="password" 
                                           name="password" 
                                           type="password" 
                                           class="form-control password-input {{ $errors->has('password') ? 'is-invalid border-danger' : '' }}" 
                                           placeholder="Nhập mật khẩu mới" 
                                           autocomplete="off">
                                    <button type="button" class="btn btn-link position-absolute end-0 top-0 password-addon">
                                        <i class="mdi mdi-eye-outline font-size-18 text-muted"></i>
                                    </button>
                                </div>
                                @if($errors->has('password'))
                                    <div class="invalid-feedback d-flex align-items-center mt-1">
                                        <i class="fas fa-exclamation-circle me-2"></i>
                                        {{ $errors->first('password') }}
                                    </div>
                                @else
                                    <div class="form-text">Để trống nếu không đổi mật khẩu</div>
                                @endif
                            </div>
                            
                            <div class="col-md-6 mb-3 password-section">
                                <label for="re_password">Xác nhận mật khẩu <span class="text-danger">(*)</span></label>
                                <div class="position-relative password-form">
                                    <input value="{{ old('re_password') }}" 
                                           id="re_password" 
                                           name="re_password" 
                                           type="password" 
                                           class="form-control password-input {{ $errors->has('re_password') ? 'is-invalid border-danger' : '' }}" 
                                           placeholder="Nhập lại mật khẩu" 
                                           autocomplete="off">
                                    <button type="button" class="btn btn-link position-absolute end-0 top-0 password-addon">
                                        <i class="mdi mdi-eye-outline font-size-18 text-muted"></i>
                                    </button>
                                </div>
                                @if($errors->has('re_password'))
                                    <div class="invalid-feedback d-flex align-items-center mt-1">
                                        <i class="fas fa-exclamation-circle me-2"></i>
                                        {{ $errors->first('re_password') }}
                                    </div>
                                @endif
                            </div>
                            
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
                            
                            <!-- Detailed Address -->
                            <div class="col-12 mb-2">
                                <label for="address" class="form-label fw-medium">Địa chỉ chi tiết</label>
                                <input type="text" class="form-control py-2" value="{{ old('address', $customer->address ?? '') }}" name="address" id="address" placeholder="Số nhà, tên đường...">
                            </div>
                            
                            <!-- Notes -->
                            <div class="col-12 mt-2">
                                <label for="notes" class="form-label fw-medium">Ghi chú</label>
                                <textarea name="description" class="form-control py-2" id="notes" rows="3" 
                                          placeholder="Nhập ghi chú cá nhân (sở thích, lưu ý đặc biệt...)">{{ old('description', $customer->description ?? '') }}</textarea>
                                <div class="form-text">Ghi chú này sẽ giúp chúng tôi phục vụ bạn tốt hơn</div>
                            </div>
                            
                            <!-- Save Button -->
                            <div class="col-12 mt-3">
                                <button type="submit" class="btn btn-danger py-2 px-4 fw-medium">
                                    <i class="fas fa-save me-2"></i> Lưu thay đổi
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>