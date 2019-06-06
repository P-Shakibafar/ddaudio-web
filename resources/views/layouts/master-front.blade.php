<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Title  -->
    <title></title>
    <!-- Favicon  -->
    <link rel="icon" href="./images/index.png">
    
    <!-- Core Style CSS -->
    <link rel="stylesheet" href="{{@asset('css/app-front.css')}}">
</head>

<body>
<div id="app">
</div>
<!-- Master App js -->
<script src="{{@asset('js/app-front.js')}}"></script>
<!-- ##### jQuery (Necessary for All JavaScript Plugins) ##### -->
<script src="{{@asset('/js/jquery/jquery-2.2.4.min.js')}}"></script>
<!-- Popper js -->
<script src="{{@asset('/js/popper.min.js')}}"></script>
<!-- Bootstrap js -->
<script src="{{@asset('/js/bootstrap.min.js')}}" type="javascript"></script>
<!-- Plugins js -->
<script src="{{@asset('/js/plugins.js')}}"></script>
<!-- Active js -->
<script src="{{@asset('/js/active.js')}}"></script>
<!-- Custom script -->
<script>
    $("ul.nav>li.nav-item>a.nav-link").click(function () {
        $("li.active").removeClass("active");
        $(this.parentNode).addClass("active");
    });
</script>
</body>

</html>
