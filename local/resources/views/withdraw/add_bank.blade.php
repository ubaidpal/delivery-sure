@extends('layouts.default')

        <!-- Sidebar right menue -->



@section('content')
    @include('includes.sidebar-right-menu')
    <div class="col-xs-12">
        <div class="h2b">Add Bank Account</div>
    </div><!-- /.col-xs-12 -->

    @include('includes.profile-sidebar')

    <div class="add-bank-account list-group col-md-9 col-xs-12">
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

            <div class="h3b">Add Bank Account</div>
            {!! Form::open(['url' => url("/addBankAccount"), "id" => "myForm"]) !!}

            <div class="form-group mt20">
                <label class="">Full Name <span>&ast;</span></label>
                <input type="text" name="full_name" value="{{$bank->account_title}}"
                       class="form-control" required>
                <span>{{$errors->has('full_name')}}</span>
            </div><!-- /.form-group animate-label -->

            <div class="form-group">
                <label class="">Billing Address Line 1 <span>&ast;</span></label>
                <input type="text" name="permanent_billing_address" value="{{$bank->permanent_billing_address}}"
                       class="form-control" required>
            </div><!-- /.form-group animate-label -->

            <div class="form-group">
                <label class="">Billing Address Line 2</label>
                <input type="text" name="temp_billing_address" value="{{$bank->temp_billing_address}}"
                       class="form-control inp">
            </div><!-- /.form-group animate-label -->

            <div class="form-group">
                <label class="">Billing Address Line 3 </label>
                <input type="text" name="temp_billing_address_2" value="{{$bank->temp_billing_address_2}}"
                       class="form-control">
            </div><!-- /.form-group animate-label -->

            <div class="form-group">
                <label class="">City <span>&ast;</span></label>
                <input type="text" name="city" value="{{$bank->city}}"
                       class="form-control  inp" required>
            </div><!-- /.form-group animate-label -->

            <div class="form-group">
                <label class="">State <span>&ast;</span></label>
                <input type="text" name="state" value="{{$bank->state}}"
                       class="form-control  inp" required>
                <span>{{$errors->has('state')}}</span>

                <div class="note">Up to 4 letters, numbers or spaces e.g. New York becomes NY</div>
            </div><!-- /.form-group animate-label -->

            <div class="form-group">
                <label class="">Passcode <span>&ast;</span></label>
                <input type="text" name="post_code" value="{{$bank->post_code}}"
                       class="form-control  inp" required>
            </div><!-- /.form-group animate-label -->

            <div class="form-group focus">
                <label class="">Country <span>&ast;</span></label>
                <select class="form-control  sel" required name="country">
                	<option>Select Country</option>
                    @foreach($countries as $key => $value)
                        <option value="{{$key}}"
                                @if($key == @$bank->country_code) selected="selected" @endif>{{$value}}</option>
                    @endforeach
                </select>
            </div><!-- /.form-group -->

            <div class="form-group">
                <label class="">Account Number <span> &lowast; : </span></label>
                <input type="text" name="account_number" value="{{$bank->account_number}}"
                       class="form-control " required>
                <span>{{$errors->has('account_number')}}</span>
            </div><!-- /.form-group animate-label -->

            <div class="form-group">
                <label class="">IBAN Number <span>&ast;</span></label>
                <input type="text" name="iban_number" value="{{$bank->iban_number}}"
                       class="form-control  inp" required>

                <div class="note">Up to 34 numbers and letters</div>
            </div><!-- /.form-group animate-label -->

            <div class="form-group">
                <label class="">SWIFT Code <span>&ast;</span></label>
                <input type="text" name="swift_code" value="{{$bank->swift_code}}"
                       class="form-control  inp" required>
            </div><!-- /.form-group animate-label -->

            <div class="form-group">
                <label class="">Full Bank Name <span>&ast;</span></label>
                <input type="text" name="bank_name" value="{{$bank->bank_name}}"
                       class="form-control  inp" required>
            </div><!-- /.form-group animate-label -->

            <div class="form-group">
                <label class="">Bank Branch City <span>&ast;</span></label>
                <input type="text" name="bank_branch_city" value="{{$bank->bank_branch_city}}"
                       class="form-control  inp" required>
            </div><!-- /.form-group animate-label -->

            <div class="form-group focus">
                <label class="">Bank Branch Country <span>&ast;</span></label>
                <select class="form-control  sel" required name="branch_country">
                    @foreach($countries as $key => $value)
                        <option value="{{$key}}" @if($key == @$bank->bank_branch_country_code)
                        selected="selected" @endif>{{$value}}</option>
                    @endforeach
                </select>
            </div><!-- /.form-group -->

            <div class="btn-container">
                <button type="submit" class="btn btn-green" id="save_btn">Save</button>
                <a class="btn btn-gray" href="{{url('/withdrawls')}}">Cancel</a>
            </div>
            {!! Form::close() !!}
        </li><!-- /.list-group-item -->
    </div><!-- /.add-bank-account /.list-group /.col-md-9 -->
    <style>
        .my-error-class {
            color: red;
        }

        .my-valid-class {
            color: green;
        }

    </style>

@endsection
@section('footer-scripts')
    <script src="{{url('local/public/assets/js/jquery.validate.min.js')}}"></script>
    <script type="text/javascript">
        jQuery(document).ready(function (e) {
            jQuery('#myForm').validate({
                errorElement: 'span',
                errorClass: "my-error-class",
                validClass: "my-valid-class",
                rules: {
                    'full_name': {required: true},
                    'state': {maxlength: 4},
                    'account_number': {required: true, number: true},
                    'swift_code': {required: true},
                    'bank_name': {required: true},
                    'iban_number': {maxlength: 34, alphanumeric: true}
                },
            });
        });

        jQuery.validator.addMethod("alphanumeric", function (value, element) {
            return this.optional(element) || /^[a-zA-Z0-9]+$/.test(value);
        }, 'IBAN can contain alphanumeric value only');

    </script>
@stop
