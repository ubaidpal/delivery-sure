
@extends('layouts.default')

<!-- Sidebar right menue -->
@include('includes.sidebar-right-menu')


@section('content')

<!-- Profile Setting - Feedback -->
<div class="profile-setting autoheight">
    <div class="container">
        <div class="col-xs-12">
            <div class="h2b">Settings</div>
        </div><!-- /.col-xs-12 -->

        <div class="row">
            <div class="list-group-green-header col-md-3 col-xs-12">
                <ul class=" list-group">
                    <li class="list-group-item"><a href="profile_setting.blade.php">My Profile</a></li><!-- /.list-group-item -->
                    <li class="list-group-item"><a href="withdrawls.blade.php">Withdrawls</a></li><!-- /.list-group-item -->
                    <li class="list-group-item"><a href="statements.blade.php">Statements</a></li><!-- /.list-group-item -->
                    <li class="list-group-item active"><a href="profile_setting_feedback.blade.php">Feedbacks</a></li><!-- /.list-group-item -->
                    <li class="list-group-item"><a href="change_password.blade.php">Change Password</a></li><!-- /.list-group-item -->
                </ul><!-- /.list-group-green-header -->
            </div><!-- /.list-group-green-header -->

            <div class="statement-container col-md-9 col-xs-12">
                <ul class="list-group">
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-xs-6">
                                <div class="h3b">Feedback</div>
                            </div><!-- /.col-xs-6 -->
                        </div><!-- /.row -->
                    </li><!-- /.list-group-item -->

                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-xs-6">
                                <div class="h4b">Order</div>
                            </div><!-- /.col-xs-6 -->
                            <div class="col-xs-3">
                                <div class="h4b">User</div>
                            </div><!-- /.col-xs-3 -->
                            <div class="col-xs-3">
                                <div class="h4b">Feedback State</div>
                            </div><!-- /.col-xs-3 -->
                        </div><!-- /.row -->

                    </li><!-- /.list-group-item -->

                    <li class="statement-list list-group-item">

                        <!-- Nested List Group - Statement List -->
                        <ul class="list-group">
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-xs-6">
                                        <div class="h4g"><a href="job_in_progress_feedback.blade.php"> I need my goods delivered...</a></div>
                                    </div>
                                    <div class="col-xs-3">John Doe</div>
                                    <div class="col-xs-3">Pending</div>
                                </div><!-- /.row -->
                            </li><!-- /.list-group-item -->

                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-xs-6">
                                        <div class="h4g"><a href="job_in_progress_feedback.blade.php"> I need my goods delivered...</a></div>
                                    </div>
                                    <div class="col-xs-3">John Doe</div>
                                    <div class="col-xs-3">Pending</div>
                                </div><!-- /.row -->
                            </li><!-- /.list-group-item -->

                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-xs-6">
                                        <div class="h4g">I need my goods delivered...</div>
                                    </div>
                                    <div class="col-xs-3">John Doe</div>
                                    <div class="col-xs-3">Pending</div>
                                </div><!-- /.row -->
                            </li><!-- /.list-group-item -->

                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-xs-6">
                                        <div class="h4g">I need my goods delivered...</div>
                                    </div>
                                    <div class="col-xs-3">John Doe</div>
                                    <div class="col-xs-3">Pending</div>
                                </div><!-- /.row -->
                            </li><!-- /.list-group-item -->

                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-xs-6">
                                        <div class="h4g">I need my goods delivered...</div>
                                    </div>
                                    <div class="col-xs-3">John Doe</div>
                                    <div class="col-xs-3">Pending</div>
                                </div><!-- /.row -->
                            </li><!-- /.list-group-item -->

                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-xs-6">
                                        <div class="h4g">I need my goods delivered...</div>
                                    </div>
                                    <div class="col-xs-3">John Doe</div>
                                    <div class="col-xs-3">Pending</div>
                                </div><!-- /.row -->
                            </li><!-- /.list-group-item -->

                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-xs-6">
                                        <div class="h4g">I need my goods delivered...</div>
                                    </div>
                                    <div class="col-xs-3">John Doe</div>
                                    <div class="col-xs-3">Pending</div>
                                </div><!-- /.row -->
                            </li><!-- /.list-group-item -->

                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-xs-6">
                                        <div class="h4g">I need my goods delivered...</div>
                                    </div>
                                    <div class="col-xs-3">John Doe</div>
                                    <div class="col-xs-3">Pending</div>
                                </div><!-- /.row -->
                            </li><!-- /.list-group-item -->

                        </ul><!-- /.list-group - Nested -->
                    </li><!-- /.list-group-item -->
                </ul><!-- /.place-an-order-group .list-group -->
            </div>

        </div><!-- /.row -->
    </div><!-- /.container -->
</div><!-- /.profile-setting - Feedback -->

@endsection
