
@extends('layouts.default')

<!-- Sidebar right menue -->
@include('includes.sidebar-right-menu')

@section('content')

<!-- Notifications -->
<div class="notifications">
    <div class="container">
        <div class="h2b">Notifications</div>

        <!-- Notifications List Group -->
        <div class="notifications-block">
            <!--Notification Item-->
            <div class="notification-item green"  href="javascript:void(0);">
                <div class="message-thread-img">
                    <img src="{!! asset('local/public/assets/images/dummy-profile.jpg') !!}" alt="image">
                </div>
                <span class="h4b">John Doe</span>
                <span>place a bid on the job</span>
                <span class="pull-right">May 05, 2016 5:43PM</span>
            </div><!-- /.notification-item -->

            <!--Notification Item-->
            <div class="notification-item green"  href="javascript:void(0);">
                <div class="message-thread-img">
                    <img src="{!! asset('local/public/assets/images/dummy-profile.jpg') !!}" alt="image">
                </div>
                <span class="h4b">John Doe</span>
                <span>place a bid on the job</span>
                <span class="pull-right">May 05, 2016 5:43PM</span>
            </div><!-- /.notification-item -->

            <!--Notification Item-->
            <div class="notification-item"  href="javascript:void(0);">
                <div class="message-thread-img">
                    <img src="{!! asset('local/public/assets/images/dummy-profile.jpg') !!}" alt="image">
                </div>
                <span class="h4b">John Doe</span>
                <span>place a bid on the job</span>
                <span class="pull-right">May 05, 2016 5:43PM</span>
            </div><!-- /.notification-item -->

            <!--Notification Item-->
            <div class="notification-item"  href="javascript:void(0);">
                <div class="message-thread-img">
                    <img src="{!! asset('local/public/assets/images/dummy-profile.jpg') !!}" alt="image">
                </div>
                <span class="h4b">John Doe</span>
                <span>place a bid on the job</span>
                <span class="pull-right">May 05, 2016 5:43PM</span>
            </div><!-- /.notification-item -->

            <!--Notification Item-->
            <div class="notification-item"  href="javascript:void(0);">
                <div class="message-thread-img">
                    <img src="{!! asset('local/public/assets/images/dummy-profile.jpg') !!}" alt="image">
                </div>
                <span class="h4b">John Doe</span>
                <span>place a bid on the job</span>
                <span class="pull-right">May 05, 2016 5:43PM</span>
            </div><!-- /.notification-item -->


        </div><!-- /.notifications-block /.list-group -->
    </div><!-- /.container -->
</div>

@endsection
