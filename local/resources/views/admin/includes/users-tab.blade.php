{{--

    * Created by   :  Muhammad Yasir
    * Project Name : demedat
    * Product Name : PhpStorm
    * Date         : 13-Jul-16 3:10 PM
    * File Name    : 

--}}
<div class="task-tabs">
    <a href="{{route('admin.users')}}" title="Admin Users"
       class="@if(\Request::is('admin/users')) active @endif">Active Users</a>
    <a href="{{route('admin.users.pending')}}" title="Admin Users"
       class="@if(\Request::is('admin/pending-approvals')) active @endif">Pending Approvals</a>
    {{--<a href="{{route('normal.users')}}" title="Normal Users"
       class="@if(\Request::is('admin/normal-users')) active @endif">Normal Users</a>

    <a class="orngBtn fltR" href="{{url('admin/users/create')}}" style="padding: 0 10px;" title="Add User">Add
        User</a>--}}

</div>
