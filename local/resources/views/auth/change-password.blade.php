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
            @include('includes.profile-sidebar')

            <div class="col-md-9 col-xs-12">

                <!-- Change Password -->
                <div class="edit-documents list-group">
                    @include('includes.alerts')
                    {!! Form::open(['route'=>['change-password'],'method'=>'post']) !!}
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <li class="list-group-item">
                        <div class="h3b">Change Password</div>

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="">Old Password</label>
                                    <input required type="password" class="form-control" name="old_password">
                                </div><!-- /.form-group animate-label -->
                            </div><!-- /.col-md-3 -->
                        </div><!-- /.row -->
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="">New Password</label>
                                    <input type="password" class="form-control" name="password" required>
                                </div><!-- /.form-group animate-label -->
                            </div><!-- /.col-md-3 -->
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="">Confirm Password</label>
                                    <input type="password" class="form-control" required name="conformed_password" >
                                </div><!-- /.form-group animate-label -->
                            </div><!-- /.col-md-3 -->
                        </div><!-- /.row -->

                        <button class="btn btn-green" type="submit">UPDATE PASSWORD</button>
                    </li><!-- /.list-group-item -->
                    {!! Form::close() !!}
                </div><!-- /.edit-documents /.list-group -->


            </div><!-- /.col-md-9 -->

        </div><!-- /.row -->
    </div><!-- /.container -->
</div><!-- /.profile-setting - Change Password-->

@endsection









