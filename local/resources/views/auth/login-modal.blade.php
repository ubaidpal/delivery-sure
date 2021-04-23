{{--

    * Created by   :  Muhammad Yasir
    * Project Name : demedat
    * Product Name : PhpStorm
    * Date         : 15-Jul-16 12:57 PM
    * File Name    :

--}}

@if(Session::get('accessGranted') || (!env('ACCESS_ENABLED') && !Session::get('accessGranted')))
    <div class="modal fade" id="modalLogIn" tabindex="-1" role="dialog"
         aria-labelledby="loginLabel">
        <div class="modal-dialog modal-login" role="document">
            <div class="modal-content">
                <div class="modal-login-header">
                    <img src="{!! asset('local/public/assets/images/login-header.jpg') !!}"
                         alt="image">

                    <h2 class="modal-title" id="loginLabel">SIGN IN</h2>
                </div><!-- /.modal-header -->
                <div class="modal-body">
                    {{--<a href="{{url('social/auth/facebook')}}">FB Login</a>--}}
                    {!! Form::open(['url'=> 'login']) !!}
                    <div class="login-form">

                        <div class="form-group">
                            <label class="">Email <span>*</span></label>
                            <input type="text" class="form-control"
                                   name="email">
                        </div><!-- /.form-group animate-label -->
                        <div class="form-group">
                            <label class="">Password <span>*</span></label>
                            <input type="password"
                                   class="passwordForLogin form-control"
                                   name="password">
                        </div><!-- /.form-group animate-label -->

                    </div><!-- /.login-form -->

                    <div class="btn-container">

                        <button class="btn btn-green pull-left" type="submit">SIGN IN</button>

                        {{--<a class="btn btn-green pull-right" href="{{url('register')}}">SIGN UP</a>--}}

                        <a class="btn btn-green pull-right" data-target="#modalSignUp" data-toggle="modal" data-dismiss="modal">SIGN
                            UP</a>
                    </div>

                    <div class="checkbox">
                        <label><input type="checkbox" name="remember">Remember me</label>
                    </div>
                    <div class="forgot-pass">
                        <a class="btn btn-link" href="{{url('password/reset')}}">Forgot password
                            ?</a>
                    </div>
                    {!! Form::close() !!}
                </div><!-- /.modal-body -->

            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <div class="modal fade" id="modalSignUp" tabindex="-1" role="dialog" aria-labelledby="signupLabel">
        @include('includes.register-form')
    </div>

@endif

<div class="modal fade" id="access-token" tabindex="-1" role="dialog"
     aria-labelledby="loginLabel" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-login" role="document">
        <div class="modal-content">
            <div class="modal-login-header">
                <img src="{!! asset('local/public/assets/images/login-header.jpg') !!}"
                     alt="image">

                <h2 class="modal-title" id="loginLabel">Access Token</h2>
            </div><!-- /.modal-header -->
            <div class="modal-body">
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
            </div><!-- /.modal-body -->

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
