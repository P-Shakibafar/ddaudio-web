<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	
	<title>DD Audio Admin Panel | </title>
	
	<link rel="stylesheet" href="{{@asset('/css/app.css')}}">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper" id="app">
	
	<!-- Navbar -->
	<nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
		<!-- Left navbar links -->
		<ul class="navbar-nav">
			<li class="nav-item">
				<a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
			</li>
		</ul>
		<!-- SEARCH FORM -->
		<div class="input-group input-group-sm col-sm-3 ml-3">
			<input class="form-control form-control-navbar" @keyup="searchit" v-model="search" type="search"
			       placeholder="Search" aria-label="Search">
			<div class="input-group-append">
				<button class="btn btn-navbar" @click="searchit">
					<i class="fa fa-search"></i>
				</button>
			</div>
		</div>
	</nav>
	<!-- /.navbar -->
	
	<!-- Main Sidebar Container -->
	<aside class="main-sidebar sidebar-dark-primary elevation-4">
		<!-- Brand Logo -->
		<a href="#" class="brand-link">
			{{--<img src="./images/logo.jpeg" alt="Admin Panel Logo" class="brand-image img-circle elevation-3"--}}
			{{--style="opacity: .8;width: 2rem;height: 4rem">--}}
			<span class="brand-text pl-3  font-weight-light"><b class="red">DD</b> AUDIO</span>
		</a>
		<!-- Sidebar -->
		<div class="sidebar">
			<!-- Sidebar user panel (optional) -->
			<div class="user-panel mt-3 pb-3 mb-3 d-flex text-white">
				<div class="image pt-1">
					<img src="./images/profile/{{Auth::user()->photo}}" class="img-circle elevation-2" alt="User Image"
					     style="width: 3rem;height: 3rem">
				</div>
				<div class="info">
					<a class="d-block">
						<p class="mb-1">{{ucfirst(Auth::user()->name)}}</p>
						<span style="font-size: 12px"> <i class="fa fa-circle green"></i> {{ucfirst(Auth::user()->type)}}</span>
					</a>
				</div>
			</div>
			
			<!-- Sidebar Menu -->
			<nav class="mt-2">
				<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
					<!-- Add icons to the links using the .nav-icon class
							 with font-awesome or any other icon font library -->
					<li class="nav-item">
						<router-link to="/dashboard" class="nav-link">
							<i class="nav-icon fa fa-tachometer-alt blue"></i>
							<p style="font-family: 'B Titr',sans-serif,Serif">
								{{--Dashboard--}}
								داشبورد
							</p>
						</router-link>
					</li>
					<li class="nav-item has-treeview ">
						<a href="#" class="nav-link">
							<i class="nav-icon fas fa-cog green"></i>
							<p style="font-family:'B Titr',Serif,sans-serif">
								{{--Management--}}
								مدیریت
								<i class="right fa fa-angle-left"></i>
							</p>
						</a>
						<ul class="nav nav-treeview">
							<li class="nav-item">
								<router-link to="/users" class="nav-link">
									<i class="fas fa-users nav-icon cyan"></i>
									{{--<p>Users</p>--}}
									<p style="font-family: 'B Titr',serif,sans-serif">کاربرها</p>
								</router-link>
							</li>
							<li class="nav-item">
								<router-link to="/products" class="nav-link">
									<i class="fas fa-list-ul  nav-icon indigo"></i>
									{{--<p>Products</p>--}}
									<p style="font-family: 'B Titr',sans-serif,Serif">دسته بندی ها</p>
								</router-link>
							</li>
							<li class="nav-item">
								<router-link to="/amplifires" class="nav-link">
									<i class="fas fa-list nav-icon red"></i>
									{{--<p>Amplifires</p>--}}
									<p style="font-family: 'B Titr',sans-serif,Serif">آمپلی فایرها</p>
								</router-link>
							</li>
							<li class="nav-item">
								<router-link to="/subwoofers" class="nav-link">
									<i class="fas fa-list-alt nav-icon yellow"></i>
									{{--<p>Subwoofers</p>--}}
									<p style="font-family: 'B Titr',sans-serif,Serif">ساب وفرها</p>
								</router-link>
							</li>
							<li class="nav-item">
								<router-link to="/speakers" class="nav-link">
									<i class="fas fa-th-list nav-icon green"></i>
									{{--<p>Speakers</p>--}}
									<p style="font-family: 'B Titr',sans-serif,Serif">اسپیکرها</p>
								</router-link>
							</li>
							<li class="nav-item">
								<router-link to="/enclosures" class="nav-link">
									<i class="fas fa-bars nav-icon teal"></i>
									{{--<p>Enclosures</p>--}}
									<p style="font-family: 'B Titr',sans-serif,Serif">باکس ها</p>
								</router-link>
							</li>
							<li class="nav-item">
								<router-link to="/signal_processors" class="nav-link">
									<i class="fas fa-list-ol nav-icon pink"></i>
									{{--<p>Signal Processors</p>--}}
									<p style="font-family: 'B Titr',sans-serif,Serif">پردازنده های سیگنال</p>
								</router-link>
							</li>
						
						</ul>
					</li>
					<li class="nav-item">
						<router-link to="/gallery" class="nav-link">
							<i class="nav-icon fa fa-camera-retro  blue"></i>
							<p style="font-family: 'B Titr',sans-serif,Serif">
								{{--Gallery--}}
								گالری
							</p>
						</router-link>
					</li>
					<li class="nav-item">
						<router-link to="/profile" class="nav-link">
							<i class="nav-icon fa fa-user orange"></i>
							<p style="font-family: 'B Titr',sans-serif,Serif">
								{{--Profile--}}
								پروفایل
							</p>
						</router-link>
					</li>
					<li class="nav-item">
						<router-link to="/developer" class="nav-link">
							<i class="nav-icon fa fa-cogs purple"></i>
							<p style="font-family: 'B Titr',sans-serif,Serif">
								{{--Developer--}}
								توسعه دهنده
							</p>
						</router-link>
					</li>
                    <li class="nav-item">
                        <router-link to="/" class="nav-link">
                            <i class="nav-icon fa fa-cogs green"></i>
                            <p style="font-family: 'B Titr',sans-serif,Serif">
                                {{--Developer--}}
                                سایت
                            </p>
                        </router-link>
                    </li>
					<li class="nav-item">
						<a class="nav-link" href="{{ route('logout') }}"
						   onclick="event.preventDefault();
               document.getElementById('logout-form').submit();">
							<i class="nav-icon fa fa-power-off red"></i>
							<p style="font-family: 'B Titr',sans-serif,Serif">
								{{--{{ __('Logout') }}--}}
								خروج
							</p>
						</a>
						
						<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
							@csrf
						</form>
					</li>
				</ul>
			</nav>
			<!-- /.sidebar-menu -->
		</div>
		<!-- /.sidebar -->
	</aside>
	
	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<!-- Main content -->
		<div class="content">
			<div class="container-fluid">
				<router-view></router-view>
				<vue-progress-bar></vue-progress-bar>
			</div><!-- /.container-fluid -->
		</div>
		<!-- /.content -->
	</div>
	<!-- /.content-wrapper -->
	
	<!-- Main Footer -->
	<footer class="main-footer">
		<!-- To the right -->
		<div class="float-right d-none d-sm-inline">
			Anything you want
		</div>
		<!-- Default to the left -->
		<strong>Copyright &copy; 2014-2018 <a href="http://ddaudio.com">DD Audio</a>.</strong> All rights reserved.
	</footer>
</div>
<!-- ./wrapper -->
<script src="{{@asset('js/app.js')}}"></script>
</body>
</html>
