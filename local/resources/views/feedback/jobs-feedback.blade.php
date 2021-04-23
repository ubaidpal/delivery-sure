@extends('layouts.default')

        <!-- Sidebar right menue -->
@include('includes.sidebar-right-menu')


@section('content')

        <!-- Profile Setting - Feedback -->
<div class="profile-setting autoheight">
    <div class="container">
        <div class="col-xs-12">
            <div class="h2b">Settings</div>
        </div><!-- /.col-xs-12 -->

        <div class="row">
            @include('includes.profile-sidebar')

            <div class="statement-container col-md-9 col-xs-12">
                <ul class="list-group">
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-xs-6">
                                <div class="h3b mb0">Feedback</div>
                            </div><!-- /.col-xs-6 -->
                        </div><!-- /.row -->
                    </li><!-- /.list-group-item -->
                    <li>
                        <ul class="nav nav-tabs">
                            @if($user->is('delivery.man'))
                                <li><a href="{{route('feedback.my-jobs')}}">My Jobs</a></li>
                            @else
                                <li class="active"><a href="{{url('my-feedback')}}">My Orders</a></li>
                            @endif

                        </ul>
                    </li>

                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-xs-6">
                                <div class="h4b">Jobs</div>
                            </div><!-- /.col-xs-6 -->
                            <div class="col-xs-3">
                                <div class="h4b">Order Owner</div>
                            </div><!-- /.col-xs-3 -->
                            <div class="col-xs-3">
                                <div class="h4b">Feedback State</div>
                            </div><!-- /.col-xs-3 -->
                        </div><!-- /.row -->

                    </li><!-- /.list-group-item -->

                    <li class="statement-list list-group-item">

                        <!-- Nested List Group - Statement List -->
                        <ul class="list-group">
                            @if(count($orders) > 0)
                                @foreach($orders as $order)
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-xs-6">
                                                <div class="h4g">
                                                    <a class="feedback-link" data-toggle="modal"
                                                       data-target="#feedbacks"
                                                       href="{{route('show-feedback',[encodeId($order->id,'orders')])}}">
                                                        {{$order->title}}
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="col-xs-3">
                                                @if(isset($order->owner) && !empty($order->owner))
                                                    {{$order->owner->display_name}}
                                                @endif
                                            </div>

                                            <div class="col-xs-3">
                                                @if(isset($order->feedback) && !empty($order->feedback))
                                                    Active
                                                @else
                                                    Pending
                                                @endif
                                            </div>
                                        </div><!-- /.row -->
                                    </li><!-- /.list-group-item -->
                                @endforeach
                            @else
                                <div class="p10">No Feedback found</div>
                            @endif


                        </ul><!-- /.list-group - Nested -->
                    </li><!-- /.list-group-item -->
                </ul><!-- /.place-an-order-group .list-group -->
            </div>

        </div><!-- /.row -->
    </div><!-- /.container -->
</div><!-- /.profile-setting - Feedback -->

@endsection
@section('footer-scripts')
    {!! HTML::script('local/public/assets/plugins/ratting/ratting.js') !!}
    {!! HTML::style('local/public/assets/plugins/ratting/ratting.css') !!}
    <div class="modal fade" id="feedbacks" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-body">

                </div>

            </div>
        </div>
    </div>
    <style>
        .modal-dialog {
            width: 600px;
            margin: 30px auto;
        }
    </style>
    <script>
        $(document).ready(function () {
            $('.feedback-link').click(function () {
                $('.modal-body').empty();
            })
        })
    </script>
@stop
