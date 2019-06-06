<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<!-- Tell the browser to be responsive to screen width -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>DDAudio | Log in</title>
	<link rel="stylesheet" href="{{@asset('css/app.css')}}">
</head>
<body class="hold-transition login-page">
<div class="login-box" id="app">
	<div class="login-logo">
		<a href="#"><b class="red">DD</b>Audio</a>
	</div>
	<!-- /.login-logo -->
	<div class="card">
		<div class="card-body login-card-body">
			<p class="login-box-msg">Reset Password</p>
			
			@if (session('status'))
				<div class="alert alert-success" role="alert">
					{{ session('status') }}
				</div>
			@endif
			
			<form method="POST" action="{{ route('password.email') }}">
				@csrf
				
				<div class="input-group mb-3">
					<input id="email" type="email" placeholder="Email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
					       name="email" value="{{ old('email') }}" required>
					
					@if ($errors->has('email'))
						<span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
					@endif
					<div class="input-group-append">
						<span class="fa fa-envelope input-group-text"></span>
					</div>
				</div>
				<div class="row">
					<div class="col-8 offset-md-4">
						<button type="submit" class="btn btn-primary btn-block btn-flat">Send Password Reset Link</button>
					</div>
					<!-- /.col -->
				</div>
			</form>
			<br>
			<p class="mb-1"><a href="{{route('login')}}" class="text-center">I already have a membership</a></p>
		</div>
		<!-- /.login-card-body -->
	</div>
</div>
<!-- /.login-box -->

<script src="{{@asset('js/app.js')}}"></script>
</body>
</html>
