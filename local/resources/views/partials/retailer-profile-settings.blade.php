{{--

    * Created by   :  Muhammad Yasir
    * Project Name : demedat
    * Product Name : PhpStorm
    * Date         : 08-Nov-16 2:38 PM
    * File Name    : 

--}}
<div class="col-md-9 col-xs-12 col-md-offset-3">
    <!-- Edit Profile -->
    <div class="edit-profile list-group">
        <li class="list-group-item">
            <div class="row">
                <div class="profile-setting-information col-md-12 col-xs-12">
                    <div class="h3b"> Business Information</div>
                    {!! Form::open(['name'=>'profile_setting', 'url'=>'profile-setting', 'class' => 'test']) !!}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group @if(isset($user->first_name)) @if($user->first_name != '')  focus @endif @endif">
                                <label class="">Organization Name</label>
                                <input type="text" name="business_name" value="{{$user->business_name}}"
                                       class="form-control">
                                @if($errors->first('business_name'))
                                    <span>{{ $errors->first('business_name') }}</span>
                                @endif
                            </div><!-- /.form-group animate-label -->
                        </div><!-- /.col-md-6 -->
                        <div class="col-md-6">
                            <div
                                    class="form-group @if(isset($user->business_phone)) @if($user->business_phone != '')  focus @endif @endif">
                                <label class="">Business Phone</label>
                                <input type="text" name="business_phone"
                                       value="{{$user->business_phone}}"
                                       class="form-control">
                                @if($errors->first('business_phone'))
                                    <span>{{ $errors->first('business_phone') }}</span>
                                @endif
                            </div><!-- /.form-group animate-label -->
                        </div><!-- /.col-md-6 -->
                    </div><!-- /.row -->

                    <div class="row">

                        <div class="col-md-12">
                            <div class="form-group @if(isset($user->business_address)) @if($user->business_address != '')  focus @endif @endif">
                                <label class="">Business Address</label>
                                <input id="business_address" name="business_address"
                                       class="form-control" value="{{$user->business_address}}">
                                @if($errors->first('business_address'))
                                    <span>{{ $errors->first('business_address') }}</span>
                                @endif
                            </div><!-- /.form-group -->


                        </div><!-- /.col-md-6 -->

                    </div><!-- /.row -->
                    <input type="hidden" id="latitude" placeholder="Latitude" name="latitude" value="{{$user->business_lat}}"/>
                    <input type="hidden" id="longitude" placeholder="Longitude" name="longitude" value="{{$user->business_lng}}"/>

                    <div class="">
                        <div id="myMap"></div>
                    </div><!-- /.row -->
                    <div class="mt20">
                        <button type="submit" class="btn btn-green btn-block pull-right">Update
                        </button>
                    </div>

                    {{--@if($user->user_type != 102 )
                        <div class="checkbox">
                            <label>
                                <input id="become_driver" name="become_driver" class="become_driver"
                                       @if($user->user_type == 2) checked="checked"
                                       @endif type="checkbox">
                                Become a driver
                            </label>
                        </div>
                    @endif--}}
                </div><!-- /.profile-setting-information /.col-md-8-->
            </div><!-- /.row -->
        </li><!-- /.list-group-item -->
    </div><!-- /.edit-profile /.list-group -->
    <!-- Edit Documents -->
</div><!-- /.col-md-9 -->
