@extends('layouts.default')

        <!-- Sidebar right menue -->
@include('includes.sidebar-right-menu')

@section('content')

        <!-- My Jobs -->
<div class="my-jobs autoheight">
    <div class="container">
        <div class="row">

            <div class="col-xs-3">
                <div class="h2b mt40">Invitations</div>
            </div><!-- /.col-sm-8 -->

        </div><!-- /.row -->

        <ul class="list-group">
            <li class="list-group-item">
                <div class="row">
                    <div class="col-xs-4">
                        <div class="h4b">Contracts</div>
                    </div><!-- /.col-xs-6 -->
                    <div class="col-xs-2">
                        <div class="h4b">Client</div>
                    </div><!-- /.col-xs-2 -->
                    <div class="col-xs-2">
                        <div class="h4b">Time Period</div>
                    </div><!-- /.col-xs-2 -->
                    <div class="col-xs-2">
                        <div class="h4b">Delivery Fee</div>
                    </div><!-- /.col-xs-2 -->
                    <div class="action">
                        <div class="h4b">Action</div>
                    </div><!-- /.col-xs-2 -->
                </div><!-- /.row -->
            </li><!-- /.list-group-item -->
        </ul><!-- /.list-group -->

        <ul class="my-jobs-list list-group">
            <li class="list-group-item">
                @if(count($invitations) > 0)
                    @foreach($invitations as $job)

                        <div class="my-proposal">
                            <div class="col-xs-4">
                                <div class="h3g">
                                    <a href="{{route('order-detail',[Hashids::connection('orders')->encode($job->object_id)])}}"
                                       class="h3g">{{$job->order->title}}</a>
                                </div>

                            </div><!-- /.col-xs-6 -->
                            <div class="col-xs-2">
                                <div class="message-thread-img">
                                    <img src="{!! getImage($job->order->owner->profile_photo_url) !!}"
                                         alt="image">
                                </div><!-- /.message-thread-item -->
                                <div class="uname">{{$job->order->owner->display_name}}</div>
                            </div><!-- /.col-xs-2 -->
                            <div class="col-xs-2">
                                <div class="time-date">
                                    {{getTimeByTZ($job->order->deliver_date_time,'H:i A M d, Y')}}
                                </div>
                            </div><!-- /.col-xs-2 -->
                            <div class="col-xs-2">
                                <div class="total-earning">
                                    <a href="javascript:void(0);"
                                       class="total-earning-value">{{format_currency($job->order->estimate_delivery_fee)}}</a>

                                    <div class="total-earning-hover">
                                        <div class="earning-hover-item">
                                            <div class="h4b">Goods Value:</div>
                                            <div>{{format_currency($job->order->item_value)}}</div>
                                        </div><!-- /.earning-hover-item -->
                                        <div class="earning-hover-item">
                                            <div class="h4b">Delivery Fees:</div>
                                            <div>{{format_currency($job->order->estimate_delivery_fee)}}</div>
                                        </div><!-- /.earning-hover-item -->
                                    </div><!-- /.total-earning-hover -->
                                </div><!-- /.total-earning-value -->
                            </div><!-- /.col-xs-2 -->
                            <div class="action">

                                <a href="{{route('cancel-invitation',[Hashids::connection('favourite')->encode($job->id)])}}"
                                       class="btn btn-default btn-link" data-toggle="confirmation" data-popout="true">Cancel</a> |
                                <a href="{{route('order-detail',[Hashids::connection('orders')->encode($job->object_id)])}}"
                                       class="btn btn-default btn-link" data-toggle="confirmation" data-popout="true">Send a Propsal</a>

                            </div><!-- /.col-xs-2 -->
                            <div class="clearfix"></div>
                        </div><!-- /.row -->

                    @endforeach
                    {!! $invitations->render() !!}
                @else
            </li><!-- /.list-group-item -->
            <li class="list-group-item"><div class="no-record">
                    You have no invitation
                </div></li>
            @endif

        </ul><!-- /.list-group -->

    </div><!-- /.container -->
</div><!-- /.my-jobs -->

@endsection


