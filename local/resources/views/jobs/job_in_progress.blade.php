@extends('layouts.default')

<!-- Sidebar right menue -->
@include('includes.sidebar-right-menu')

@section('content')
    <!-- Job IN Progress -->
    <div class="bidders-view autoheight">
        <div class="container">
            <div class="bidders-view-header">
                <!-- Header Meta -->
                <div class="bidders-header-meta">
                    <a href="javascript:void(0);" class="btn btn-sm btn-gray">{{getCategoryName($order->category_id)}}</a>
                    <a href="{{route('order-detail',[HashId::encode($order->id,'orders')])}}" class="btn btn-green pull-right">VIEW
                        LISTING</a>
                </div><!-- /.job-header-meta -->

                <div class="job-header-detail">
                    <div class="h3">{{$order->title}}</div>

                    <div class="job-status">
                        {{--<div class="job-status-item">
                            <div class="h4">Status:</div>
                            <span>Urgent</span>
                        </div><!-- /.job-status-item -->--}}
                        <div class="job-status-item">
                            <div class="h4">Estimated Delivery Fees:</div>
                            <span>{{format_currency($selectedBid->bid_amount)}}</span>
                        </div><!-- /.job-status-item -->
                        <div class="job-status-item">
                            <div class="h4">Estimated Delivery Time:</div>
                            <span>{{getTimeByTZ($order->deliver_date_time,'h:i A M d, Y')}}</span>
                        </div><!-- /.job-status-item -->
                    </div><!-- /.job-status -->
                </div><!-- /.job-header-detail -->

                <ul class="job-progress list-group">
                    <li class="progress-pager list-group-item">
                        <div class="progress-pager-block">
                            <div class="progress-pager-item checklist active"></div><!-- /.progress-pager-item -->
                            <span class="progress-pager-separator active"></span><!-- /.progress-pager-separator -->
                            <div class="progress-pager-item depart"></div><!-- /.progress-pager-item -->
                            <span class="progress-pager-separator"></span><!-- /.progress-pager-separator -->
                            <div class="progress-pager-item delivered"></div><!-- /.progress-pager-item -->
                        </div><!-- /.progress-pager -->
                        @if($user->id === $order->user_id)
                            <div class="order_pin">Order Pin: {{$order->pin_number}}</div>
                        @endif
                    </li><!-- /.list-group-item -->
                    <?php $allChecked = TRUE; ?>
                    @foreach($items as $item)
                        @if($item->status == 0)
                            <?php $allChecked = FALSE; ?>
                            @endif
                    @endforeach
                    <li class="list-group-item">
                        <div class="col-sm-10 col-sm-offset-1">
                            <div class="h2b pull-left">Checklist</div>
                            @if($order->user_id != $user->id)
                                <a href="{{route('ready-to-depart',[Hashids::connection('orders')->encode($order->id)])}}"
                                   class="btn btn-green pull-right" id="ready-depart" @if(!$allChecked)disabled="" @endif>READY TO DEPART</a>
                            @endif
                        </div><!-- /.col-sm-10 -->
                    </li><!-- /.list-group-item -->

                    <li class="list-group-item">
                        <div class="col-sm-10 col-sm-offset-1">
                            @foreach($items as $item)
                                <div class="checkbox">
                                    <label>
                                        @if($order->user_id != $user->id)
                                            <input @if($item->status == 1) checked @endif type="checkbox" name="items[]"
                                                   value="{{Hashids::connection('orders')->encode($item->id)}}"
                                                   class="items">
                                        @endif
                                        <div class="@if($order->user_id == $user->id && $item->status == 1) checked-through @endif">
                                            {{$item->name}}
                                        </div>


                                    </label>
                                </div><!-- /.checkbox -->
                            @endforeach

                        </div><!-- /.col-sm-10 -->
                    </li><!-- /.list-group-item -->


                </ul><!-- /.list-group -->

            </div><!-- /.bidders-view-header -->
        </div><!-- /.container -->
    </div><!-- /.Job IN Progress -->
    {!! csrf_field() !!}
@endsection
@section('footer-scripts')
    {!! HTML::script('local/public/assets/pages/jobs.js') !!}
@endsection
