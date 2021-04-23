{{--

    * Created by   :  Muhammad Yasir
    * Project Name : demedat
    * Product Name : PhpStorm
    * Date         : 08-Nov-16 2:37 PM
    * File Name    : 

--}}
<div class="edit-documents list-group">
    <li class="list-group-item">
        <div class="h3b">Driver Detail</div>

        <div class="row">
            <div class="profile-setting-information col-md-12 col-xs-12">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group @if(isset($user->first_name)) @if($user->first_name != '')  focus @endif @endif">
                            <label class="">Driver Type</label>
                            {!! Form::select('driver_type', config('constant_settings.VEHICLE_TYPES'),$user->driver_type,['class'=>'form-control','id'=>'driver-type']) !!}
                            @if($errors->first('business_name'))
                                <span>{{ $errors->first('business_name') }}</span>
                            @endif
                        </div><!-- /.form-group animate-label -->
                    </div><!-- /.col-md-6 -->
                    <div class="col-md-5  col-md-offset-1"
                         id="driver-{{config('constant_settings.DELIVERY_PERSON_TYPES.WALKER')}}">
                        <div class="form-group">
                            <label>Able to lift 50 LB</label>

                            <div class="mt5">
                                <label class="radio-inline">
                                    <input name="lift_weight" type="radio" value="1"
                                           @if($user->lift_weight == 1) checked @endif>Yes
                                </label>
                                <label class="radio-inline">
                                    <input name="lift_weight" type="radio" value="0"
                                           @if($user->lift_weight != 1) checked @endif>No
                                </label>
                            </div>
                        </div>
                    </div>
                </div><!-- /.row -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group focus">
                            <label class="">Driving license Number</label>
                            {!! Form::text('license_number', $user->license_number, array('class' => 'form-control','placeholder' => 'Zip Code','required'))  !!}

                            @if($errors->first('license_number'))
                                <span>{{ $errors->first('license_number') }}</span>
                            @endif
                        </div><!-- /.form-group -->
                    </div><!-- /.col-md-6 -->
                </div><!-- /.row -->
                <div class="vehicles">
                    <div class="h3b">Vehicles</div>
                    <div class="clearfix"></div>
                    <div class="row" id="vehicle-header">
                        <div class="col-md-3"><label class="">Make</label></div>
                        <div class="col-md-2 nopadding"><label class="">Model</label></div>
                        <div class="col-md-2"><label class="">Year</label></div>
                        <div class="col-md-2 nopadding"><label class="">Color</label></div>
                        <div class="col-md-3"><label class="">Plate Number</label></div>
                    </div>
                    <div class="vehicles-block row">

                            <?php $i = 0;?>
                            @foreach($vehicles as $vehicle)
                                <div class="form-group focus pull-left vehicles-list  added-fields">
                                    <div class="col-md-3">
                                        {!! Form::hidden('vehicle['.$i.'][id]',$vehicle->id ) !!}
                                        {!! Form::text('vehicle['.$i.'][make]',$vehicle->make,['class'=>'form-control', 'required']) !!}
                                        @if($errors->first('license_number'))
                                            <span>{{ $errors->first('license_number') }}</span>
                                        @endif
                                    </div><!-- /.col-md-6 -->
                                    <div class="col-md-2 nopadding">
                                        {!! Form::text('vehicle['.$i.'][model]',$vehicle->model,['class'=>'form-control','required']) !!}
                                        @if($errors->first('license_number'))
                                            <span>{{ $errors->first('license_number') }}</span>
                                        @endif
                                    </div><!-- /.col-md-6 -->
                                    <div class="col-md-2">

                                        {!! Form::selectRange('vehicle['.$i.'][year]', \Carbon\Carbon::now()->format('Y'), 1980,$vehicle->year,['class'=>'form-control', 'required']) !!}

                                        @if($errors->first('license_number'))
                                            <span>{{ $errors->first('license_number') }}</span>
                                        @endif
                                    </div><!-- /.col-md-6 -->
                                    <div class="col-md-2 nopadding">
                                        {!! Form::text('vehicle['.$i.'][color]',$vehicle->color,['class'=>'form-control', 'required']) !!}

                                        @if($errors->first('license_number'))
                                            <span>{{ $errors->first('license_number') }}</span>
                                        @endif

                                    </div><!-- /.col-md-6 -->
                                    <div class="col-md-2">
                                   {!! Form::text('vehicle['.$i.'][plate_number]',$vehicle->plate_number,['class'=>'form-control', 'required']) !!}

                                        @if($errors->first('license_number'))
                                            <span>{{ $errors->first('license_number') }}</span>
                                        @endif
                                    </div><!-- /.col-md-6 -->
                                    <div class="col-md-1 col-btn-del">
                                        <a href="javascript:void(0);" data-delete="" data-id="{{$vehicle->id}}" class="btn btn-del remove-vehicle delete" style="margin-top: 0">×</a>
                                    </div>
                                </div>
                                    <?php $i++;?>
                            @endforeach

                    </div>
                    <button class="btn btn-green pull-left" type="button" id="add-more">Add Vehicle</button>
                    <b class="col-sm-8 text-danger pull-left text mt20" id="limit-exceed"></b>
                </div>
            </div>
        </div>
    </li>
