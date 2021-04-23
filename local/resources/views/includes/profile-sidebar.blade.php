{{--

    * Created by   :  Muhammad Yasir
    * Project Name : demedat
    * Product Name : PhpStorm
    * Date         : 28-Jun-16 3:33 PM
    * File Name    : 

--}}
<div class="list-group-green-header col-md-3 col-xs-12">
    <ul class=" list-group">
        <li class="list-group-item @if(Request::is('profile-setting')) active @endif"><a
                    href="{{url('/profile-setting/')}}">My Profile</a></li>
        <!-- /.list-group-item -->
        @if($user->is('delivery.man'))
            <li class="list-group-item @if(Request::is('withdrawls') || Request::is('getBankAccount')) active @endif">
                <a href="{{url('withdrawls')}}">Withdrawals</a>
            </li>


            <li class="list-group-item @if(Request::is('statement')) active @endif"><a href="{{route('statement')}}">Statements</a>

            </li><!-- /.list-group-item -->
        @endif
        <li class="list-group-item @if(Request::is('my-feedback')) active @endif">
            <a href="{{url('my-feedback')}}">
                Feedbacks
            </a>
        </li><!-- /.list-group-item -->
        <li class="list-group-item @if(Request::is('settings/privacy')) active @endif">
            <a href="{{route('privacy.settings')}}">
                Privacy Settings
            </a>
        </li><!-- /.list-group-item -->
        <li class="list-group-item @if(Request::is('change-password')) active @endif"><a
                    href="{{url('change-password')}}">Change Password</a></li>
        @if($user->is('retailer'))
        <li class="list-group-item @if(Request::is('contact-us')) active @endif"><a
                    href="{{url('contact-us')}}">Advertise Your Business</a></li>
        @endif
    </ul><!-- /.list-group-green-header -->
    @if(!$user->is('delivery.man'))
        <a class="btn btn-green btn-block" href="{{route('place-order')}}">PLACE YOUR ORDER</a>
    @endif
</div><!-- /.list-group-green-header -->
