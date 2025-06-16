
@php
    $activeTab = isset($register) ? 'register' : 'login';
@endphp
<main class="body">
    <div class="auth-bg-basic d-flex align-items-center">
        <div class="container">
            <div class="d-flex flex-column min-vh-100 px-3">
                <div class="row justify-content-center mt-5">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <!-- Tab Navigation -->
                        <ul class="nav nav-tabs nav-justified mb-4" id="authTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link {{ isset($login) ? 'active' : '' }}" id="login-tab"
                                        data-bs-toggle="tab" data-bs-target="#login" type="button"
                                        role="tab" data-href="dang-nhap.html">
                                    Đăng nhập
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link {{ isset($register) ? 'active' : '' }}" id="register-tab"
                                        data-bs-toggle="tab" data-bs-target="#register" type="button"
                                        role="tab" data-href="dang-ki.html">
                                    Đăng ký
                                </button>
                            </li>
                        </ul>
                        
                        <!-- Tab Content -->
                        <div class="tab-content" id="authTabContent">
                            <!-- Login Tab -->
                            <div class="tab-pane fade {{ $activeTab == 'login' ? 'show active' : '' }}" id="login" role="tabpanel">
                                <div class="card bg-transparent shadow-none border-0">
                                    <div class="card-body">
                                        <div class="py-3">
                                            <div class="text-center">
                                                <h3 class="fw-bold text-uppercase section-home-header">
                                                    Chào mừng bạn quay lại!
                                                </h3>
                                                <p class="text-muted mt-2">Đăng nhập để tiếp tục mua sắm cùng TokyoLife</p>
                                            </div>
                                            
                                            <form class="mt-4 pt-2" method="post" action="{{ route('customer.login') }}">
                                                @csrf
                                                <div class="form-floating form-floating-custom mb-3">
                                                    <input value="{{ old('email') }}" name="email" type="text" 
                                                            class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" 
                                                            id="input-username" placeholder="Enter User Name">
                                                    <label for="input-username">Email/Tên đăng nhập</label>
                                                    <div class="form-floating-icon">
                                                        <i class="uil uil-envelope"></i>
                                                    </div>
                                                    @if($errors->has('email'))
                                                        <div class="invalid-feedback d-block">
                                                            {{ $errors->first('email') }}
                                                        </div>
                                                    @endif
                                                </div>
                                                
                                                <div class="form-floating form-floating-custom mb-3 password-form">
                                                    <input value="{{ old('password') }}" name="password" type="password" 
                                                            class="form-control password-input {{ $errors->has('password') ? 'is-invalid' : '' }}" 
                                                            placeholder="Enter Password" id="password-input">
                                                    <button type="button" class="btn btn-link position-absolute h-100 end-0 top-0 password-addon">
                                                        <i class="mdi mdi-eye-outline font-size-18 text-muted"></i>
                                                    </button>
                                                    <label for="password-input">Mật khẩu</label>
                                                    <div class="form-floating-icon">
                                                        <i class="uil uil-padlock"></i>
                                                    </div>
                                                    @if($errors->has('password'))
                                                        <div class="invalid-feedback d-block">
                                                            {{ $errors->first('password') }}
                                                        </div>
                                                    @endif
                                                </div>
                                                
                                                <div class="d-flex justify-content-between align-items-center mb-3">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" id="remember-check" name="remember">
                                                        <label class="form-check-label" for="remember-check">
                                                            Ghi nhớ đăng nhập
                                                        </label>
                                                    </div>
                                                    <a href="" class="text-muted text-decoration-underline">Quên mật khẩu?</a>
                                                </div>
                                                
                                                <button class="btn btn-danger w-100 py-2 mb-3" type="submit">Đăng nhập</button>
                                                
                                                <div class="signin-other-title text-center mt-2">
                                                    <h5 class="font-size-15 mb-4 text-muted fw-medium">- Hoặc bạn có thể tham gia bằng -</h5>
                                                </div>
                                                
                                                <div class="d-flex gap-2 mb-4">
                                                    <button type="button" class="btn btn-outline-primary flex-grow-1">
                                                        <i class="bx bxl-facebook me-2"></i> Facebook
                                                    </button>
                                                    <button type="button" class="btn btn-outline-danger flex-grow-1">
                                                        <i class="bx bxl-google me-2"></i> Google
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Register Tab -->
                            <div class="tab-pane fade {{ $activeTab == 'register' ? 'show active' : '' }}" id="register" role="tabpanel">
                                <div class="card bg-transparent shadow-none border-0">
                                    <div class="card-body">
                                        <div class="py-3">
                                            <div class="text-center">
                                                <h3 class="fw-bold text-uppercase section-home-header">
                                                    Tạo tài khoản mới
                                                </h3>
                                                <p class="text-muted mt-2">Đăng ký để nhận ưu đãi thành viên</p>
                                            </div>
                                            
                                            <form class="mt-4 pt-2" method="post" action="{{ route('customer.register') }}">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <div class="form-floating form-floating-custom">
                                                                <input value="{{ old('name') }}" name="name" type="text" 
                                                                       class="form-control {{ $errors->has('name') ? 'is-invalid border-danger' : '' }}" 
                                                                       id="name" placeholder="Họ Tên">
                                                                <label for="name">Họ Tên</label>
                                                                <div class="form-floating-icon">
                                                                    <i class="uil uil-user"></i>
                                                                </div>
                                                            </div>
                                                            @if($errors->has('name'))
                                                                <div class="invalid-feedback d-flex align-items-center mt-1">
                                                                    <i class="fas fa-exclamation-circle me-2"></i>
                                                                    {{ $errors->first('name') }}
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <div class="form-floating form-floating-custom">
                                                                <input  value="{{ old('birthday') }}" 
                                                                        name="birthday" type="text" class="form-control datepicker-basic birthday" 
                                                                        id="birthday" placeholder="Ngày sinh" 
                                                                        max="{{ date('Y-m-d') }}">
                                                                <label for="birthday">Ngày sinh</label>
                                                                <div class="form-floating-icon">
                                                                    <i class="uil uil-calendar-alt"></i>
                                                                </div>
                                                            </div>
                                                            @if($errors->has('birthday'))
                                                                <div class="invalid-feedback d-flex align-items-center mt-1">
                                                                    <i class="fas fa-exclamation-circle me-2"></i>
                                                                    {{ $errors->first('birthday') }}
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="form-floating form-floating-custom mb-3">
                                                    <div class="mb-3">
                                                        <div class="form-floating form-floating-custom">
                                                            <input value="{{ old('email') }}" name="email" type="email" 
                                                                class="form-control {{ $errors->has('email') ? 'is-invalid border-danger' : '' }}" 
                                                                id="register-email" placeholder="Email">
                                                            <label for="register-email">Email</label>
                                                            <div class="form-floating-icon">
                                                                <i class="uil uil-envelope"></i>
                                                            </div>
                                                        </div>
                                                        @if($errors->has('email'))
                                                            <div class="invalid-feedback d-flex align-items-center mt-1">
                                                                <i class="fas fa-exclamation-circle me-2"></i>
                                                                {{ $errors->first('email') }}
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                                
                                                <div class="mb-3">
                                                    <div class="form-floating form-floating-custom password-form">
                                                        <input name="password" type="password" 
                                                               class="form-control password-input {{ $errors->has('password') ? 'is-invalid border-danger' : '' }}" 
                                                               placeholder="Mật khẩu" id="register-password"
                                                               aria-describedby="password-error">
                                                        <button type="button" class="btn btn-link position-absolute h-100 end-0 top-0 password-addon">
                                                            <i class="mdi mdi-eye-outline font-size-18 text-muted"></i>
                                                        </button>
                                                        <label for="register-password">Mật khẩu</label>
                                                        <div class="form-floating-icon">
                                                            <i class="uil uil-padlock"></i>
                                                        </div>
                                                    </div>
                                                    
                                                    @if($errors->has('password'))
                                                        <div id="password-error" class="invalid-feedback d-flex align-items-center mt-1">
                                                            <i class="fas fa-exclamation-circle me-2"></i>
                                                            {{ $errors->first('password') }}
                                                        </div>
                                                    @endif
                                                </div>

                                                <div class="mb-3">
                                                    <div class="form-floating form-floating-custom password-form">
                                                        <input name="re_password" type="password" 
                                                            class="form-control password-input {{ $errors->has('re_password') ? 'is-invalid border-danger' : '' }}" 
                                                            placeholder="Nhập lại mật khẩu" id="confirm-password">
                                                        <button type="button" class="btn btn-link position-absolute h-100 end-0 top-0 password-addon">
                                                            <i class="mdi mdi-eye-outline font-size-18 text-muted"></i>
                                                        </button>
                                                        <label for="confirm-password">Nhập lại mật khẩu</label>
                                                        <div class="form-floating-icon">
                                                            <i class="uil uil-padlock"></i>
                                                        </div>
                                                    </div>
                                                    
                                                    @if($errors->has('re_password'))
                                                        <div class="invalid-feedback d-flex align-items-center mt-1">
                                                            <i class="fas fa-exclamation-circle me-2"></i>
                                                            {{ $errors->first('re_password') }}
                                                        </div>
                                                    @endif
                                                </div>
                                                
                                                <div class="form-check mb-4">
                                                    <input class="form-check-input" type="checkbox" id="terms-check" name="terms">
                                                    <label class="form-check-label" for="terms-check">
                                                        Tôi đồng ý với <a href="#" class="text-decoration-underline">Điều khoản</a> và <a href="#" class="text-decoration-underline">Chính sách bảo mật</a>
                                                    </label>
                                                </div>
                                                
                                                <button class="btn btn-danger w-100 py-2 mb-3" type="submit">Đăng ký</button>
                                                
                                                <div class="text-center mt-4">
                                                    <p class="text-muted mb-0">Đã có tài khoản? 
                                                        <a href="{{ route('customer.showLogin') }}" class="fw-semibold text-decoration-underline switch-to-login">Đăng nhập ngay</a>
                                                    </p>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
