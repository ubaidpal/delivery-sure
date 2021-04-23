@extends('layouts.default')

<!-- Sidebar right menue -->
@include('includes.sidebar-right-menu')

@section('content')

    <!-- Place An Order -->
    <div class="place-an-order mt20 autoheight" id="mainBox" data-lat="{{config('constant_settings.DEFAULT_LATITUDE')}}"
         data-lng="{{config('constant_settings.DEFAULT_LONGITUDE')}}" data-user-type="{{config('constant_settings.USERS.'.$user->user_type)}}">
        <div class="container">
            <div class="row">
                {!! Form::model($order,['route' => ['update-order',encodeId($order->id,'orders')], "id" => "place_order_form", "enctype"=>"multipart/form-data",'method'=>'put']) !!}
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="place-an-order-group col-md-9">
                    <ul class=" list-group">
                        <li class="list-group-item">
                            <div class="h3b">Update Order</div>
                            <div class="form-group mt20 pull-left w290">
                                <label class="">Enter your order title <span>*</span></label>
                                <input type="text" name="title" class="form-control" required value="{{$order->title}}">
                                @if ($errors->has('title'))
                                    <span class="danger alert-danger">{{$errors->first('title')}}</span>
                                @endif

                                <label class=" mt10">Select Categories <span>*</span></label>
                                {!!  Form::select('categories',
                $categories, $order->category_id, ['id' => 'categories_list', 'class' => 'form-control'])!!}
                            </div><!-- /.form-group animate-label -->
                            <div class="form-group pull-left mt20 ml20">
                                <label class="">Special instructions for the driver. <span>*</span></label>
                                <textarea name="order_description"
                                          class="form-control desc-field" required>{!! ($order->order_description) !!}</textarea>
                                @if ($errors->has('order_description'))
                                    <span class="danger alert-danger">{{$errors->first('order_description')}}</span>
                                @endif
                            </div><!-- /.form-group animate-label -->
                            <div class="clearfix"></div>

                        </li><!-- /.list-group-item -->
                        <li class="list-group-item">
                            <div class="h3b mb10"></div>

                            <div class="row">
                                <div class="col-sm-8"><label class="">Items to be deliverd *</label></div>
                                <div class="col-sm-4"><label class="">Item Price</label></div>
                                <?php $total = 0;?>
                                @foreach($order->items as $index => $item)
                                    <?php
                                    $total = $total+$item->price;
                                    ?>
                                    <div class="col-md-8">
                                        <div class="form-group">

                                            <input type="text" class="form-control items" name="item_name[]" required
                                                   value="{{$item->name}}">
                                        </div><!-- /.form-group animate-label -->
                                    </div><!-- col-md-8 -->
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <input type="number" class="form-control item-price" name="item_price[]" step="any"
                                                   placeholder="$" value="{{$item->price}}">
                                        </div><!-- /.form-group animate-label -->
                                    </div><!-- col-md-3 -->
                                @endforeach

                            </div><!-- row -->

                            <a href="javascript:void(0);" class="btn btn-link btn-link-add" id="add-new-delivery-item">+ Add
                                New</a>
                        </li><!-- list-group-item -->
                        <li class="list-group-item">
                            <div class="h3b mb10">Delivery location and time</div>

                            <div class="form-group">
                                <label class="">Where you want your items to be delivered?</label>
                                <input type="text" name="delivery_location"
                                       placeholder="Where you want your items to be delivered?"
                                       class="form-control" id="pac-input" required value="{{$order->delivery_location}}">

                                <!--<button type="button" class="btn toltip" data-toggle="tooltip" data-placement="top"
                                        title="Tooltip on bottom">!
                                </button>-->
                            </div><!-- /.form-group animate-label -->
                            <input type="hidden" id="latitude" placeholder="Latitude" name="latitude"
                                   value="{{$order->latitude}}"/>
                            <input type="hidden" id="longitude" placeholder="Longitude" name="longitude"
                                   value="{{$order->longitude}}"/>

                            <p>Place the pin using the address above</p>
                            {{--<img src="{!! asset('local/public/assets/images/place-an-order.jpg') !!}" alt="image">--}}
                            <div id="myMap"></div>
                            <div class="row mt20">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="">Delivery Date</label>
                                        <input type='text' class="form-control" id='pickup-date'
                                               name="datepicker" autocomplete="off"
                                               value="" required/>
                                        @if ($errors->has('datepicker'))
                                            <span class="danger alert-danger">{{$errors->first('datepicker')}}</span>
                                        @endif
                                    </div><!-- /.form-group -->
                                </div><!-- /.col-md-4 -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="">Delivery Time</label>
                                        <input type='time' class="form-control" id='delivery-time'
                                               name="delivery_time" required
                                               value="{{\Carbon\Carbon::parse($order->deliver_date_time)->format('h:i A')}}"/>
                                        @if ($errors->has('delivery_time'))
                                            <span class="danger alert-danger">{{$errors->first('delivery_time')}}</span>
                                        @endif

                                    </div><!-- /.form-group -->
                                </div><!-- /.col-md-4 -->
                                <div class="clearfix"></div>

                            </div><!-- /.row -->

                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="pickUp" value="1" {{($order->pick_up_location==1?'checked':"")}}>Add a pick
                                    up point
                                </label>
                            </div><!-- /.checkbox -->

                        </li>
                        <li class="list-group-item" id="picUpLocationBlock" style="{{($order->pick_up_location==1?'':"display:none")}}">
                            <div class="h3b mb10">Pick Up location and time</div>

                            <div class="form-group">
                                <label class="">From where you want your items to be picked up?</label>
                                <input type="text" name="pickUp_location" class="form-control" id="pickUpInput"
                                       @role('retailer') readonly @endrole value="{{$order->pick_up_location_address}}">
                                <!--<button type="button" class="btn toltip" data-toggle="tooltip" data-placement="top"
                                        title="Tooltip on bottom">!
                                </button>-->
                            </div><!-- /.form-group animate-label -->
                            <input type="hidden" id="pickUpLatitude" placeholder="Latitude" name="pickUpLatitude"
                                   value="{{$order->pick_up_latitude}}"/>
                            <input type="hidden" id="pickUpLongitude" placeholder="Longitude" name="pickUpLongitude"
                                   value="{{$order->pick_up_longitude}}"/>

                            <p>Place the pin using the address above</p>
                            {{--<img src="{!! asset('local/public/assets/images/place-an-order.jpg') !!}" alt="image">--}}
                            <div id="pickUpMap"></div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="">Pickup Date</label>
                                        <input type='text' class="form-control" id='pickUp'
                                               name="pickTime"
                                               value=""/>

                                        @if ($errors->has('pickTime'))
                                            <span class="danger alert-danger">{{$errors->first('pickTime')}}</span>
                                        @endif

                                    </div><!-- /.form-group -->
                                </div><!-- /.col-md-4 -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="">Pickup Time</label>
                                        <input type='text' class="form-control" id='pickup-time'
                                               name="pickup_time" autocomplete="off"
                                               value="{{\Carbon\Carbon::parse($order->pick_up_time)->format('h:i A')}}"/>
                                        @if ($errors->has('pickup_time'))
                                            <span class="danger alert-danger">{{$errors->first('pickup_time')}}</span>
                                        @endif

                                    </div><!-- /.form-group -->
                                </div><!-- /.col-md-4 -->
                            </div><!-- /.row -->

                        </li>
                        <!-- /.list-group-item -->
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="">Estimated delivery fees</label>
                                        <input placeholder="$" type="number" name="estimate_delivery_fee"
                                               class="form-control" required min="1" step="any" value="{{$order->estimate_delivery_fee}}">
                                    </div><!-- /.form-group animate-label -->
                                </div>
                            </div><!-- /.row -->
                        </li>
                    </ul><!-- /.place-an-order-group .list-group -->


                </div><!-- /.col-md-9 -->

                <div class="list-group-green-header col-md-3 col-xs-6">
                    <div class="order-detail-fixed" style="position:fixed;">
                        <ul class=" list-group">
                            <li class="list-group-item active">Your Order Information</li><!-- /.list-group-item -->
                            <li class="list-group-item">
                                <div class="pull-left">
                                    Items Price
                                </div>

                                <div id="items-price" class="pull-right">
                                    $ {{$total}}
                                </div>
                            </li><!-- /.list-group-item -->

                            <li class="list-group-item">
                                <div class="pull-left">
                                    Delivery Fee
                                </div>

                                <div id="delivery-fee" class="pull-right">
                                    $ {{$order->estimate_delivery_fee}}
                                </div>
                            </li><!-- /.list-group-item -->
                            <li class="list-group-item">
                                <div class="pull-left">
                                    Total Price
                                </div>

                                <div class="h3 pull-right" id="total-amount">{{format_currency($total+ $order->estimate_delivery_fee)}}</div>
                            </li>

                        </ul><!-- /.list-group-green-header -->
                        <button type="submit" class="btn btn-green btn-block" id="save-order-btn">Review Your Order</button>

                    </div>
                </div><!-- /.list-group-green-header -->
                {!! Form::close() !!}
            </div><!-- /.row -->
        </div><!-- /.container -->
    </div><!-- /.place-an -->


@endsection

@section('footer-scripts')
    @include('orders.order-summary')
    <link rel="stylesheet" href="{!! asset('local/public/assets/css/jquery-ui.css') !!}">
    <link rel="stylesheet" href="{!! asset('local/public/assets/css/jquery.timepicker.css') !!}">
    {!! HTML::script('local/public/assets/js/moment.min.js') !!}
    {!! HTML::script('local/public/assets/plugins/time-picker/time-picker.js') !!}
    {{--{!! HTML::script('local/public/assets/js/combodate.js') !!}--}}

    {!! HTML::script('local/public/assets/js/jquery-ui.min.js') !!}
    {!! HTML::script('local/public/assets/pages/orders.js') !!}
    <style>
        #myMap, #pickUpMap {
            height: 234px;
            width: 817px;
        }
    </style>
    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key={{config('constant_settings.MAP_API_KEY')}}&libraries=places&callback=initMapUpdate"
            type="text/javascript"></script>



    @include('orders.update-order-js')


@endsection
