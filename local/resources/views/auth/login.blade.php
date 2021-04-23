@extends('layouts.home')

@section('title', 'Login')

@section('content')
    <div class="container">
        <div class="login-wrapper">

            <div class="modal-login-header">
                <img src="{!! asset('local/public/assets/images/login-header.jpg') !!}" alt="image">

                <h2 class="modal-title" id="loginLabel">Login</h2>
            </div><!-- /.modal-header -->
            <div class="modal-body">
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if (session('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                @endif
                @if (session('warning'))
                    <div class="alert alert-warning">
                        {{ session('warning') }}
                    </div>
                @endif

                @if(Session::get('accessGranted') || (!env('ACCESS_ENABLED') && !Session::get('accessGranted')))
                    {!! Form::open(['url'=> 'login']) !!}
                    <div class="login-form">

                        <div class="form-group">
                            <label class="">Email <span>&ast;</span></label>
                            <input type="text" class="form-control" name="email"
                                   value="{{ old('email') }}">
                        </div><!-- /.form-group animate-label -->
                        <div class="form-group">
                            <label class="">Password <span>&ast;</span></label>
                            <input type="password" class="passwordForLogin form-control"
                                   name="password">
                        </div><!-- /.form-group animate-label -->

                    </div><!-- /.login-form -->

                    <div class="btn-container">
                        <button class="btn btn-green" type="submit">LOGIN</button>
                        <a class="btn btn-green " href="{{url('register')}}">SIGN UP</a>

                    </div>

                    <div class="checkbox">
                        <label><input type="checkbox" name="remember">Remember me</label>
                    </div>
                    <div class="forgot-pass">
                        <a class="btn btn-link" href="{{url('password/reset')}}">Forgot password ?</a>
                    </div>
                    {!! Form::close() !!}
                @else
                    {!! Form::open(['url'=> 'access-token']) !!}
                    <div class="login-form">
                        @include('includes.alerts')
                        <div class="form-group">
                            <label class="">Access Token <span>*</span></label>
                            <input type="password" class="form-control"
                                   name="token" required>
                        </div><!-- /.form-group animate-label -->

                    </div><!-- /.login-form -->

                    <div class="btn-container">
                        <button class="btn btn-green pull-right" type="submit">Submit</button>
                    </div>
                    {!! Form::close() !!}
                @endif
            </div><!-- /.modal-body -->
        </div>
    </div>
@endsection
