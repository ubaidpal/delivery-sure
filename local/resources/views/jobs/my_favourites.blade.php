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
                        <div class="col-xs-3">
                            <div class="h2b mt40">Saved Jobs</div>
                        </div><!-- /.col-sm-8 -->
                    </div><!-- /.row -->
                </div><!-- /.col-xs-12 -->
            </div><!-- /.row -->
            @include('includes.alerts')
            <ul class="list-group">
                <li class="list-group-item p0">
                    <div class="alter-row bg-white">
                        <div class="contract">
                            <div class="h4b">Contracts</div>
                        </div><!-- /.col-xs-4 -->
                        <div class="job-awarded">
                            <div class="h4b">Job Owner</div>
                        </div><!-- /.col-xs-2 -->
                        <div class="time-date">
                            <div class="h4b">Time Period</div>
                        </div><!-- /.col-xs-2 -->
                        <div class="delivery-fee">
                            <div class="h4b">Amount</div>
                        </div><!-- /.col-xs-2 -->
                        {{--  <div class="status">
                              <div class="h4b">Status</div>
                          </div><!-- /.col-xs-2 -->--}}
                        <div class="action">
                            <div class="h4b">Action</div>
                        </div><!-- /.col-xs-2 -->
                    </div><!-- /.row -->
                </li><!-- /.list-group-item -->
            </ul><!-- /.list-group -->
            <ul class="my-jobs-list list-group">
                <li class="list-group-item">
                    @if(count($jobs) > 0)
                        @foreach($jobs as $job )
                            <?php $order = $job->order;?>
                            <div class="alter-row">
                                <div class="contract">
                                    <a href="{{route('order-detail',[Hashids::connection('orders')->encode($order->id)])}}">
                                        <div class="h3g">{{$order->title}}</div>
                                    </a>

                                    <div>{{--{{$order->order_description}}--}}</div>
                                </div><!-- /.col-xs-4 -->
                                <div class="job-awarded">
                                    <a href="{{route('profile',[encodeId($order->owner->id,'favourite')])}}">
                                        <div class="message-thread-img">
                                            <img src="{!! getImage($order->owner->profile_photo_url,'41x41') !!}"
                                                 alt="image">
                                        </div><!-- /.message-thread-item -->
                                        <div class="uname">{{$order->owner->display_name}}</div>
                                    </a>
                                </div><!-- /.col-xs-2 -->
                                <div class="time-date">
                                    <div>{{getTimeByTZ($order->deliver_date_time,'H:i A M d, Y')}}</div>
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
                                        </div><!-- /.total-earning-hover -->
                                    </div>
                                </div><!-- /.total-earning-value -->
                                {{--<div class="status">
                                    <div>{{config('constant_settings.ORDER_STATUS_MSG.'.$order->status)}}</div>
                                </div><!-- /.col-xs-2 -->--}}
                                <div class="action">
                                    <a href="{{route('remove-favourite',[Hashids::connection('orders')->encode($job->id)])}}"
                                       class="btn btn-default btn-link"><span class="glyphicon glyphicon-remove"></span></a>

                                    <a class=""
                                       href="{{route('share.job',[encodeId($job->order->id,'favourite')])}}" data-toggle="modal"
                                       data-target="#shares"><i class="fa fa-share-alt" aria-hidden="true"></i></a>


                                </div><!-- /.col-xs-2 -->
                            </div><!-- /.row -->
                        @endforeach
                    @else
                        <div class="no-record"><a href="{{'place-order'}}">
                                No favourite job found!
                            </a></div>
                    @endif
                </li><!-- /.list-group-item -->
                {!! $jobs->render() !!}

            </ul><!-- /.list-group -->

        </div><!-- /.container -->
    </div><!-- My Orders -->
@endsection
@section('footer-scripts')
    <div class="modal fade bs-example-modal-lg" id="shares" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                </div>
            </div>
        </div>
    </div>
    {!! HTML::style('local/public/assets/css/magicsuggest-min.css') !!}
    {!! HTML::script('local/public/assets/js/magicsuggest-min.js') !!}
    {!! HTML::script('local/public/assets/js/bootstrap/tooltip.js') !!}
    {!! HTML::script('local/public/assets/js/bootstrap/confirmation.js') !!}

    <script>
        $(document).ready(function () {
            $('select[name="status"]').change(function () {
                var status = $(this).val();
                window.location.href = "{{url('my-orders?status=')}}" + status;
            })
            /* $('[data-toggle="confirmation"]').confirmation({
             // singleton:true
             })*/
        });
    </script>
@endsection

