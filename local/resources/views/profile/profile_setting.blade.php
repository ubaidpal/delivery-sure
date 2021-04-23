@extends('layouts.default')
@section('styles')
    {!! HTML::style('local/public/assets/plugins/jquery-cropper/css/cropper.min.css') !!}
    {!! HTML::style('local/public/assets/plugins/jquery-cropper/css/main.css') !!}
    <style>
        .modal-header {
            position: static;
            top: 0;
            left: 0;
            width: 100%;
            background-color: #77c720;
            z-index: 0;
            padding: 10px 15px;
            margin-bottom: 15px;
        }

        .modal-header h4 {
            color: #ffffff;
            font-size: 16px;
            font-weight: bold;
            margin: 8px 0 0 0;
            text-transform: uppercase;
        }

        .modal-header .close {
            font-size: 30px;
            /* margin-top: 4px; */
            color: #000;
        }

        #address-map {
            width: 100%;
            height: 300px;
        }
    </style>
@endsection

@section('content')
    @include('includes.sidebar-right-menu')
    <!-- Profile Setting -->
    <div class="profile-setting autoheight">
        {!! Form::open(['name'=>'profile_setting', 'url'=>'profile-setting', 'class' => 'test profile_setting']) !!}
        <div class="container">
            <div class="col-xs-12">
                <div class="h2b pull-left">Settings</div>
                <div class="pull-right mt10 row">
                    <a href="{{route('profile',[encodeId($user->id,'favourite')])}}" class="btn btn-green btn-block mw160 update-profile">
                        View Your Public Profile
                    </a>
                </div>
            </div><!-- /.col-xs-12 -->

            <div class="row">
                @include('includes.profile-sidebar')


                <div class="col-md-9 col-xs-12">
                    @permission('delivery.man')
                    @if($user->approved != 1)
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                        aria-hidden="true">×</span>
                            </button>
                            Your profile is not approved. Please review your profile. Thanks.
                        </div>
                    @endif
                    @if(!is_null($user->approval_comment) && !empty($user->approval_comment) &&  $user->approved != 1)
                        <div class="alert alert-warning alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                        aria-hidden="true">×</span>
                            </button>
                            {{$user->approval_comment}}
                        </div>
                    @endif

                    @endpermission
                <!-- Edit Profile -->
                    <div class="edit-profile list-group">
                        <li class="list-group-item">
                            <div class="row">
                                <div class="edit-profile-image col-md-4 col-xs-8">
                                    <div class="h3b">Avatar</div>
                                    <div class="crop-avatar edit-profile-img">
                                        @if($user->profile_photo_url !='')
                                            <img id="profile_photo" src="{!! getImage($user->profile_photo_url,'254x254') !!}"
                                                 class="img-responsive" alt="promotion banner">
                                        @else
                                            <img id="profile_photo"
                                                 src="{!! asset('local/public/assets/images/default-user-image.png') !!}"
                                                 alt="image">                       @endif

                                    </div>
                                    <a class="btn btn-green btn-block edit-item crop-avatar"
                                       href="javascript:void(0);"
                                       data-aspect-ratio="1/1" data-height="252" data-width="252"
                                       data-item-id="{{"profile_photo"}}" data-target-field="#profile_image_file" data-ratio="fixed">Upload
                                        <span class="hidden-375">a profile</span> image</a>
                                </div><!-- /.col-md-4 -->

                                <div class="profile-setting-information col-md-8 col-xs-12">
                                    <div class="h3b">Information</div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group @if(isset($user->first_name)) @if($user->first_name != '')  focus @endif @endif">
                                                <label class="">Full Name</label>
                                                <input type="text" name="first_name" value="{{$user->first_name}}"
                                                       class="form-control">
                                                @if($errors->first('first_name'))
                                                    <span>{{ $errors->first('first_name') }}</span>
                                                @endif
                                            </div><!-- /.form-group animate-label -->
                                        </div><!-- /.col-md-6 -->
                                        <div class="col-md-6">
                                            <div
                                                    class="form-group @if(isset($user->last_name)) @if($user->last_name != '')  focus @endif @endif" id="user_name_block">
                                                <label class="">Username</label>
                                                <input type="text" name="username" value="{{$user->username}}"
                                                       class="form-control" id="username">
                                                @if($errors->first('username'))
                                                    <span>{{ $errors->first('username') }}</span>
                                                @endif
                                            </div><!-- /.form-group animate-label -->
                                        </div><!-- /.col-md-6 -->
                                    </div><!-- /.row -->

                                <!--<div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group @if(isset($user->email)) @if($user->email != '')  focus @endif @endif">
                                            <label class="animate-label">Last Name</label>
                                            <input type="text" name="email" placeholder="{{$user->email}}" value="{{$user->email}}" class="form-control form-control-animate-border">
                                            @if($errors->first('email'))
                                    <span>{{ $errors->first('email') }}</span>
                                                @endif
                                        </div>--><!-- /.form-group animate-label -->
                                    <!--</div>--><!-- /.col-md-12 -->
                                    <!--</div>--><!-- /.row -->

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group focus">
                                                <label class="">Gender</label>
                                                <select name="gender" id="gender"
                                                        class="form-control">
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
                                            </div><!-- /.form-group -->
                                        </div><!-- /.col-md-6 -->
                                        <div class="col-md-6">
                                            <div
                                                    class="form-group @if(isset($user->dob)) @if($user->dob != '')  focus @endif @endif">
                                                <label class="">Date of Birth</label>
                                                <input type="text" name="dob" value="{{$user->dob}}"
                                                       class="form-control" id="dob">
                                                @if($errors->first('dob'))
                                                    <span>{{ $errors->first('dob') }}</span>
                                                @endif
                                            </div><!-- /.form-group -->
                                        </div><!-- /.col-md-6 -->
                                    </div><!-- /.row -->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group focus">
                                                <label class="">About</label>
                                                {!! Form::textarea('about', $user->about, array('class' => 'form-control','placeholder' => 'About','required', 'rows'=>1))  !!}

                                                @if($errors->first('about'))
                                                    <span>{{ $errors->first('about') }}</span>
                                                @endif
                                            </div><!-- /.form-group -->
                                        </div><!-- /.col-md-6 -->
                                    </div><!-- /.row -->
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group focus">
                                                <label class="">Country</label>
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
                                            </div><!-- /.form-group -->
                                        </div><!-- /.col-md-6 -->
                                        <div class="col-md-6">
                                            <div
                                                    class="form-group @if(isset($user->phone_number)) @if($user->phone_number != '')  focus @endif @endif">
                                                <label class="">Phone Number</label>
                                                <input type="text" name="phone_number"
                                                       value="{{$user->phone_number}}"
                                                       class="form-control">
                                                @if($errors->first('phone_number'))
                                                    <span>{{ $errors->first('phone_number') }}</span>
                                                @endif
                                            </div><!-- /.form-group -->
                                        </div><!-- /.col-md-6 -->
                                    </div><!-- /.row -->
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group focus">
                                                <label class="">City</label>
                                                {!! Form::text('city', $user->city, array('class' => 'form-control','placeholder' => 'City','required'))  !!}

                                                @if($errors->first('city'))
                                                    <span>{{ $errors->first('city') }}</span>
                                                @endif
                                            </div><!-- /.form-group -->
                                        </div><!-- /.col-md-6 -->
                                        <div class="col-md-6">
                                            <div class="form-group focus">
                                                <label class="">State</label>
                                                {!! Form::text('state', $user->state, array('class' => 'form-control','placeholder' => 'State','required'))  !!}

                                                @if($errors->first('state'))
                                                    <span>{{ $errors->first('state') }}</span>
                                                @endif
                                            </div><!-- /.form-group -->
                                        </div><!-- /.col-md-6 -->


                                    </div><!-- /.row -->
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group focus">
                                                <label class="">Zip Code</label>
                                                {!! Form::text('post_code', $user->post_code, array('class' => 'form-control','placeholder' => 'Post Code','required'))  !!}

                                                @if($errors->first('post_code'))
                                                    <span>{{ $errors->first('post_code') }}</span>
                                                @endif
                                            </div><!-- /.form-group -->
                                        </div><!-- /.col-md-6 -->
                                    </div><!-- /.row -->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group @if(isset($user->address)) @if($user->address != '')  focus @endif @endif">
                                                <label class="">Please write once the complete Address</label>
                                                <input name="address"
                                                       class="form-control"
                                                       value="{{$user->address}}" id="address">
                                                {!! Form::hidden('address_latitude',config('constant_settings.DEFAULT_LATITUDE'), ['id'=> 'addressLatitude']) !!}
                                                {!! Form::hidden('address_longitude',config('constant_settings.DEFAULT_LONGITUDE'), ['id'=> 'addressLongitude']) !!}
                                                @if($errors->first('address'))
                                                    <span>{{ $errors->first('address') }}</span>
                                                @endif
                                            </div><!-- /.form-group -->
                                            <div id="address-map"></div>
                                            {{-- @if($user->user_type != 102)
                                                 <button type="submit" class="btn btn-green btn-block pull-right">
                                                     Update
                                                 </button>
                                             @endif--}}

                                        </div><!-- /.col-md-6 -->
                                    </div><!-- /.row -->

                                </div><!-- /.profile-setting-information /.col-md-8-->
                            </div><!-- /.row -->
                        </li><!-- /.list-group-item -->
                    </div><!-- /.edit-profile /.list-group -->

                    <!-- Edit Documents -->
                    @role('delivery.man')
                    @include('partials.delivery-driver-profile-settings')
                    @endrole
                </div><!-- /.col-md-9 -->

                @role('retailer')
                @include('partials.retailer-profile-settings')
                @endrole

                <div class="mb30 col-md-2 col-md-offset-10">
                    <button type="submit" class="btn btn-green btn-block pull-right update-profile">Update
                    </button>
                </div>


            </div><!-- /.row -->
        </div><!-- /.container -->
        {!! Form::close() !!}
    </div><!-- /.profile-setting -->