</div>
<div class="edit-documents list-group">
    <li class="list-group-item">
        <div class="h3b">Documents</div>

        <div class="row">
            <?php
            $frontPic = (isset($documents[ 1 ]) ? $documents[ 1 ] : '');
            ?>
            <div class="col-md-4 col-xs-6">
                <div class="id-card-img">
                    @if(!empty($frontPic))
                        <img style="width: 252px; height: 126px;" id="nic_front_picture"
                             src="{!! getImage($frontPic->document_url) !!}"
                             alt="image">
                    @else
                        <img style="width: 252px; height: 126px;" id="nic_front_picture"
                             src="{!! asset('local/public/assets/images/id-card-back.jpg') !!}"
                             alt="image">
                    @endif
                </div>
                <a data-type="{{config('constant_settings.DOCUMENT-TYPES.FRONT_PICTURE')}}"
                   data-aspect-ratio="4/3" data-height="768" data-width="1024"
                   data-item-id="{{"nic_front_picture"}}" data-target-field="#image_file"
                   class="btn btn-gray btn-block crop-avatar" href="javascript:void(0);">Upload
                    Nic
                    Front Picture</a>
            </div><!-- /.col-md-4 -->
            <?php
            $backPic = (isset($documents[ 2 ]) ? $documents[ 2 ] : '');
            ?>
            <div class="col-md-4 col-xs-6">
                <div class="id-card-img">
                    @if(!empty($backPic))
                        <img style="width: 252px; height: 126px;" id="nic_back_picture"
                             src="{!! getImage($backPic->document_url) !!}"
                             alt="image">
                    @else
                        <img style="width: 252px; height: 126px;" id="nic_back_picture"
                             src="{!! asset('local/public/assets/images/id-card-front.jpg') !!}"
                             alt="image">
                    @endif
                </div>
                <a data-type="{{config('constant_settings.DOCUMENT-TYPES.BACK_PICTURE')}}"
                   data-aspect-ratio="4/3" data-height="768" data-width="1024"
                   data-item-id="{{"nic_back_picture"}}" data-target-field="#image_file"
                   class="btn btn-gray btn-block crop-avatar" href="javascript:void(0);">Upload
                    Nic
                    Back Picture</a>
            </div><!-- /.col-md-4 -->
            <?php
            $licensePic = (isset($documents[ 3 ]) ? $documents[ 3 ] : '');
            ?>
            <div class="col-md-4 col-xs-6" id="license-picture"
                 style="@if($user->driver_type == config('constant_settings.DELIVERY_PERSON_TYPES.WALKER') || $user->driver_type == config('constant_settings.DELIVERY_PERSON_TYPES.BIKER')) display:none; @else display: block; @endif ">
                <div class="id-card-img">
                    @if(!empty($licensePic))
                        <img id="driving_license" style="width: 252px; height: 126px;"
                             class="img-responsive"
                             src="{!! getImage($licensePic->document_url) !!}"
                             class="img-responsive" alt="promotion banner">
                    @else
                        <img id="driving_license"
                             style="width: 252px; height: 126px !important;"
                             class="img-responsive"
                             src="{!! asset('local/public/assets/images/id-card-back.jpg') !!}"
                             alt="image">
                    @endif
                </div>
                <a data-type="{{config('constant_settings.DOCUMENT-TYPES.LICENSE_PICTURE')}}"
                   data-aspect-ratio="4/3" data-height="768" data-width="1024"
                   data-item-id="{{"driving_license"}}" data-target-field="#image_file"
                   class="btn btn-gray btn-block crop-avatar" href="javascript:void(0);">Upload
                    Driving License Picture</a>
            </div><!-- /.col-md-4 -->
            <?php
            $comLicensePic = (isset($documents[ 4 ]) ? $documents[ 4 ] : '');
            ?>
            <div class="col-md-4 col-xs-6" id="commercial-license-box"
                 style="margin-top: 10px; @if($user->driver_type == config('constant_settings.DELIVERY_PERSON_TYPES.TRUCK DRIVER')) display:block; @else display: none; @endif ">
                <div class="id-card-img">
                    @if(!empty($comLicensePic))
                        <img id="commercial_driving_license"
                             style="width: 252px; height: 126px;"
                             class="img-responsive"
                             src="{!! getImage($comLicensePic->document_url) !!}"
                             class="img-responsive" alt="promotion banner">
                    @else
                        <img id="commercial_driving_license"
                             style="width: 252px; height: 126px !important;"
                             class="img-responsive"
                             src="{!! asset('local/public/assets/images/id-card-back.jpg') !!}"
                             alt="image">
                    @endif
                </div>
                <a data-type="{{config('constant_settings.DOCUMENT-TYPES.COMMERCIAL_LICENSE_PICTURE')}}"
                   data-aspect-ratio="4/3" data-height="768" data-width="1024"
                   data-item-id="{{"commercial_driving_license"}}"
                   data-target-field="#commercial_driving_license"
                   class="btn btn-gray btn-block crop-avatar" href="javascript:void(0);">
                    Commercial License Picture</a>
            </div><!-- /.col-md-4 -->
        </div><!-- /.row -->
    </li><!-- /.list-group-item -->
</div><!-- /.edit-documents /.list-group -->
