<!-- Header -->
<header class="header-fixed">
    <nav class="navbar navbar-default">
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
                <a class="navbar-brand" href="{{url('/')}}"><img
                            src="{!! asset('local/public/assets/images/demedatlogo.png') !!}" alt="image"></a>
            </div><!-- /.navbar-header -->


            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

                <!-- Button trigger modal - SignUp Page-->
                @if(Session::get('accessGranted') || (!env('ACCESS_ENABLED') && !Session::get('accessGranted')))
                    @if(!Auth::check())
                        {{-- <a  class="btn btn-white navbar-btn" href="{{url('register')}}">REGISTER WITH US</a>--}}
                        <a data-target="#modalSignUp" data-toggle="modal" class="btn btn-white navbar-btn"
                           href="javascript:void(0);">Sign Up</a>
                        @endif
                        @endif
                                <!-- /.hidden-xs -->

                        <!-- Modal - Register -->

                        <!-- /.modal -->
                        <ul class="nav navbar-nav navbar-left">
                            <li @if(Request::is('purchaser')) class="active" @endif><a
                                        href="{{route('purchaser')}}"><span
                                            data-hover="Purchaser">Purchaser</span></a>
                            </li>
                            <li @if(Request::is('delivery-driver')) class="active" @endif><a
                                        href="{{route('delivery-driver')}}"><span data-hover="Delivery Person">Delivery Person</span></a>
                            </li>
                            <li @if(Request::is('retailer')) class="active" @endif><a
                                        href="{{route('retailer')}}"><span data-hover="Retailer">Retailer</span></a>
                            </li>
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
                                                <!-- Modal - LogIn -->
                                    @endif
                            </li>
                        </ul><!-- /.navbar-nav -->
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container -->
    </nav><!-- /.navbar-default -->
</header>
<script src="{!! asset('local/public/assets/js/custom.js') !!}"></script>
