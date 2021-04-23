{{--

    * Created by   :  Muhammad Yasir
    * Project Name : demedat
    * Product Name : PhpStorm
    * Date         : 03-Nov-16 5:25 PM
    * File Name    : 

--}}
<div class="modal-dialog modal-signup" role="document">
    <div class="modal-content">
        <div class="modal-login-header">
            <img src="{!! asset('local/public/assets/images/signup-img.jpg') !!}" alt="image"
                 style="width: 100%; object-fit: cover; height: 74px;">

            <h2 class="modal-title" id="signupLabel">Sign Up</h2>
        </div><!-- /.modal-header -->
        <div class="modal-body">

           @include('includes.alerts')
            <form class="" role="form" method="POST"
                  action="{{ url('/register') }}">
                {{ csrf_field() }}

                <div class="login-form mt10">
                    <div class="form-group">
                        <label class="">Email <span>&ast;</span></label>
                        <input type="text" class="form-control"
                               name="email" value="{{ old('email') }}" required>
                    </div><!-- /.form-group animate-label -->
                    <div class="form-group" id="user_name_block">
                        <label class="">Username <span>&ast;</span></label>
                        <input type="text" class="form-control"
                               name="username" value="{{ old('username') }}" required id="username">

                    </div><!-- /.form-group animate-label -->
                    <div class="form-group">
                        <label class="">Password <span>&ast;</span></label>
                        <input type="password" class="form-control"
                               name="password" value="" required>
                    </div><!-- /.form-group animate-label -->
                    <div class="form-group">
                        <label class="">Retype Password <span>&ast;</span></label>
                        <input type="password" class="form-control"
                               name="password_confirmation" value="" required>
                    </div><!-- /.form-group animate-label -->
                    <div class="form-group">
                        <label class="">Full Name <span>&ast;</span></label>
                        <input type="text" class="form-control"
                               name="first_name" value="{{ old('first_name') }}" required>
                    </div><!-- /.form-group animate-label -->
                    <div class="form-group">
                        <label class="">Phone number <span>*</span></label>
                        <input type="tel" class="form-control" name="phone_number"
                               value="{{old('phone_number')}}" required>
                    </div>
                    <div class="form-group">
                        <label class="">Account Type <span>*</span></label>
                        {!! Form::select('user_type',config('constant_settings.USERS'),old('user_type'),['class'=> 'form-control','id' => 'user_type']) !!}
                    </div>
                    <?php
                         $userType = old('user_type');
                    ?>
                    <div class="form-group" id="referral_id" style="display: @if($userType == config('constant_settings.USER_TYPES.RETAILER')) block @else none @endif;">
                        <label class="">Referrer ID </label>
                        <input class="form-control" type="text" value="{{old('referrer_id')}}" name="referrer_id">
                    </div>
                </div><!-- /.login-form -->


                <div class="signup-footer">
                    <button class="btn btn-green" type="submit" id="register">SIGN UP</button>
                    <p>By signing up you agree to our <a href="#">Terms of Service</a> and <a href="#">Privacy
                            Policy</a>.</p>
                </div>

            </form>
        </div><!-- /.modal-body -->

    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->

<script>
    var taken = true;
    $(function () {
        $('#user_type').change(function () {
            var userType = $(this).val();
            if (userType == 102) {
               // var field = '<label class="">Referrer ID </label> <input type="input" class="form-control" name="referrer_id" value="">';
                $('#referral_id').show();
            } else {
                $('#referral_id').hide();
            }
        });

        $('#username').change(function () {
            var val = $(this).val();
            var _this = $(this);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val()
                }
            });

            $.ajax({
                type: "POST",
                url: "{{route('check-username')}}",
                data: {username: val},
                success: function (data) {
                    if (data > 0) {
                        var html = '<div class="text error" id="error" style="color:darkred">User name already taken.</div>';
                        $('#user_name_block').find('#error').remove();
                        $('#user_name_block').append(html)
                        _this.css({
                            border: "1px solid darkred"
                        });
                        taken = true;
                    } else {
                        taken = false;
                        _this.css({
                            border: "1px solid #ccc"
                        });
                        $('#user_name_block').find('#error').remove();
                    }
                }
            })
        });

        $('#register').click(function () {
            if (taken) {
                return false;
            }
        });
    });</script>

