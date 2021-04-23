
@extends('layouts.default')

<!-- Sidebar right menue -->
@include('includes.sidebar-right-menu')

@section('content')
<!-- Profile Setting - Change Password-->
<div class="profile-setting">
    <div class="container">
        <div class="col-xs-12">
            <div class="h2b">Change Password</div>
        </div><!-- /.col-xs-12 -->

        <div class="row">
            <div class="list-group-green-header col-md-3 col-xs-12">
                <ul class=" list-group">
                    <li class="list-group-item"><a href="profile_setting.blade.php">My Profile</a></li><!-- /.list-group-item -->
                    <li class="list-group-item"><a href="withdrawls.blade.php">Withdrawls</a></li><!-- /.list-group-item -->
                    <li class="list-group-item"><a href="statements.blade.php">Statements</a></li><!-- /.list-group-item -->
                    <li class="list-group-item"><a href="profile_setting_feedback.blade.php">Feedbacks</a></li><!-- /.list-group-item -->
                    <li class="list-group-item active"><a href="change_password.blade.php">Change Password</a></li><!-- /.list-group-item -->
                </ul><!-- /.list-group-green-header -->
            </div><!-- /.list-group-green-header -->

            <div class="col-md-9 col-xs-12">

                <!-- Change Password -->
                <div class="edit-documents list-group">
                    <li class="list-group-item">
                        <div class="h3b">Change Password</div>

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="animate-label">Old Password</label>
                                    <input type="text" class="form-control form-control-animate-border">
                                </div><!-- /.form-group animate-label -->
                            </div><!-- /.col-md-3 -->
                        </div><!-- /.row -->
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="animate-label">New Password</label>
                                    <input type="text" class="form-control form-control-animate-border">
                                </div><!-- /.form-group animate-label -->
                            </div><!-- /.col-md-3 -->
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="animate-label">Confirm Password</label>
                                    <input type="text" class="form-control form-control-animate-border">
                                </div><!-- /.form-group animate-label -->
                            </div><!-- /.col-md-3 -->
                        </div><!-- /.row -->

                        <a class="btn btn-green" href="javascript:void(0);">UPDATE PASSWORD</a>
                    </li><!-- /.list-group-item -->
                </div><!-- /.edit-documents /.list-group -->


            </div><!-- /.col-md-9 -->

        </div><!-- /.row -->
    </div><!-- /.container -->
</div><!-- /.profile-setting - Change Password-->

@endsection









