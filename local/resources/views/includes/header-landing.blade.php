<!-- Header -->
<header>
    <nav class="navbar navbar-default landing">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand pull-left" href="{{url('/')}}"><img
                            src="{!! asset('local/public/assets/images/demedatlogo.png') !!}" alt="image"></a>
                <!--<div class="logo-icons"><img id="img1" /></div>-->
                            
            </div><!-- /.navbar-header -->
			<!-- Button trigger modal - SignUp Page-->
			<div class="sign-up">
            <!-- Button trigger modal - Login Page-->
            @if(Session::get('accessGranted') || (!env('ACCESS_ENABLED') && !Session::get('accessGranted')))
                @if(Auth::check())
                    <a href="{{url('logout')}}" class="btn navbar-btn log-in hidden-md hidden-lg"><span data-hover="LOGOUT">LOGOUT</span></a>
                @else
                    <a id="loginBtn" href="javascript:void(0);" type="button" data-toggle="modal"
                       data-target="#modalLogIn" class="btn navbar-btn log-in hidden-md hidden-lg"><span data-hover="LOGIN">LOGIN</span></a>
                @endif
            @endif
            
            @if(Session::get('accessGranted') || (!env('ACCESS_ENABLED') && !Session::get('accessGranted')))
           		@if(!Auth::check())
                        {{--<a class="btn navbar-btn landing-reg" href="{{url('register')}}">REGISTER WITH US</a>--}}
                        <a data-target="#modalSignUp" data-toggle="modal"
                           class="btn navbar-btn landing-reg" href="javascript:void(0);">SIGN UP</a>
                @endif
            @endif
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                                
                        <!-- Modal - Register -->
                        <ul class="nav navbar-nav navbar-left">
                            <li @if(Request::is('purchaser')) class="active" @endif><a
                                        href="{{route('purchaser')}}"><span
                                            data-hover="Purchaser">Purchaser</span></a></li>
                            <li @if(Request::is('delivery-driver')) class="active" @endif><a
                                        href="{{route('delivery-driver')}}"><span data-hover="Delivery Person">Delivery Person</span></a>
                            </li>
                            <li @if(Request::is('retailer')) class="active" @endif><a href="{{route('retailer')}}"><span
                                            data-hover="Retailer">Retailer</span></a></li>
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="/purchaser/#how-it-works"><span
                                            data-hover="HOW IT WORKS">HOW IT WORKS</span></a>
                            </li>
                            <li><a href="/purchaser/#faq"><span data-hover="FAQ">FAQ</span></a></li>
                            <li>
                                <!-- Button trigger modal - Login Page-->
                                @if(Session::get('accessGranted') || (!env('ACCESS_ENABLED') && !Session::get('accessGranted')))
                                    @if(Auth::check())
                                        <a href="{{url('logout')}}"><span data-hover="LOGOUT">LOGOUT</span></a>
                                    @else
                                        <a id="loginBtn" href="javascript:void(0);" type="button" data-toggle="modal"
                                           data-target="#modalLogIn"><span data-hover="SIGN IN">SIGN IN</span></a>
                                    @endif
                                @endif

                            </li>
                        </ul><!-- /.navbar-nav -->
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container -->
    </nav><!-- /.navbar-default -->
</header>
<script>
var imgArray = new Array("{!! asset('local/public/assets/images/logo-icons-slide/1.svg') !!}","{!! asset('local/public/assets/images/logo-icons-slide/2.svg') !!}","{!! asset('local/public/assets/images/logo-icons-slide/3.svg') !!}","{!! asset('local/public/assets/images/logo-icons-slide/4.svg') !!}");

var imgCount = 0;
function startTime() {
		//alert ('here');
    if(imgCount == imgArray.length) {
        imgCount = 0;
    }
    document.getElementById("img1").src = imgArray[imgCount];
    imgCount++;
    setTimeout("startTime()", 5000);
}
</script>