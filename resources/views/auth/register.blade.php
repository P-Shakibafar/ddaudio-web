<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>DDAudio | Registration Page</title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="{{@asset('css/app.css')}}">
</head>
<body class="hold-transition register-page">
<div class="register-box">
	<div class="register-logo">
		<a href="#"><b class="red">DD</b>Audio</a>
	</div>
	
	<div class="card">
		<div class="card-body register-card-body">
			<p class="login-box-msg">Register a new membership</p>
			
			<form method="POST" action="{{ route('register') }}">
				@csrf
				<div class="input-group mb-3">
					<input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
					       name="name" value="{{ old('name') }}" placeholder="Full name" required autofocus>
					
					@if ($errors->has('name'))
						<span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
					@endif
					<div class="input-group-append">
						<span class="fa fa-user input-group-text"></span>
					</div>
				</div>
				<div class="input-group mb-3">
					<input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
					       name="email" value="{{ old('email') }}" placeholder="Email" required>
					
					@if ($errors->has('email'))
						<span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
					@endif
					<div class="input-group-append">
						<span class="fa fa-envelope input-group-text"></span>
					</div>
				</div>
				<div class="input-group mb-3">
					<input id="password" type="password" placeholder="Password"
					       class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password"
					       required>
					
					@if ($errors->has('password'))
						<span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
					@endif
					<div class="input-group-append">
						<span class="fa fa-lock input-group-text"></span>
					</div>
				</div>
				<div class="input-group mb-3">
					<input id="password-confirm" type="password" placeholder="Retype password" class="form-control"
					       name="password_confirmation"
					       required>
					<div class="input-group-append">
						<span class="fa fa-lock input-group-text"></span>
					</div>
				</div>
				<div class="row">
					<!-- /.col -->
					<div class="col-4 offset-md-8">
						<button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
					</div>
					<!-- /.col -->
				</div>
			</form>
			<br>
			<a href="{{route('login')}}" class="text-center">I already have a membership</a>
		</div>
		<!-- /.form-box -->
	</div><!-- /.card -->
</div>
<!-- /.register-box -->

</body>
</html>