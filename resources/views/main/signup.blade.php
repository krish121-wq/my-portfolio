@extends('../layouts.masterlayouts')
@section('content')

	<!-- Start Banner Area -->
	<section class="banner-area organic-breadcrumb">
		<div class="container">
			<div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
				<div class="col-first">
					<h1>Register</h1>
					<nav class="d-flex align-items-center">
						<a href="index.html">Home<span class="lnr lnr-arrow-right"></span></a>
						<a href="category.html">Register</a>
					</nav>
				</div>
			</div>
		</div>
	</section>
	<!-- End Banner Area -->

	<!--================Login Box Area =================-->
	<section class="login_box_area section_gap">
		<div class="container">
			<div class="row">
				<div class="col-lg-6">
					<div class="login_box_img">
						<img class="img-fluid" src="{{ asset('assest/img/login.jpg')}}" alt="">
						<div class="hover">
							<h4>New to our website?</h4>
							<p>There are advances being made in science and technology everyday, and a good example of this is the</p>
							<a class="primary-btn" href="{{ route('login')}}">Login now</a>
						</div>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="login_form_inner">
						<h3>Register in to enter</h3>
						<form class="row login_form" action="post_registration" method="post" id="contactForm" novalidate="novalidate">
							@csrf
							<div class="col-md-12 form-group">
								<input type="text" class="form-control" id="name" name="name" placeholder="Username" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Username'" value="{{ old('name')}}">
							</div>
							@if ($errors->has('name'))
							<span class="text-danger">{{ $errors->firts('name') }}</span>
							@endif
                            <div class="col-md-12 form-group">
								<input type="text" class="form-control" id="email" name="email" placeholder="Email" onfocus="this.placeholder = ''" onblur="this.placeholder = ' User Email'" value="{{ old('email')}}">
							</div>
							@if($errors->has('email'))
							<span class="text-danger">{{ $errors->first('email') }}</span>
							@endif
							<div class="col-md-12 form-group">
								<input type="password" class="form-control" id="name" name="password" placeholder=" User Password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Password'" value="{{ old('password')}}">
							</div>
							@if($errors->has('password'))
							<span class="text-danger">{{ $errors->first('password') }}</span>
							@endif
							<div class="col-md-12 form-group">
								<input type="password" class="form-control" id="name" name="password" placeholder=" Confirm Password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Confirm Password'" value="{{ old('password')}}">
							</div>
							@if($errors->has('password'))
							<span class="text-danger">{{ $errors->first('password') }}</span>
							@endif
							<div class="col-md-12 form-group">
								<div class="creat_account">
									<input type="checkbox" id="f-option2" name="selector">
									<label for="f-option2">Keep me sign up  in</label>
								</div>
							</div>
							<div class="col-md-12 form-group">
								<button type="submit" value="submit" class="primary-btn">Sign up</button>
								<!-- <a href="#">Forgot Password?</a> -->
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--================End Login Box Area =================-->
@endsection