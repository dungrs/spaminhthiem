<!doctype html>
<html lang="en">
    <head>
        @include('backend.component.head')
    </head>
   
    <body>
        <div class="auth-bg-basic d-flex align-items-center min-vh-100">
            <div class="bg-overlay bg-light"></div>
            <div class="container">
                <div class="d-flex flex-column min-vh-100 py-5 px-3">
                    
                    <div class="row justify-content-center">
                        <div class="col-xl-5">
                            <div class="text-center text-muted mb-2">
                                <div class="pb-3">
                                    <a href="index.html">
                                        <span class="logo-lg">
                                            <img src="{{ asset('backend/images/logo-sm.svg') }}" alt="" height="24">
                                        </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row justify-content-center my-auto">
                        <div class="col-md-8 col-lg-6 col-xl-5">
                            <div class="card bg-transparent shadow-none border-0">
                                <div class="card-body">
                                    <div class="py-3">
                                        <div class="text-center">
                                            <h5 class="mb-0">Chào mừng trở lại !</h5>
                                            <p class="text-muted mt-2">Đăng nhập để tiếp tục</p>
                                        </div>
                                        <form class="mt-4 pt-2" mehtod="post" action="{{ route('auth.login') }}">
                                            @csrf
                                            <div class="form-floating form-floating-custom">
                                                <input value="{{ old('email') }}" name="email" type="text" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" id="input-username" placeholder="Enter User Name">
                                                <label  for="input-username">Tên dăng nhập</label>
                                                <div class="form-floating-icon">
                                                    <i class="uil uil-users-alt"></i>
                                                </div>
                                            </div>
                                            <div class="invalid-feedback mb-3" style="display: block;">
                                                {{ $errors->has('email') ? $errors->first('email') : '' }}
                                            </div>
                                            <div class="form-floating form-floating-custom auth-pass-inputgroup password-form">
                                                <input value="{{ old('password') }}" name="password" type="password" class="form-control password-input {{ $errors->has('password') ? 'is-invalid' : '' }}" placeholder="Enter Password">
                                                <button type="button" class="btn btn-link position-absolute h-100 end-0 top-0 password-addon">
                                                    <i class="mdi mdi-eye-outline font-size-18 text-muted"></i>
                                                </button>
                                                <label for="password-input">Mật khẩu</label>
                                                <div class="form-floating-icon">
                                                    <i class="uil uil-padlock"></i>
                                                </div>
                                            </div>
                                            <div class="invalid-feedback mb-3" style="display: block;">
                                                {{ $errors->has('password') ? $errors->first('password') : '' }}
                                            </div>
        
                                            <div class="form-check form-check-primary font-size-16 py-1">
                                                <input class="form-check-input" type="checkbox" id="remember-check">
                                                <div class="float-end">
                                                    <a href="auth-resetpassword-basic.html" class="text-muted text-decoration-underline font-size-14">Quên mật khẩu?</a>
                                                </div>
                                                <label class="form-check-label font-size-14" for="remember-check">
                                                    Ghi nhớ đăng nhập
                                                </label>
                                            </div>
        
                                            <div class="mt-3">
                                                <button class="btn btn-primary w-100" type="submit">Đăng nhập</button>
                                            </div>
    
                                            <div class="mt-4 text-center">
                                                <div class="signin-other-title">
                                                    <h5 class="font-size-15 mb-4 text-muted fw-medium">- Hoặc bạn có thể tham gia bằng -</h5>
                                                </div>
    
                                                <div class="d-flex gap-2">
                                                    <button type="button" class="btn btn-soft-primary waves-effect waves-light w-100">
                                                        <i class="bx bxl-facebook font-size-16 align-middle"></i> 
                                                    </button>
                                                    <button type="button" class="btn btn-soft-info waves-effect waves-light w-100">
                                                        <i class="bx bxl-linkedin font-size-16 align-middle"></i> 
                                                    </button>
                                                    <button type="button" class="btn btn-soft-danger waves-effect waves-light w-100">
                                                        <i class="bx bxl-google font-size-16 align-middle"></i> 
                                                    </button>
                                                </div>
                                            </div>
    
                                            <div class="mt-4 pt-3 text-center">
                                                <p class="text-muted mb-0">Bạn chưa có tài khoản? <a href="auth-signup-basic.html" class="fw-semibold text-decoration-underline">  Đăng kí ngay</a> </p>
                                            </div>
        
                                        </form><!-- end form -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- end row -->

                    <div class="row">
                        <div class="col-xl-12">
                            <div class="mt-4 mt-md-5 text-center">
                                <p class="mb-0">© <script>document.write(new Date().getFullYear())</script> Vuesy. Crafted with <i class="mdi mdi-heart text-danger"></i> by <a href="https://1.envato.market/themesdesign" target="_blank">Themesdesign</a></p>
                            </div>
                        </div>
                    </div> <!-- end row -->
                </div>
            </div>
            <!-- end container fluid -->
        </div>
        <!-- end authentication section -->

        <!-- JAVASCRIPT -->
        @include('backend.component.script')
    </body>
</html>
