<!-- Header Default-->
<?php  ///echo '<tt><pre>'; print_r($user); die;
$default = '';
$other = '';
if(Auth::check() && !empty($user)) {
    if($user->is('purchaser')) {
        $default = config('constant_settings.MARKERS.PURCHASER.DEFAULT');
        $other   = config('constant_settings.MARKERS.PURCHASER.OTHER');
    } elseif($user->is('retailer')) {
        $default = config('constant_settings.MARKERS.RETAILER.DEFAULT');
        $other   = config('constant_settings.MARKERS.RETAILER.OTHER');
    } else {
        $default = config('constant_settings.MARKERS.DRIVER.DEFAULT');
        $other   = config('constant_settings.MARKERS.DRIVER.OTHER');
    }

} else {
    $default = config('constant_settings.MARKERS.PURCHASER.DEFAULT');
    $other   = config('constant_settings.MARKERS.PURCHASER.OTHER');
}

?>

@inject('str','\Illuminate\Support\Str')
<header id="header" class="header-fixed respons" data-default="{{$default}}" data-other="{{$other}}"
        data-type="{{config('constant_settings.USER_ROLES.'.(!empty($user)?$user->user_type:''))}}">
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
                <a class="navbar-brand" href="{{url('/')}}"><img src="{!! asset('local/public/assets/images/demedatlogo.png') !!}"
                                                                 alt="image"></a>

            </div><!-- /.navbar-header -->

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    {{-- <li><a href="javascript:void(0);">EARN CASH</a></li>
                     <li><a href="javascript:void(0);">SHOPPERS</a></li>--}}
                    @if(isset($user) && !$user->is('delivery.man'))
                        <li @if(Request::is('find-driver'))
                            class="active"
                                @endif>
                            <a href="{{route('find-driver')}}"><span data-hover="FIND DRIVER">FIND DRIVER</span></a>
                        </li>
                    @endif
                    @permission('delivery.man')
                    <li @if(Request::is('dashboard'))
                        class="active"
                            @endif>
                        <a href="{{route('dashboard')}}"><span data-hover="HOME">HOME</span></a>
                    </li>
                    <li @if(Request::is('my-jobs') OR  Request::is('my-proposals') OR  Request::is('my-jobs/all')) class="active" @endif>
                        <a href="{{route('my-jobs')}}">
                            <span data-hover="MY JOBS">MY JOBS</span>
                        </a>
                    </li>
                    {{-- <li @if(Request::is('my-proposals')) class="active" @endif>
                         <a href="{{route('my-proposals')}}">
                             <span data-hover="MY PROPOSALS">MY PROPOSALS</span>
                         </a>
                     </li>--}}
                    @endpermission
                    @if(!empty($user) && !$user->is('delivery.man'))
                        <li @if(Request::is('my-orders')) class="active" @endif>
                            <a href="{{route('my-orders')}}">
                                <span data-hover="MY ORDERS">MY ORDERS</span>
                            </a>
                        </li>
                    @endif
                    @role('delivery.man')
                    <li @if(Request::is('favourite-jobs')) class="active" @endif>
                        <a href="{{route('favourites')}}">
                            <span data-hover="SAVED JOBS">SAVED JOBS</span>
                        </a>
                    </li>
                    @endrole
                    <li @if(Request::is('messages')) class="active" @endif>
                        <a href="{{route('messages')}}">
                            <span data-hover="MESSAGES">MESSAGES</span>
                        </a>
                        <?php
                        $msgCount = 0;
                        if(!empty($user)) {
                            $msgCount = unReadMessageCount($user->id);
                        }


                        ?>
                        @if($msgCount > 0)
                            <span class="badge ">{{unReadMessageCount($user->id)}}</span>
                        @endif
                    </li>
                    <li @if(Request::is('notifications')) class="active" @endif>
                        <a href="{{route('notifications')}}">
                            <span data-hover="NOTIFICATIONS">NOTIFICATIONS</span>
                        </a>
                        <?php
                        $notiCount = 0;
                        if(!empty($user)) {
                            $notiCount = getNotificationsCount($user->id);
                        }
                        ?>
                        @if($notiCount > 0)
                            <span class="badge ">{{getNotificationsCount($user->id)}}</span>
                        @endif
                    </li>

                </ul><!-- /.navbar-nav -->
                @if(!empty($user) && isset($user) && !$user->is('delivery.man'))
                    <a class="btn btn-white navbar-btn hidden-sm hidden-xs" href="{{route('place-order')}}">Place An
                        Order</a><!-- /.hidden-xs -->
                @endif
                <div class="pull-right"  >
                    <a class="profile-icon hidden-xs" href="javascript:void(0)" data-target="#sidebar-right" data-toggle="modal">
                        <div class="profile-name hidden-md hidden-sm">Hi, <span>
                            @if(Auth::check() && !empty($user))

                                    {{limit_char($user->display_name) }}
                                    <?php $photo = $user->profile_photo_url?>
                                @else

                                @endif
                        </span>
                        </div>
                        <div class="profile-img pull-right">
                            <img src="{!! getImage(isset($photo)?$photo:'', '41x41') !!}"
                                 alt="img" data-target="#sidebar-right" data-toggle="modal">

                        </div>
                    </a><!-- /.profile-icon -->

                </div>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container -->
    </nav><!-- /.navbar-default -->
</header>
<div class="clearfix"></div>

