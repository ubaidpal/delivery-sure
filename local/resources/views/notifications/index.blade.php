{{--

    * Created by   :  Muhammad Yasir
    * Project Name : demedat
    * Product Name : PhpStorm
    * Date         : 22-Jul-16 12:47 PM
    * File Name    : 

--}}

@extends('layouts.default')

<!-- Sidebar right menue -->


@section('content')
    @include('includes.sidebar-right-menu')
    <!-- Notifications -->
    <div class="notifications">
        <div class="container">
            <div class="h2b">Notifications</div>

            <!-- Notifications List Group -->
            <div class="clearfix">
                @include('includes.alerts')
            </div>
            <div class="notifications-block">
                <!--Notification Item-->
                @if(count($notifications) > 0)
                    @foreach($strings as $notification)
                        <a href="{{url($notification['notificationUrl'])}}">
                            <div class="notification-item @if($notification['is_clicked'] == 0 ) green @endif">

                                <div class="message-thread-img">
                                    <img src="{!! $notification['userData']['profile_picture'] !!}" alt="image">
                                </div>
                                {{--<span class="h4b">{{$notification['userData']['display_name']}}</span>--}}
                                <span>{!! $notification['string']!!}</span>
                                <span class="pull-right">
                        {{getTimeByTZ($notification['date'],'M d, Y H:i A')}}
                    </span>

                            </div><!-- /.notification-item -->
                        </a>
                    @endforeach

                @else
                    <div class="notification-item">
                        No Record found
                    </div>
                @endif

            </div><!-- /.notifications-block /.list-group -->
            @if(count($notifications) > 0)
                {!! $notifications->render() !!}
            @endif
        </div><!-- /.container -->
    </div>

@endsection
