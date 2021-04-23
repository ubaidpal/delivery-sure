@extends('layouts.default')

<!-- Sidebar right menue -->
@include('includes.sidebar-right-menu')

@section('content')

    <!-- My Orders -->
    <div class="my-jobs autoheight">
        <div class="container">
            <div class="row">
                    <div class="col-xs-12">
                    <div class="row">
                        <div class="col-xs-6">
                            <div class="h2b mt40">My Orders</div>
                        </div><!-- /.col-sm-8 -->
                        @if(Request::is('my-orders'))
                            {!! Form::open(['route', 'order-filter', 'method', 'get']) !!}
                            <div class="col-md-2 col-md-offset-3 col-sm-4 col-xs-4 pull-right">
                                <div class="form-group mt30 mb0 bg-white">
                                    <?php $status = config('constant_settings.ORDER_STATUS_MSG');?>
                                    <select class="form-control" name="status">
                                        <option @if(Request::get('status') === "all")  selected @endif value="all">All
                                        </option>
                                        @foreach($status as $key => $value)
                                            <option @if(Request::get('status') === "$key") selected
                                                    @endif value="{{$key}}">{{$value}}</option>
                                        @endforeach
                                        <option @if(Request::get('status') === "archive") selected
                                                @endif value="archive">Archives
                                        </option>
                                    </select>
                                </div><!-- /.form-group -->
                            </div><!-- /.col-sm-4 -->
                        @endif
                        {!! Form::close() !!}

                    </div><!-- /.row -->
                </div><!-- /.col-xs-12 -->
            </div><!-- /.row -->
            {{-- <ul class="list-inline">
                 <li class="active"><a href="{{route('my-orders')}}">My Orders</a></li>
                 <li class=""><a href="{{route('my-orders',['completed'])}}">Completed Orders</a></li>
                 <li class=""><a href="{{route('archives')}}">Archives</a></li>
             </ul>--}}
            <ul class="list-group ">
                <li class="list-group-item p0">
                    <div class="alter-row bg-white">
                        <div class="contract">
                            <div class="h4b">Contracts</div>
                        </div><!-- /.col-xs-4 -->
                        <div class="bids-title">
                            <div class="h4b">Bids</div>
                        </div><!-- /.col-xs-4 -->
                        <div class="job-awarded">
                            <div class="h4b">Job Awarded</div>
                        </div><!-- /.col-xs-2 -->
                        <div class="time-date">
                            <div class="h4b">Time Period</div>
                        </div><!-- /.col-xs-2 -->
                        <div class="delivery-fee">
                            <div class="h4b">Total Amount</div>
                        </div><!-- /.col-xs-2 -->
                        <div class="status">
                            <div class="h4b">Status</div>
                        </div><!-- /.col-xs-2 -->
                        <div class="action">
                            <div class="h4b">Action</div>
                        </div><!-- /.col-xs-2 -->
                    </div><!-- /.row -->
                </li><!-- /.list-group-item -->
            </ul><!-- /.list-group -->
            <ul class="my-jobs-list list-group">
                <li class="list-group-item">
                    @if(count($orders) > 0)
                        @foreach($orders as $order )
                            <div class="alter-row">
                                <div class="contract">
                                    <a href="{{route('order-detail',[Hashids::connection('orders')->encode($order->id)])}}">
                                        <div class="h3g">

                                            {{$order->title}}
                                        </div>
                                    </a>

                                    <div>{{--{{$order->order_description}}--}}</div>
                                </div><!-- /.col-xs-4 -->
                                <div class="bid-count">
                                    <div>
                                        {!! HTML::linkRoute('all-bids',( isset($bidsCount[$order->id])?$bidsCount[$order->id]['count']. ' Bids ':'0 ' ),[Hashids::connection('orders')->encode($order->id)], ['class'=>'']) !!}

                                    </div>
                                </div><!-- /.col-xs-2 -->
                                <div class="job-awarded">
                                    @if($order->status != config('constant_settings.ORDER_STATUS.IN_PROCESS'))
                                        <a href="{{route('profile',[encodeId($order->selectedBid->bidder_id,'favourite')])}}">
                                            <div class="message-thread-img">
                                                <img src="{!! getImage($order->selectedBid->bidder->profile_photo_url,'41x41') !!}"
                                                     alt="image">
                                            </div><!-- /.message-thread-item -->
                                            <div class="uname">{{limit_char($order->selectedBid->bidder->display_name)}}</div>
                                        </a>

                                    @endif
                                </div><!-- /.col-xs-2 -->
                                <div class="time-date">
                                    <div>{{getTimeByTZ($order->deliver_date_time,'h:i A M d, Y')}}</div>
                                </div><!-- /.col-xs-2 -->
                                <div class="delivery-fee">
                                    <a data-container="body" data-toggle="popover" href="javascript:void(0);"
                                       class="total-earning-valuedcf"
                                       data-popover-content="#content-{{$order->id}}">{{format_currency($order->item_value+$order->estimate_delivery_fee)}}</a>
                                    <div id="content-{{$order->id}}">
                                        <div class="total-earning-hover popover-body">
                                            <div class="earning-hover-item">
                                                <div class="h4b">Goods Value:</div>
                                                <div>{{format_currency($order->item_value)}}</div>
                                            </div><!-- /.earning-hover-item -->
                                            <div class="earning-hover-item">
                                                <div class="h4b">Delivery Fees:</div>
                                                <div>{{format_currency($order->estimate_delivery_fee)}}</div>
                                            </div><!-- /.earning-hover-item -->
                                            @if($order->status != config('constant_settings.ORDER_STATUS.IN_PROCESS'))
                                                @if(!empty($order->selectedBid))
                                                    <div class="earning-hover-item">
                                                        <div class="h4b">Proposed Delivery Fees:</div>
                                                        <div>{{format_currency($order->selectedBid->bid_amount)}}</div>
                                                    </div><!-- /.earning-hover-item -->
                                                @endif
                                            @endif
                                        </div><!-- /.total-earning-hover -->
                                    </div>
                                </div><!-- /.total-earning-value -->
                                <div class="status">
                                    <div>
                                        @if($order->is_archive == 1 || $order->status == config('constant_settings.ORDER_STATUS.IN_PROCESS') && $order->deliver_date_time <= \Carbon\Carbon::now())
                                            Archived
                                        @else

                                            {{config('constant_settings.ORDER_STATUS_MSG.'.$order->status)}}
                                        @endif
                                    </div>
                                </div><!-- /.col-xs-2 -->

                                <div class="action ">
                                    @if($order->status == config('constant_settings.ORDER_STATUS.IN_PROCESS'))
                                        <div class="dropup">
                                            <div class="glyphicon glyphicon-cog dropdown-toggle"
                                                 id="aria-{{$order->id}}"
                                                 data-hover="dropdown">
                                                <ul class="dropdown-menu" aria-labelledby="aria-{{$order->id}}">
                                                    @if($order->is_archive == 0)
                                                        <li>
                                                            <a href="{{route('update-order',[Hashids::connection('orders')->encode($order->id)])}}"
                                                               class="btn btn-default btn-link">Edit</a>
                                                        </li>
                                                    @endif
                                                    <li>
                                                        <a href="{{route('delete-order',[Hashids::connection('orders')->encode($order->id)])}}"
                                                           class="btn btn-default btn-link" data-toggle="confirmation"
                                                           data-popout="true">Delete</a>
                                                    </li>

                                                    <li>
                                                        @if($order->is_archive == 0)
                                                            <a href="{{route('archive',[Hashids::connection('orders')->encode($order->id)])}}"
                                                               class="btn btn-default btn-link" data-toggle="confirmation"
                                                               data-popout="true">Archive</a>
                                                        @else
                                                             <a href="{{route('archive.remove',[Hashids::connection('orders')->encode($order->id)])}}"
                                                                class="btn btn-default btn-link" data-toggle="confirmation"
                                                                data-popout="true">Publish</a>
                                                        @endif
                                                    </li>


                                                </ul>
                                            </div>
                                        </div>
                                    @endif
                                    @if($order->status == config('constant_settings.ORDER_STATUS.RECEIVED'))
                                        <a href="{{route('order.repost',[Hashids::connection('orders')->encode($order->id)])}}"
                                           class="btn btn-default btn-link" data-toggle="confirmation"
                                           data-popout="true">Re Post</a>
                                    @endif
                                </div><!-- /.col-xs-2 -->
                            </div><!-- /.row -->
                        @endforeach
                    @else
                        <div class="no-record"><a href="{{'place-order'}}">Place your first order on delivery sure!</a>
                        </div>
                    @endif
                </li><!-- /.list-group-item -->
                {!!$orders->appends(['status' => Request::get('status')])->links()!!}

            </ul><!-- /.list-group -->

        </div><!-- /.container -->
    </div><!-- My Orders -->
@endsection
@section('footer-scripts')

    {!! HTML::script('local/public/assets/js/bootstrap/confirmation.js') !!}



    <script>
        $(document).ready(function () {
            $('select[name="status"]').change(function () {
                var status = $(this).val();

                window.location.href = "{{url('my-orders?status=')}}" + status;
            })

            $('[data-toggle="confirmation"]').confirmation({
                singleton: true
            })
        });
    </script>

@endsection

