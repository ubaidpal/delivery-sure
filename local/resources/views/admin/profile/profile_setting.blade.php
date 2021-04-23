@extends('admin.layout.default')

@section('styles')
{!! HTML::style('local/public/assets/admin/css/plugins/morris.css') !!}

        <!-- Custom Fonts -->

{!! HTML::style('local/public/assets/admin/font-awesome/css/font-awesome.min.css') !!}

{!! HTML::style('local/public/assets/css/jquery-ui.css') !!}

@stop
@section('content')
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Update Profile
                    </h1>
                    @if(Session::has('message'))
                        <div class="alert alert-success fade in">
                            <a href="#" class="close" data-dismiss="alert {{ Session::get('alert-class display-success', 'alert-info') }}" aria-label="close">&times;</a>
                            <strong>Success!</strong> {{ Session::get('message') }}
                        </div>
                    @endif
                    @if(Session::has('wrongMessage'))
                        <div class="alert alert-danger fade in">
                            <a href="#" class="close" data-dismiss="alert {{ Session::get('alert-class display-success', 'alert-info') }}" aria-label="close">&times;</a>
                            <strong>Success!</strong> {{ Session::get('wrongMessage') }}
                        </div>
                    @endif

                    {!! Form::model(null , ['method' => 'PATCH', 'url' => "admin/updateProfile", "enctype"=>"multipart/form-data" ,"id" =>"profileUpdate"]) !!}

                    @if (count($errors) > 0)
                        <div class="alert alert-danger" style="width:100%;line-height: 20px;
                color: #ff0000;">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <span>
                        <li>{{ $error }}</li>
                        </span>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="form-group">
                        <label for="user-title">First Name</label>
                        <input  class="form-control" value="{{$user->first_name}}" type="text" name="first_name" placeholder="First Name">
                    </div>
                    <div class="form-group">
                        <label for="user-title">Last Name *</label>
                        <input  class="form-control" type="text"  value="{{$user->last_name}}" name="last_name" placeholder="Last Name">
                    </div>

                    <div class="form-group">
                        <label for="user-title">Gender</label>
                        <select name="gender" id="gender" class="form-control">
                            <option value="1" <?php if(isset($user->gender)) {
                                if($user->gender == 1)
                                    echo 'selected="selected"';
                            } ?>>
                                Male
                            </option>
                            <option value="2" <?php if(isset($user->gender)) {
                                if($user->gender == 2)
                                    echo 'selected="selected"';
                            } ?>>
                                Female
                            </option>
                        </select>
                        @if($errors->first('gender'))
                            <span>{{ $errors->first('gender') }}</span>
                        @endif
                    </div>
                        <div class="form-group @if(isset($user->dob)) @if($user->dob != '')  focus @endif @endif">
                            <label class="user-title">Date of Birth</label>
                            <input  type="text" name="dob" value="{{$user->dob}}"
                                   class="form-control" id="dob">
                            @if($errors->first('dob'))
                                <span>{{ $errors->first('dob') }}</span>
                            @endif
                        </div><!-- /.form-group -->

                    <div class="form-group">
                        <label class="user-title">Country</label>
                        <?php $selectedCountry = ''; ?>
                        @if(isset($user->country))
                            @if($user->country != '')
                                <?php $selectedCountry = $user->country; ?>
                            @endif
                        @endif
            {!! Form::select('country', $countries, $selectedCountry, array(
              'name'=>'country',
              'class' => 'form-control','placeholder' => 'Select Country','required'))  !!}

                        @if($errors->first('country'))
                            <span>{{ $errors->first('country') }}</span>
                        @endif
                    </div>
                    <div class="form-group @if(isset($user->phone_number)) @if($user->phone_number != '')  focus @endif @endif">
                        <label class="user-title">Phone Number</label>
                        <input type="text" name="phone_number"
                               value="{{$user->phone_number}}"
                               class="form-control">
                        @if($errors->first('phone_number'))
                            <span>{{ $errors->first('phone_number') }}</span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="user-title">Address </label>
                        <input  class="form-control" type="text" value="{{$user->address}}" name="address" placeholder="Address">
                    </div>
                    <button type="submit" class="btn btn-default saveProfile">Update</button>
                    <a href="{{url('admin')}}"  class="btn btn-primary" type="submit">Cancel</a>
                    <input type="hidden" name="_token" value="{{Session::token()}}">

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>




@stop

@section('scripts')
    {!! HTML::script('local/public/assets/js/jquery.validate.min.js') !!}
    {!! HTML::script('local/public/assets/admin/js/jquery-ui.js') !!}
    <style>
        .error {
            color:#FF0000;
        }

    </style>
    <script type="text/javascript">

        $("#dob").datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: 'yy-mm-dd',
            yearRange: "-90:+0",
            maxDate: 0,
            inline: true,
            showOtherMonths: true,
            dayNamesMin: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat']
        });
        jQuery(document).on('click','.saveProfile',function (e) {
            e.preventDefault();
            jQuery('#profileUpdate').submit();
        });

        $.validator.addMethod('customphone', function (value, element) {
            return this.optional(element) || /^[+]?([0-9]*[\.\s\-\(\)]|[0-9]+){3,24}$/.test(value);
        }, "Please enter a valid phone number");
        jQuery(document).ready(function(e){
            jQuery('#profileUpdate').validate({
                errorElement : 'span',
                rules : {
                    'first_name' : {required:true},
                    'last_name' : {required:true},
                    'gender' : {required:true},
                    'country' : {required:true},
                    'phone_number' :"customphone",
                    'address' : {required:true}
                }
            });
        });
        $('.close').click(function(e){
            $('.alert').hide('slow');

        });
    </script>

@stop

