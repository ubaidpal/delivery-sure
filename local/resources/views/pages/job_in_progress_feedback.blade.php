
@extends('layouts.default')

<!-- Sidebar right menue -->
@include('includes.sidebar-right-menu')

@section('content')

<!-- Job In Progress - Feedback -->
<div class="bidders-view autoheight">
    <div class="container">
        <div class="bidders-view-header">
            <!-- Header Meta -->
            <div class="bidders-header-meta">
                <a href="javascript:void(0);" class="btn btn-sm btn-gray">GROCERIES</a>
                <a href="javascript:void(0);" class="btn btn-green pull-right">VIEW LISTING</a>
            </div><!-- /.job-header-meta -->

            <div class="job-header-detail">
                <div class="h3">I need my goods delivered as soon as possible...</div>

                <div class="job-status">
                    <div class="job-status-item">
                        <div class="h4">Status:</div>
                        <span>Urgent</span>
                    </div><!-- /.job-status-item -->
                    <div class="job-status-item">
                        <div class="h4">Estimated Delivery Fees:</div>
                        <span>$30</span>
                    </div><!-- /.job-status-item -->
                    <div class="job-status-item">
                        <div class="h4">Estimated Delivery Time:</div>
                        <span>30 mins</span>
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
                </li><!-- /.list-group-item -->

                <li class="list-group-item">
                    <div class="col-sm-10 col-sm-offset-1">
                        <div class="h2b pull-left">Delivered</div>
                    </div><!-- /.col-sm-10 -->
                </li><!-- /.list-group-item -->

                <li class="list-group-item">
                    <div class="col-sm-10 col-sm-offset-1">

                        <div class="feedback-seller">
                            <div class="h3b">Feedback to seller</div>
                            <div class="rating-item">
                                <div class="feedback-rating">
                                    <img src="{!! asset('local/public/assets/images/feedback-rating.png') !!}" alt="image">
                                </div>
                                <div class="txt-b">Communication</div>
                            </div><!-- /.rating-item -->
                            <div class="rating-item">
                                <div class="feedback-rating">
                                    <img src="{!! asset('local/public/assets/images/feedback-rating.png') !!}" alt="image">
                                </div>
                                <div class="txt-b">Adherence to schedule</div>
                            </div><!-- /.rating-item -->
                        </div><!-- /.feedback-seller -->
                        <div class="row">
                            <div class="col-sm-6">
                                <p class="txt-b">Share your experience with this delivery person to the DeliverySure community</p>

                                <div class="form-group">
                                    <textarea class="form-control" rows="6"></textarea>
                                </div>

                                <a href="profile_setting_feedback.blade.php" class="btn btn-green">Submit</a>
                            </div><!-- /.col-sm-6 -->
                        </div><!-- /.row -->

                    </div><!-- /.col-sm-10 -->
                </li><!-- /.list-group-item -->



            </ul><!-- /.list-group -->

        </div><!-- /.bidders-view-header -->
    </div><!-- /.container -->
</div><!-- Job In Progress - Feedback -->

@endsection