@endsection

@section('footer-scripts')
    <?php

    if(empty($user->latitude)) {
        $lat = config('constant_settings.DEFAULT_LATITUDE');
    } else {
        $lat = $user->latitude;
    }
    if(empty($user->longitude)) {
        $lng = config('constant_settings.DEFAULT_LONGITUDE');
    } else {
        $lng = $user->longitude;
    }
    if($user->is('retailer')) {
        if(empty($user->latitude)) {
            $businessLat = config('constant_settings.DEFAULT_LATITUDE');
        } else {
            $businessLat = $user->business_lat;
        }

        if(empty($user->longitude)) {
            $businessLng = config('constant_settings.DEFAULT_LONGITUDE');
        } else {
            $businessLng = $user->business_lng;
        }
    }

    ?>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    @include('includes.modals.cropper', ['url'=> url('/profile-setting/upload-photo')])
    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key={{config('constant_settings.MAP_API_KEY')}}&libraries=places&callback=initMap"
            type="text/javascript"></script>
    {!! HTML::script('local/public/assets/plugins/jquery-cropper/js/cropper.min.js') !!}
    {!! HTML::script('local/public/assets/plugins/jquery-cropper/js/main.js') !!}

    <link rel="stylesheet" href="{!! asset('local/public/assets/css/jquery-ui.css') !!}">
    @include('profile.profile-settings-js')

    <style>
        #myMap, #pickUpMap {
            height: 234px;
            width: 817px;
        }
    </style>

@endsection
