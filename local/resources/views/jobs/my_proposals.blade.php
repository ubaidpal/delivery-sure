@extends('layouts.default')

        <!-- Sidebar right menue -->
@include('includes.sidebar-right-menu')

@section('content')

        <!-- My Jobs -->
<div class="my-jobs autoheight">
    <div class="container">
        <div class="row">

            <div class="col-xs-3">
                <div class="h2b mt40">My Proposals</div>
            </div><!-- /.col-sm-8 -->

            {{-- <div class="col-xs-4 col-xs-offset-1">
                 <div class="form-group">
                     <label class="animate-label">Client</label>
                     <select class="form-control form-control-animate-border">
                         <option></option>
                         <option>1</option>
                     </select>
                 </div><!-- /.form-group -->
             </div><!-- /.col-sm-4 -->
             <div class="col-xs-4">
                 <div class="form-group">
                     <label class="animate-label">Time Period</label>
                     <select class="form-control form-control-animate-border">
                         <option></option>
                         <option>1</option>
                     </select>
                 </div><!-- /.form-group -->
             </div><!-- /.col-sm-4 -->--}}

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
                        <div class="h4b">Total Earnings</div>
                    </div><!-- /.col-xs-2 -->
                    <div class="col-xs-2">
                        <div class="h4b">Status</div>
                    </div><!-- /.col-xs-2 -->
                </div><!-- /.row -->
            </li><!-- /.list-group-item -->
        </ul><!-- /.list-group -->
        @include('includes.alerts')
        <ul class="my-jobs-list list-group">
            <li class="list-group-item">
            @if(count($myJobs) > 0)
                @foreach($myJobs as $job)

                        <div class="my-proposal">
                            <div class="col-xs-4">
                                <div class="h3g">
                                    @if(!is_null($job->deleted_at) || $job->is_archive == 1)
                                        {{$job->title}}
                                    @else
                                        <a href="{{route('order-detail',[Hashids::connection('orders')->encode($job->order_id)])}}"
                                           class="h3g">{{$job->title}}
                                        </a>
                                    @endif
                                </div>

                            </div><!-- /.col-xs-6 -->
                            <div class="col-xs-2">
                                <div class="message-thread-img">
                                    <img src="{!! getImage($job->profile_photo_url) !!}"
                                         alt="image">
                                </div><!-- /.message-thread-item -->
                                <div class="uname">{{$job->display_name}}</div>
                            </div><!-- /.col-xs-2 -->
                            <div class="col-xs-2">
                                <div class="time-date">
                                    {{getTimeByTZ($job->deliver_date_time,'H:i A M d, Y')}}
                                </div>
                            </div><!-- /.col-xs-2 -->
                            <div class="col-xs-2">
                                <div class="total-earning">
                                    <span href="javascript:void(0);"
                                          class="total-earning-value">{{format_currency($job->bid_amount)}}</span>

                                    <div class="total-earning-hover">
                                        <div class="earning-hover-item">
                                            <div class="h4b">Goods Value:</div>
                                            <div>{{format_currency($job->proposed_item_value)}}</div>
                                        </div><!-- /.earning-hover-item -->
                                        <div class="earning-hover-item">
                                            <div class="h4b">Delivery Fees:</div>
                                            <div>{{format_currency($job->bid_amount)}}</div>
                                        </div><!-- /.earning-hover-item -->
                                    </div><!-- /.total-earning-hover -->
                                </div><!-- /.total-earning-value -->
                            </div><!-- /.col-xs-2 -->
                            <div class="col-xs-2">
                                <div class="time-date">
                                    @if(!is_null($job->deleted_at))
                                        Deleted by Purchaser
                                    @elseif($job->is_archive)
                                        Archived by Purchaser
                                    @else
                                        <div>{{config('constant_settings.ORDER_STATUS_MSG.'.$job->status)}}</div>
                                    @endif
                                </div>
                            </div><!-- /.col-xs-2 -->
                            <div class="clrfix"></div>
                            <div class="clearfix"></div>
                        </div><!-- /.row -->

                @endforeach
            @else
            </li><!-- /.list-group-item -->
                <li class="list-group-item">
                    <div class="no-record"><a href="{{'dashboard'}}">Find a job and submit your proposal!</a></div>
                </li>
            @endif

        </ul><!-- /.list-group -->

    </div><!-- /.container -->
</div><!-- /.my-jobs -->

@endsection


