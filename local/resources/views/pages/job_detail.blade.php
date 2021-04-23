
@extends('layouts.default')

<!-- Sidebar right menue -->
@include('includes.sidebar-right-menu')

@section('content')
    <!-- Job Detail View -->
    <div class="job-detail-view autoheight">
        <div class="container">
            <header class="job-detail-header">
                <div class="jd-header-btn">
                    <a class="btn btn-sm btn-gray pull-left"  href="javascript:void(0);">GROCERIES</a>
                    <a class="btn btn-link pull-right"  href="javascript:void(0);">Flag this listing<i class="fa fa-flag" aria-hidden="true"></i></a>
                </div><!-- /.jd-header-btn -->

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
                            <div class="h4">Item Value:</div>
                            <span>$93</span>
                        </div><!-- /.job-status-item -->
                        <div class="job-status-item">
                            <div class="h4">Estimated Delivery Time:</div>
                            <span>09:30</span>
                        </div><!-- /.job-status-item -->
                    </div><!-- /.job-status -->
                </div><!-- /.job-header-detail -->
            </header><!-- /.job-detail-header -->

            <!-- Job Detail View - Body -->
            <div class="job-detail-view-body">
                <div class="col-md-8">
                    <div class="row">

                        <!-- Job View Detail Block -->
                        <div class="job-view-detail-block">
                            <div class="jvd-item-title h3b">Description</div><!-- /.jvd-item-title -->

                            <div class="job-view-detail-item">
                                <p class="txt">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores, fuga repellat! Alias consequuntur dolorem neque numquam provident quisquam quo, totam.</p>
                                <p class="txt">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores, fuga repellat! Alias consequuntur dolorem neque numquam provident quisquam quo, totam.</p>
                                <p class="txt">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores, fuga repellat! Alias consequuntur dolorem neque numquam provident quisquam quo, totam.</p>
                            </div><!-- /.job-view-detail-item -->
                        </div><!-- /.job-view-detail-block -->

                        <!-- Job View Detail Block -->
                        <div class="job-view-detail-block">
                            <div class="jvd-item-title h3b">Item List</div><!-- /.jvd-item-title -->

                            <div class="job-view-detail-item">
                                <div class="col-xs-6">
                                    <div class="row">Half a dozen eggs</div>
                                </div><!-- /.col-xs-6 -->
                                <div class="col-xs-6">
                                    <div class="row"><span class="dollar">$</span>14.00</div>
                                </div><!-- /.col-xs-6 -->
                            </div><!-- /.job-view-detail-item -->

                            <div class="job-view-detail-item">
                                <div class="col-xs-6">
                                    <div class="row">Washing Bar</div>
                                </div><!-- /.col-xs-6 -->
                                <div class="col-xs-6">
                                    <div class="row"><span class="dollar">$</span>24.00</div>
                                </div><!-- /.col-xs-6 -->
                            </div><!-- /.job-view-detail-item -->

                            <div class="job-view-detail-item">
                                <div class="col-xs-6">
                                    <div class="row">Chocaolate Cake</div>
                                </div><!-- /.col-xs-6 -->
                                <div class="col-xs-6">
                                    <div class="row"><span class="dollar">$</span>55.00</div>
                                </div><!-- /.col-xs-6 -->
                            </div><!-- /.job-view-detail-item -->
                        </div><!-- /.job-view-detail-block -->

                        <!-- Job View Detail Block -->
                        <div class="job-view-detail-block">
                            <div class="jvd-item-title h3b">Location</div><!-- /.jvd-item-title -->

                            <div class="job-view-detail-item">
                                <div class="col-xs-6">
                                    <div class="row">
                                        <div class="lead"><span class="glyphicon glyphicon-map-marker"></span>Pickup Address</div>
                                        <p>PO Box CT16122 Collins Street West, Victoria 8007, Australia.</p>
                                        <a class="btn btn-link" href="javascript:void(0);">View map</a>
                                    </div>
                                </div><!-- /.col-xs-6 -->
                                <div class="col-xs-6">
                                    <div class="row">
                                        <div class="lead"><span class="glyphicon glyphicon-map-marker"></span>Delivery Address</div>
                                        <p>PO Box CT16122 Collins Street West, Victoria 8007, Australia.</p>
                                        <a class="btn btn-link" href="javascript:void(0);">View map</a>
                                    </div>
                                </div><!-- /.col-xs-6 -->
                            </div><!-- /.job-view-detail-item -->


                        </div><!-- /.job-view-detail-block -->

                    </div><!-- /.row -->
                </div><!-- /.col-md-8 -->


                <div class="col-md-4">
                    <div class="job-view-buyer-detail">
                        <!-- Buyer Detail -->
                        <div class="buyer-detail">
                            <div class="buyer-img">
                                <img src="{!! asset('local/public/assets/images/dummy-profile.jpg') !!}" alt="image">
                            </div><!-- /.buyer-img -->
                            <div class="buyer-detail-wrapper">
                                <div class="buyer-name">Marilyn Manson</div>
                                <div class="buyer-rating"></div>
                            </div><!-- /.buyer-detail-wrapper -->
                        </div><!-- /.buyer-detail -->
                        <form>
                            <div class="form-group">
                                <label class="sr-only">Amount (in dollars)</label>
                                <div class="input-group">
                                    <div class="input-group-addon">$</div>
                                    <input type="text" class="form-control" placeholder="Proposed items value">
                                </div>
                            </div><!-- /.form-group -->
                            <div class="form-group">
                                <label class="sr-only">Amount (in dollars)</label>
                                <div class="input-group">
                                    <div class="input-group-addon">$</div>
                                    <input type="text" class="form-control" placeholder="Proposed items value">
                                </div>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" placeholder="Message"></textarea>
                            </div>
                        </form>

                        <a class="btn btn-orange btn-block" href="my_jobs.blade.php">SUBMIT YOUR BID</a>

                    </div><!-- /.job-view-buyer-detail -->
                </div><!-- /.col-md-4 -->
            </div><!-- /.job-detail-view-body -->

        </div><!-- /.container -->
    </div><!-- /.job-detail -->

@endsection