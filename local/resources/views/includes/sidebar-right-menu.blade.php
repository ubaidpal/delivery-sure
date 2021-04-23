<!--Sidebar Right Container-->
<div class="sidebar-right-container">
    <!-- SideBar Trigger Button -->
    <button type="button" class="c-hamburger c-hamburger--htla" data-toggle="modal" data-target="#sidebar-right">
        <span>Right Sidebar Modal</span>
    </button>

    <!-- SideBar - Modal -->
    <div class="modal right fade" id="sidebar-right" tabindex="-1" role="dialog" aria-labelledby="siderbarLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="sidebar-modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h1 class="sidebar-modal-title" id="siderbarLabel">
                        <img src="{!! asset('local/public/assets/images/demedatlogo.png') !!}" alt="image">
                    </h1><!-- /.modal-title -->
                </div><!-- /.modal-header -->

                <div class="modal-body">
                    <ul class="sidebar-menu">
                        <li class="sidebar-menu-item"><a href="{{url('profile-setting')}}">Profile Settings</a></li>
                        @permission('delivery.man')
                        {{--<li class="sidebar-menu-item"><a href="{{url('my-jobs')}}">My Jobs</a></li>--}}
                        <li class="sidebar-menu-item"><a href="{{route('invitations')}}">Invitations</a></li>
                        @endpermission
                        @if(Auth::check())
                            <li class="sidebar-menu-item"><a href="{{route('notifications')}}">Notifications</a>
                                <span class="badge ">{{getNotificationsCount($user->id)}}</span>
                            </li>
                        @endif
                        @if(!$user->is('delivery.man'))
                        <li class="sidebar-menu-item"><a href="{{route('favourite-jobs-purchaser')}}">Favourite Driver</a></li>
                        @endif
                        <li class="sidebar-menu-item"><a href="{{url('change-password')}}">Change Password</a></li>
                        <li class="sidebar-menu-item"><a href="{{url('logout')}}">Signout</a></li>
                    </ul>
                </div><!-- /.modal-body -->
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</div><!-- sidebar-right-container -->
