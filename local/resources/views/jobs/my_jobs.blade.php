@extends('layouts.default')

<!-- Sidebar right menue -->
@include('includes.sidebar-right-menu')

@section('content')

    <!-- My Jobs -->
    <div class="my-jobs autoheight">
        <div class="container">
            <div class="row">

                <div class="col-xs-3">
                    <div class="h2b mt40">My Jobs</div>
                </div><!-- /.col-sm-8 -->

                <div class="form-group col-xs-2 col-xs-offset-7 mt30">
                    <div class="bg-white">
                        <?php $status = config('constant_settings.ORDER_STATUS_MSG');?>
                        <select class="form-control" name="status" id="jobs-filter">
                            <option @if(Request::get('status') === "all")  selected @endif value="all">All</option>
                            @foreach($status as $key => $value)

                                <option @if(Request::get('status') === "$key") selected
                                        @endif value="{{$key}}">{{$value}}</option>

                            @endforeach
                            <option @if(Request::is('my-proposals')) selected @endif value="my-proposals">My Proposals</option>
                            <option @if(Request::is('my-proposals/other')) selected @endif value="my-proposals/other">Awarded to Other
                            </option>
                        </select>

                    </div>
                </div>

            </div><!-- /.row -->
            @include('includes.alerts')
            <ul class="list-group">
                <li class="list-group-item">
                    <div class="row">
                        <div class="col-xs-4">
                            <div class="h4b">Contracts <!-- HTML to write -->
                            </div>
                        </div><!-- /.col-xs-6 -->
                        <div class="col-xs-2">
                            <div class="h4b">Client</div>
                        </div><!-- /.col-xs-2 -->
                        <div class="col-xs-2">
                            <div class="h4b">Time Period</div>
                        </div><!-- /.col-xs-2 -->
                        <div class="col-xs-2">
                            <div class="h4b">Proposed Delivery Fee</div>
                        </div><!-- /.col-xs-2 -->
                        <div class="col-xs-2">
                            <div class="h4b">Status</div>
                        </div><!-- /.col-xs-2 -->
                    </div><!-- /.row -->
                </li><!-- /.list-group-item -->
            </ul><!-- /.list-group -->
            <!-- Generated markup by the plugin -->

            <ul class="my-jobs-list list-group">
                @if(count($myJobs) > 0)
                    <li class="list-group-item">

                        @foreach($myJobs as $job)

                            <div class="my-proposal">
                                <div class="col-xs-4">
                                    <div class="h3g">
                                        <a href="{{route('job-progress',[Hashids::connection('orders')->encode($job->order_id)])}}"
                                           class="h3g">{{$job->title}}</a>
                                    </div>
                                    <div class="job-desc">
                                        <p>{{\Illuminate\Support\Str::limit($job->order_description,150)}} </p>
                                    </div>

                                </div><!-- /.col-xs-6 -->
                                <div class="col-xs-2">
                                    <a href="{{route('profile',[encodeId($job->clientId,'favourite')])}}">
                                        <div class="message-thread-img">
                                            <img src="{!! getImage($job->profile_photo_url,'41x41') !!}"
                                                 alt="image">
                                        </div><!-- /.message-thread-item -->
                                        <div class="uname">{{$job->display_name}}</div>
                                    </a>
                                </div><!-- /.col-xs-2 -->
                                <div class="col-xs-2">
                                    <div class="time-date">
                                        {{getTimeByTZ($job->deliver_date_time,'H:i A M d, Y')}}
                                    </div>
                                </div><!-- /.col-xs-2 -->
                                <div class="col-xs-2">
                                    <div class="total-earning">
                                        <a data-container="body" data-toggle="popover" href="javascript:void(0);"
                                           class="total-earning-valuedcf"
                                           data-popover-content="#content-{{$job->order_id}}">{{format_currency($job->bid_amount)}}</a>
                                        <div id="content-{{$job->order_id}}">
                                            <div class="total-earning-hover popover-body">
                                                <div class="earning-hover-item">
                                                    <div class="h4b">Goods Value:</div>
                                                    <div>{{format_currency($job->proposed_item_value)}}</div>
                                                </div><!-- /.earning-hover-item -->
                                                <div class="earning-hover-item">
                                                    <div class="h4b">Delivery Fees:</div>
                                                    <div>{{format_currency($job->estimate_delivery_fee)}}</div>
                                                </div><!-- /.earning-hover-item -->
                                                <div class="earning-hover-item">
                                                    <div class="h4b">Proposed Delivery Fees:</div>
                                                    <div>{{format_currency($job->bid_amount)}}</div>
                                                </div><!-- /.earning-hover-item -->
                                            </div><!-- /.total-earning-hover -->
                                        </div>

                                    </div><!-- /.total-earning-value -->
                                </div><!-- /.col-xs-2 -->
                                <div class="col-xs-2">
                                    <div class="order-status">
                                        @if($job->status != config('constant_settings.ORDER_STATUS.IN_PROCESS') && $job->delivery_driver_id != $user->id)
                                            Awarded to other
                                        @else
                                            {{config('constant_settings.ORDER_STATUS_MSG.'.$job->status)}}
                                        @endif
                                    </div>
                                </div><!-- /.col-xs-2 -->
                                <div class="clearfix"></div>
                            </div><!-- /.row -->

                        @endforeach


                    </li><!-- /.list-group-item -->
                @else
                    <li class="list-group-item">
                        <div class="no-record"><a href="{{'dashboard'}}">Find a job and submit your proposal!</a></div>
                    </li>
                @endif
                @if(count($myJobs) > 0)
                    {!! $myJobs->render() !!}
                @endif
            </ul><!-- /.list-group -->

        </div><!-- /.container -->
    </div><!-- /.my-jobs -->
@endsection
@section('footer-scripts')

    <script>
        $(document).ready(function () {
            $('select[name="status"]').change(function () {
                var status = $(this).val();
                if (status == 'my-proposals') {
                    window.location.href = "{{route('my-proposals')}}"
                } else if (status == 'my-proposals/other') {
                    window.location.href = "{{route('my-proposals',['other'])}}"
                } else {
                    window.location.href = "{{url('my-jobs?status=')}}" + status;

                }
            });
            /* $('[data-toggle="confirmation"]').confirmation({
             // singleton:true
             })*/
        });
    </script>
    <style>
        .popover {
            background-color: #ffffff;
            border: 1px solid #77c720;
            border-radius: 4px;
            cursor: pointer;
            display: none;
            position: absolute;

            width: 200px;
            z-index: 1000;
        }
    </style>
@stop


