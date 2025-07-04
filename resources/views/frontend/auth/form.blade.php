@php
	$activeTab = isset($register) ? 'register' : 'login';
@endphp
<section class="bread-crumb mb-3">
	<span class="crumb-border"></span>
	<div class="container ">
		<div class="row">
		<div class="col-12 a-left">
			<ul class="breadcrumb m-0 px-0">
				<li class="home">
					<a  href="/" class='link' ><span >Trang chủ</span></a>						
					<span class="mr_lr">&nbsp;/&nbsp;</span>
				</li>
				<li><strong ><span>{{ $activeTab === 'register' ? 'Đăng kí tài khoản' : 'Đăng nhập tài khoản' }}</span></strong></li>
			</ul>
		</div>
		</div>
	</div>
</section>

<section class="section">
	<div class="container margin-bottom-20 card py-20 shadow-none">
	@if(isset($activeTab) && $activeTab === 'login')
		<div class="wrap_background_aside margin-bottom-4 mt-4 page_login">
			<div class="heading-bar text-center mb-2">
				<h1 class="auth-title">Đăng nhập tài khoản</h1>
				<p class="auth-subtitle">
					Bạn chưa có tài khoản?
					<a href="{{ writeUrl('dang-ki', true, true) }}" class="auth-link">Đăng ký tại đây</a>
				</p>
			</div>
			<div class="mt-3 pt-2" method="post" action="{{ route('customer.login') }}">
				<div class="col-12 col-md-6 col-lg-5 offset-md-3 py-2 mx-auto">
					<form class="pt-2" method="post" action="{{ route('customer.login') }}">
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

						<div class="section margin-top-10 button_bottom mt-3">
							<button type="submit" value="Đăng ký" class="btn btn-style btn_register btn-block">Đăng nhập</button>
						</div>

						<div id="recover-password" style="display:none;" class="form-signup page-login text-center">
							<h2>
							Đặt lại mật khẩu
							</h2>
							<p>
							Chúng tôi sẽ gửi cho bạn một email để kích hoạt việc đặt lại mật khẩu.
							</p>
						</div>
					</form>
					<div class="text-center mt-5">
						<div class="social-divider mb-4">
							<span class="line"></span>
							<span class="text">Hoặc đăng nhập bằng</span>
							<span class="line"></span>
						</div>

						<div class="d-flex justify-content-center gap-3">
							<a href="javascript:void(0)" class="social-btn shadow-sm">
							<img src="{{ asset('frontend/img/icon/fb-btn.svg') }}" alt="facebook-login-button" width="129" height="37" class="rounded">
							</a>

							<a href="javascript:void(0)" class="social-btn shadow-sm">
							<img src="{{ asset('frontend/img/icon/gp-btn.svg') }}" alt="google-login-button" width="129" height="37" class="rounded">
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	@else
		<div class="wrap_background_aside margin-bottom-40 page_login mt-4">
			<div class="heading-bar text-center">
				<h1 class="auth-title">Đăng ký tài khoản</h1>
				<p class="auth-subtitle">
					Bạn đã có tài khoản?
					<a href="{{ writeUrl('dang-nhap', true, true) }}" class="auth-link">Đăng nhập tại đây</a>
				</p>
			</div>
			<div class="row">
				<div class="col-12 col-md-6 col-lg-5 offset-md-3 mx-auto">
					<form class="" method="post" action="{{ route('customer.register') }}">
						<div class="py-3">
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
							
							<div class="section margin-top-10 button_bottom mt-3">
								<button type="submit" value="Đăng ký" class="btn btn-style btn_register btn-block">Đăng ký</button>
							</div>

							<div class="text-center mt-5">
								<div class="social-divider mb-4">
									<span class="line"></span>
									<span class="text">Hoặc đăng nhập bằng</span>
									<span class="line"></span>
								</div>

								<div class="d-flex justify-content-center gap-3">
									<a href="javascript:void(0)" class="social-btn shadow-sm">
									<img src="{{ asset('frontend/img/icon/fb-btn.svg') }}" alt="facebook-login-button" width="129" height="37" class="rounded">
									</a>

									<a href="javascript:void(0)" class="social-btn shadow-sm">
									<img src="{{ asset('frontend/img/icon/gp-btn.svg') }}" alt="google-login-button" width="129" height="37" class="rounded">
									</a>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	@endif
	</div>
</section>
<script type="text/javascript">
	function showRecoverPasswordForm() {
		document.getElementById('recover-password').style.display = 'block';
		document.getElementById('login').style.display='none';
	}
	
	function hideRecoverPasswordForm() {
		document.getElementById('recover-password').style.display = 'none';
		document.getElementById('login').style.display = 'block';
	}
	
	if (window.location.hash == '#recover') { showRecoverPasswordForm() }
</script>