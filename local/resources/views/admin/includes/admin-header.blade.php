<div class="header-main" data-url="{{URL::to('/')}}">
    <div class="header-container">
        <a class="logo" title="Kinnect2" href="{{url('/home')}}"></a>
        <ul>
            <li class="profile-tooltip admin">
                {{--<a class="profile" href="javascript:void(0);" id="profileLink"
                   data-username="{{Auth::user()->display_name}}" data-socket="{{Auth::user()->id}}">
                   --}}{{--{{ Auth::user()->display_name }}--}}{{--Admin
                </a>--}}
                <a class="profile" href="{{url('/logout')}}" title="Signout">Signout</a>
                <!--<div id = "popUp"></div>-->
                <div id="popUpText">
					<a href="{{url('/logout')}}" title="Signout">Signout</a>
                </div>
            </li>
        </ul>
    </div>
</div>
