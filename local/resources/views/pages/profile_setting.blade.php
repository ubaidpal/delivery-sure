@extends('layouts.default')

<!-- Sidebar right menue -->
@include('includes.sidebar-right-menu')


@section('content')

<!-- Profile Setting -->
<div class="profile-setting autoheight">
    <div class="container">
        <div class="col-xs-12">
            <div class="h2b">Settings</div>
        </div><!-- /.col-xs-12 -->

        <div class="row">
            <div class="list-group-green-header col-md-3 col-xs-12">
                <ul class=" list-group">
                    <li class="list-group-item active"><a href="profile_setting.blade.php">My Profile</a></li><!-- /.list-group-item -->
                    <li class="list-group-item"><a href="withdrawls.blade.php">Withdrawls</a></li><!-- /.list-group-item -->
                    <li class="list-group-item"><a href="statements.blade.php">Statements</a></li><!-- /.list-group-item -->
                    <li class="list-group-item"><a href="profile_setting_feedback.blade.php">Feedbacks</a></li><!-- /.list-group-item -->
                    <li class="list-group-item"><a href="change_password.blade.php">Change Password</a></li><!-- /.list-group-item -->
                </ul><!-- /.list-group-green-header -->

                <a class="btn btn-green btn-block" href="javascript:void(0);">PLACE YOUR ORDER</a>
            </div><!-- /.list-group-green-header -->

            <div class="col-md-9 col-xs-12">
                <!-- Edit Profile -->
                <div class="edit-profile list-group">
                    <li class="list-group-item">
                        <div class="row">
                            <div class="edit-profile-image col-md-4 col-xs-6">
                                <div class="h3b">Avatar</div>
                                <div class="edit-profile-img">
                                    <img src="{!! asset('local/public/assets/images/seting-profile.png') !!}" alt="image">
                                </div>
                                <a class="btn btn-green btn-block" href="javascript:void(0);">Upload <span class="hidden-375">a profile</span> image</a>
                            </div><!-- /.col-md-4 -->

                            <div class="profile-setting-information col-md-8 col-xs-12">
                                <div class="h3b">Information</div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="animate-label">First Name</label>
                                            <input type="text" class="form-control form-control-animate-border">
                                        </div><!-- /.form-group animate-label -->
                                    </div><!-- /.col-md-6 -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="animate-label">Last Name</label>
                                            <input type="text" class="form-control form-control-animate-border">
                                        </div><!-- /.form-group animate-label -->
                                    </div><!-- /.col-md-6 -->
                                </div><!-- /.row -->

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="animate-label">Email</label>
                                            <input type="text" class="form-control form-control-animate-border">
                                        </div><!-- /.form-group animate-label -->
                                    </div><!-- /.col-md-12 -->
                                </div><!-- /.row -->

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="animate-label">Gender</label>
                                            <select class="form-control form-control-animate-border">
                                                <option></option>
                                                <option>1</option>
                                            </select>
                                        </div><!-- /.form-group -->
                                    </div><!-- /.col-md-6 -->
                                </div><!-- /.row -->

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="animate-label">Country</label>
                                            <select class="form-control form-control-animate-border">
                                                <option></option>
                                                <option>1</option>
                                            </select>
                                        </div><!-- /.form-group -->
                                    </div><!-- /.col-md-6 -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="animate-label">Phone number</label>
                                            <select class="form-control form-control-animate-border">
                                                <option></option>
                                                <option>1</option>
                                            </select>
                                        </div><!-- /.form-group -->
                                    </div><!-- /.col-md-6 -->
                                </div><!-- /.row -->

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="animate-label">Address</label>
                                            <select class="form-control form-control-animate-border">
                                                <option></option>
                                                <option>1</option>
                                            </select>
                                        </div><!-- /.form-group -->
                                    </div><!-- /.col-md-6 -->
                                </div><!-- /.row -->

                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox">Become a driver
                                    </label>
                                </div>
                            </div><!-- /.profile-setting-information /.col-md-8-->
                        </div><!-- /.row -->
                    </li><!-- /.list-group-item -->
                </div><!-- /.edit-profile /.list-group -->

                <!-- Edit Documents -->
                <div class="edit-documents list-group">
                    <li class="list-group-item">
                        <div class="h3b">Documents</div>

                        <div class="row">
                            <div class="col-md-4 col-xs-6">
                                <div class="id-card-img">
                                    <img src="{!! asset('local/public/assets/images/id-card-front.jpg') !!}"  alt="image">
                                </div>
                                <a class="btn btn-gray btn-block" href="javascript:void(0);">EDIT</a>
                            </div><!-- /.col-md-4 -->
                            <div class="col-md-4 col-xs-6">
                                <div class="id-card-img">
                                    <img src="{!! asset('local/public/assets/images/id-card-back.jpg') !!}" alt="image">
                                </div>
                                <a class="btn btn-gray btn-block" href="javascript:void(0);">EDIT</a>
                            </div><!-- /.col-md-4 -->
                        </div><!-- /.row -->
                    </li><!-- /.list-group-item -->
                </div><!-- /.edit-documents /.list-group -->
            </div><!-- /.col-md-9 -->

        </div><!-- /.row -->
    </div><!-- /.container -->
</div><!-- /.profile-setting -->

@endsection

