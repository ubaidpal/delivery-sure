@extends('layouts.default')

<!-- Sidebar right menue -->
@include('includes.sidebar-right-menu')


@section('content')

{{--@include('includes.sidebar-left-categories')	--}}
		
<div class="dashboard-content col-md-8">
    <div class="job-item">
        <!-- Job Header -->
        <div class="job-header">
            <!-- Header Meta -->
            <div class="job-header-meta">
                <div class="pull-left">
                    <a href="javascript:void(0);" class="btn btn-sm btn-yellow">GROCERIES</a>
                    <a href="javascript:void(0);" class="btn btn-sm btn-red">FEATURED</a>
                </div><!-- /.job-btn-container -->

                <div class="time-remaining">
                    <div>JOB ENDS IN</div>
                    <div class="time"><span class="glyphicon glyphicon-time"></span>25 mins</div>
                </div><!-- /.time-remaining -->
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
        </div><!-- /.job-header -->

        <!-- Job Body -->
        <div class="job-body">
            <p class="job-detail">
                Et hercule-fatendum est enim, quod sentio mirabilis est apud illos contextus rerum. Scio enim esse quosdam, qui quavis lingua philosophari possint; Sed quid at at hercule-fatendum est enim, quod sentio mirabilis est apud illos contextus rerum. Scio enim esse quosdam
                <a href="javascript:void(0);" class="btn btn-link">more</a>
            </p><!-- /.job-detail -->

            <div class="buyer-detail">
                <div class="buyer-img">
                    <img src="{!! asset('local/public/assets/images/dummy-profile.jpg') !!}" alt="image">
                </div>

                <div class="buyer-detail-wrapper">
                    <div class="buyer-name">Marilyn Manson</div>
                    <div class="buyer-rating"></div>

                    <div class="buyer-address">
                        <span class="glyphicon glyphicon-map-marker"></span>
                        <span class="buyer-address">7601 East Treasure Dr. Miami Beach, FL 33141</span>
                    </div><!-- /.place-to-deliver-->
                </div><!-- /.buyer-detail-wrapper -->
            </div><!-- /.buyer-detail -->
        </div><!-- /.job-body -->

        <!-- Job Footer -->
        <div class="job-footer">
            <a href="javascript:void(0);" class="btn btn-gray disabled"><span class="glyphicon glyphicon-star"></span></a>
            <a href="job_detail.blade.php" class="btn btn-gray">View details</a>
            <!-- Button trigger modal -->
            <a type="button" class="btn btn-gray" data-toggle="modal" data-target="#quick-view-modal" href="javascript:void(0);">Quick view</a>

            <!-- Modal -->
            <div class="modal fade" id="quick-view-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog container" role="document">
                    <div class="modal-content">
                        <!-- Modal Header -->
                        <div class="modal-header">
                            <div class="col-md-9">
                                <h1 class="modal-title" id="myModalLabel">
                                    <img src="{!! asset('local/public/assets/images/logo-white.png') !!}" alt="image">
                                </h1>

                                <div class="pull-right">
                                    <a class="btn" href="javascript:void(0);"><span class="glyphicon glyphicon-share-alt"></span></a>
                                    <a class="btn" href="javascript:void(0);"><i class="fa fa-heart-o" aria-hidden="true"></i></a>
                                </div><!-- /.modal-header-btn -->
                            </div><!-- /.col-md-9 -->

                            <div class="col-md-3">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            </div><!-- /.col-md-3 -->
                        </div><!-- /.modal-header -->

                        <!-- Modal Body -->
                        <div class="modal-body">
                            <div class="col-md-9">
                                <div class="row">
                                    <div class="modal-map">
                                        <img src="{!! asset('local/public/assets/images/map-modal.jpg') !!}" alt="image">
                                    </div>
                                </div><!-- /.row -->
                            </div><!-- /.col-md-9 -->

                            <div class="col-md-3">
                                <div class="buyer-detail">
                                    <div class="buyer-img">
                                        <img src="{!! asset('local/public/assets/images/a2.jpeg') !!}" alt="image">
                                    </div>

                                    <div class="buyer-detail-wrapper">
                                        <div class="buyer-name">Marilyn Manson</div>
                                        <div>
                                            <div class="buyer-rating"></div>
                                            <span>(6)</span>
                                        </div>
                                        <a href="javascript:void(0);" class="btn btn-blue"><span class="glyphicon glyphicon-erase"></span>Contact Marilyn</a>
                                    </div><!-- /.buyer-detail-wrapper -->
                                </div><!-- /.buyer-detail -->

                                <!-- Modal Content Detail -->
                                <div class="modal-content-detail">
                                    <div class="h3">Job Details</div>
                                    <p>Et hercule-fatendum est enim, quod sentio mirabilis est apud illos contextus rerum. Scio enim esse quosdam, qui quavis lingua philosophari possint; Sed quid attinet de rebus tam apertis plura requirere</p>

                                    <div class="h4">Items list to be delivered</div>
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            <div class="checkbox-container"><input type="checkbox"></div>
                                            <span>One large bread</span>
                                        </li><!-- /.list-group-item -->
                                        <li class="list-group-item">
                                            <div class="checkbox-container"><input type="checkbox"></div>
                                            <span>Half a dozen eggs</span>
                                        </li><!-- /.list-group-item -->
                                        <li class="list-group-item">
                                            <div class="checkbox-container"><input type="checkbox"></div>
                                            <span>Dish wash bar</span>
                                        </li><!-- /.list-group-item -->
                                        <li class="list-group-item">
                                            <div class="checkbox-container"><input type="checkbox"></div>
                                            <span>1 kg detergent bag</span>
                                        </li><!-- /.list-group-item -->
                                    </ul><!-- /.list-group -->

                                    <a href="job_detail.blade.php" class="btn btn-block btn-orange">SUBMIT YOUR BID</a>
                                </div><!-- /.modal-content-detail -->

                            </div><!-- /.col-md-3 -->

                        </div><!-- /.modal-body -->
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->

        </div><!-- /.job-footer -->
    </div><!-- /.job-item -->

    <div class="job-item">
        <!-- Job Header -->
        <div class="job-header">
            <!-- Header Meta -->
            <div class="job-header-meta">
                <div class="pull-left">
                    <a href="javascript:void(0);" class="btn btn-sm btn-yellow">GROCERIES</a>
                    <a href="javascript:void(0);" class="btn btn-sm btn-red">FEATURED</a>
                </div><!-- /.job-btn-container -->

                <div class="time-remaining">
                    <div>JOB ENDS IN</div>
                    <div class="time"><span class="glyphicon glyphicon-time"></span>2 mins</div>
                </div><!-- /.time-remaining -->
            </div><!-- /.job-header-meta -->

            <div class="job-header-detail">
                <div class="h3">Deliver Conspic 50 MG as soon as possible</div>

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
        </div><!-- /.job-header -->

        <!-- Job Body -->
        <div class="job-body">
            <p class="job-detail">
                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                <a href="javascript:void(0);" class="btn btn-link">more</a>
            </p><!-- /.job-detail -->

            <div class="buyer-detail">
                <div class="buyer-img">
                    <img src="{!! asset('local/public/assets/images/dummy-profile.jpg') !!}" alt="image">
                </div>

                <div class="buyer-detail-wrapper">
                    <div class="buyer-name">Sarah Manson</div>
                    <div class="buyer-rating"></div>

                    <div class="buyer-address">
                        <span class="glyphicon glyphicon-map-marker"></span>
                        <span class="buyer-address">7601 East Treasure Dr. Miami Beach, FL 33141</span>
                    </div><!-- /.place-to-deliver-->
                </div><!-- /.buyer-detail-wrapper -->
            </div><!-- /.buyer-detail -->
        </div><!-- /.job-body -->

        <!-- Job Footer -->
        <div class="job-footer">
            <a href="javascript:void(0);" class="btn btn-gray disabled"><span class="glyphicon glyphicon-star"></span></a>
            <a href="job_detail.blade.php" class="btn btn-gray">View details</a>
            <!-- Button trigger modal -->
            <a type="button" class="btn btn-gray" data-toggle="modal" data-target="#quick-view-modal" href="javascript:void(0);">Quick view</a>

            <!-- Modal -->
            <div class="modal fade" id="quick-view-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog container" role="document">
                    <div class="modal-content">
                        <!-- Modal Header -->
                        <div class="modal-header">
                            <div class="col-md-9">
                                <h1 class="modal-title" id="myModalLabel">
                                    <img src="{!! asset('local/public/assets/images/logo-white.png') !!}" alt="image">
                                </h1>

                                <div class="pull-right">
                                    <a class="btn" href="javascript:void(0);"><span class="glyphicon glyphicon-share-alt"></span></a>
                                    <a class="btn" href="javascript:void(0);"><i class="fa fa-heart-o" aria-hidden="true"></i></a>
                                </div><!-- /.modal-header-btn -->
                            </div><!-- /.col-md-9 -->

                            <div class="col-md-3">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            </div><!-- /.col-md-3 -->
                        </div><!-- /.modal-header -->

                        <!-- Modal Body -->
                        <div class="modal-body">
                            <div class="col-md-9">
                                <div class="row">
                                    <div class="modal-map">
                                        <img src="{!! asset('local/public/assets/images/map-modal.jpg') !!}" alt="image">
                                    </div>
                                </div><!-- /.row -->
                            </div><!-- /.col-md-9 -->

                            <div class="col-md-3">
                                <div class="buyer-detail">
                                    <div class="buyer-img">
                                        <img src="{!! asset('local/public/assets/images/dummy-profile.jpg') !!}" alt="image">
                                    </div>

                                    <div class="buyer-detail-wrapper">
                                        <div class="buyer-name">Marilyn Manson</div>
                                        <div>
                                            <div class="buyer-rating"></div>
                                            <span>(6)</span>
                                        </div>
                                        <a href="javascript:void(0);" class="btn btn-blue"><span class="glyphicon glyphicon-erase"></span>Contact Marilyn</a>
                                    </div><!-- /.buyer-detail-wrapper -->
                                </div><!-- /.buyer-detail -->

                                <!-- Modal Content Detail -->
                                <div class="modal-content-detail">
                                    <div class="h3">Job Details</div>
                                    <p>Et hercule-fatendum est enim, quod sentio mirabilis est apud illos contextus rerum. Scio enim esse quosdam, qui quavis lingua philosophari possint; Sed quid attinet de rebus tam apertis plura requirere</p>

                                    <div class="h4">Items list to be delivered</div>
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            <div class="checkbox-container"><input type="checkbox"></div>
                                            <span>One large bread</span>
                                        </li><!-- /.list-group-item -->
                                        <li class="list-group-item">
                                            <div class="checkbox-container"><input type="checkbox"></div>
                                            <span>Half a dozen eggs</span>
                                        </li><!-- /.list-group-item -->
                                        <li class="list-group-item">
                                            <div class="checkbox-container"><input type="checkbox"></div>
                                            <span>Dish wash bar</span>
                                        </li><!-- /.list-group-item -->
                                        <li class="list-group-item">
                                            <div class="checkbox-container"><input type="checkbox"></div>
                                            <span>1 kg detergent bag</span>
                                        </li><!-- /.list-group-item -->
                                    </ul><!-- /.list-group -->

                                    <a href="javascript:void(0);" class="btn btn-block btn-orange">SUBMIT YOUR BID</a>
                                </div><!-- /.modal-content-detail -->

                            </div><!-- /.col-md-3 -->

                        </div><!-- /.modal-body -->
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->

        </div><!-- /.job-footer -->
    </div><!-- /.job-item -->

    <div class="job-item">
        <!-- Job Header -->
        <div class="job-header">
            <!-- Header Meta -->
            <div class="job-header-meta">
                <div class="pull-left">
                    <a href="javascript:void(0);" class="btn btn-sm btn-yellow">GROCERIES</a>
                    <a href="javascript:void(0);" class="btn btn-sm btn-red">FEATURED</a>
                </div><!-- /.job-btn-container -->

                <div class="time-remaining">
                    <div>JOB ENDS IN</div>
                    <div class="time"><span class="glyphicon glyphicon-time"></span>2 mins</div>
                </div><!-- /.time-remaining -->
            </div><!-- /.job-header-meta -->

            <div class="job-header-detail">
                <div class="h3">SONY LED 45R45 needs to be delivered from Tolenton Market </div>

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
        </div><!-- /.job-header -->

        <!-- Job Body -->
        <div class="job-body">
            <p class="job-detail">
                Et hercule-fatendum est enim, quod sentio mirabilis est apud illos contextus rerum. Scio enim esse quosdam, qui quavis lingua philosophari possint; Sed quid at at hercule-fatendum est enim, quod sentio mirabilis est apud illos contextus rerum. Scio enim esse quosdam
                <a href="javascript:void(0);" class="btn btn-link">more</a>
            </p><!-- /.job-detail -->

            <div class="buyer-detail">
                <div class="buyer-img">
                    <img src="{!! asset('local/public/assets/images/dummy-profile.jpg') !!}" alt="image">
                </div>

                <div class="buyer-detail-wrapper">
                    <div class="buyer-name">Izek Dani</div>
                    <div class="buyer-rating"></div>

                    <div class="buyer-address">
                        <span class="glyphicon glyphicon-map-marker"></span>
                        <span class="buyer-address">7601 East Treasure Dr. Miami Beach, FL 33141</span>
                    </div><!-- /.place-to-deliver-->
                </div><!-- /.buyer-detail-wrapper -->
            </div><!-- /.buyer-detail -->
        </div><!-- /.job-body -->

        <!-- Job Footer -->
        <div class="job-footer">
            <a href="javascript:void(0);" class="btn btn-gray disabled"><span class="glyphicon glyphicon-star"></span></a>
            <a href="job_detail.blade.php" class="btn btn-gray">View details</a>
            <!-- Button trigger modal -->
            <a type="button" class="btn btn-gray" data-toggle="modal" data-target="#quick-view-modal" href="javascript:void(0);">Quick view</a>

            <!-- Modal -->
            <div class="modal fade" id="quick-view-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog container" role="document">
                    <div class="modal-content">
                        <!-- Modal Header -->
                        <div class="modal-header">
                            <div class="col-md-9">
                                <h1 class="modal-title" id="myModalLabel">
                                    <img src="{!! asset('local/public/assets/images/logo-white.png') !!}" alt="image">
                                </h1>

                                <div class="pull-right">
                                    <a class="btn" href="javascript:void(0);"><span class="glyphicon glyphicon-share-alt"></span></a>
                                    <a class="btn" href="javascript:void(0);"><i class="fa fa-heart-o" aria-hidden="true"></i></a>
                                </div><!-- /.modal-header-btn -->
                            </div><!-- /.col-md-9 -->

                            <div class="col-md-3">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            </div><!-- /.col-md-3 -->
                        </div><!-- /.modal-header -->

                        <!-- Modal Body -->
                        <div class="modal-body">
                            <div class="col-md-9">
                                <div class="row">
                                    <div class="modal-map">
                                        <img src="{!! asset('local/public/assets/images/map-modal.jpg') !!}" alt="image">
                                    </div>
                                </div><!-- /.row -->
                            </div><!-- /.col-md-9 -->

                            <div class="col-md-3">
                                <div class="buyer-detail">
                                    <div class="buyer-img">
                                        <img src="{!! asset('local/public/assets/images/dummy-profile.jpg') !!}" alt="image">
                                    </div>

                                    <div class="buyer-detail-wrapper">
                                        <div class="buyer-name">Marilyn Manson</div>
                                        <div>
                                            <div class="buyer-rating"></div>
                                            <span>(6)</span>
                                        </div>
                                        <a href="javascript:void(0);" class="btn btn-blue"><span class="glyphicon glyphicon-erase"></span>Contact Marilyn</a>
                                    </div><!-- /.buyer-detail-wrapper -->
                                </div><!-- /.buyer-detail -->

                                <!-- Modal Content Detail -->
                                <div class="modal-content-detail">
                                    <div class="h3">Job Details</div>
                                    <p>Et hercule-fatendum est enim, quod sentio mirabilis est apud illos contextus rerum. Scio enim esse quosdam, qui quavis lingua philosophari possint; Sed quid attinet de rebus tam apertis plura requirere</p>

                                    <div class="h4">Items list to be delivered</div>
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            <div class="checkbox-container"><input type="checkbox"></div>
                                            <span>One large bread</span>
                                        </li><!-- /.list-group-item -->
                                        <li class="list-group-item">
                                            <div class="checkbox-container"><input type="checkbox"></div>
                                            <span>Half a dozen eggs</span>
                                        </li><!-- /.list-group-item -->
                                        <li class="list-group-item">
                                            <div class="checkbox-container"><input type="checkbox"></div>
                                            <span>Dish wash bar</span>
                                        </li><!-- /.list-group-item -->
                                        <li class="list-group-item">
                                            <div class="checkbox-container"><input type="checkbox"></div>
                                            <span>1 kg detergent bag</span>
                                        </li><!-- /.list-group-item -->
                                    </ul><!-- /.list-group -->

                                    <a href="javascript:void(0);" class="btn btn-block btn-orange">SUBMIT YOUR BID</a>
                                </div><!-- /.modal-content-detail -->

                            </div><!-- /.col-md-3 -->

                        </div><!-- /.modal-body -->
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->

        </div><!-- /.job-footer -->
    </div><!-- /.job-item -->

    <div class="job-item">
        <!-- Job Header -->
        <div class="job-header">
            <!-- Header Meta -->
            <div class="job-header-meta">
                <div class="pull-left">
                    <a href="javascript:void(0);" class="btn btn-sm btn-yellow">GROCERIES</a>
                    <a href="javascript:void(0);" class="btn btn-sm btn-red">FEATURED</a>
                </div><!-- /.job-btn-container -->

                <div class="time-remaining">
                    <div>JOB ENDS IN</div>
                    <div class="time"><span class="glyphicon glyphicon-time"></span>15 mins</div>
                </div><!-- /.time-remaining -->
            </div><!-- /.job-header-meta -->

            <div class="job-header-detail">
                <div class="h3">Samsung J5 Screen required from tolenton market</div>

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
        </div><!-- /.job-header -->

        <!-- Job Body -->
        <div class="job-body">
            <p class="job-detail">
                Et hercule-fatendum est enim, quod sentio mirabilis est apud illos contextus rerum. Scio enim esse quosdam, qui quavis lingua philosophari possint; Sed quid at at hercule-fatendum est enim, quod sentio mirabilis est apud illos contextus rerum. Scio enim esse quosdam
                <a href="javascript:void(0);" class="btn btn-link">more</a>
            </p><!-- /.job-detail -->

            <div class="buyer-detail">
                <div class="buyer-img">
                    <img src="{!! asset('local/public/assets/images/dummy-profile.jpg') !!}" alt="image">
                </div>

                <div class="buyer-detail-wrapper">
                    <div class="buyer-name">Marilyn Manson</div>
                    <div class="buyer-rating"></div>

                    <div class="buyer-address">
                        <span class="glyphicon glyphicon-map-marker"></span>
                        <span class="buyer-address">7601 East Treasure Dr. Miami Beach, FL 33141</span>
                    </div><!-- /.place-to-deliver-->
                </div><!-- /.buyer-detail-wrapper -->
            </div><!-- /.buyer-detail -->
        </div><!-- /.job-body -->

        <!-- Job Footer -->
        <div class="job-footer">
            <a href="javascript:void(0);" class="btn btn-gray disabled"><span class="glyphicon glyphicon-star"></span></a>
            <a href="job_detail.blade.php" class="btn btn-gray">View details</a>
            <!-- Button trigger modal -->
            <a type="button" class="btn btn-gray" data-toggle="modal" data-target="#quick-view-modal" href="javascript:void(0);">Quick view</a>

            <!-- Modal -->
            <div class="modal fade" id="quick-view-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog container" role="document">
                    <div class="modal-content">
                        <!-- Modal Header -->
                        <div class="modal-header">
                            <div class="col-md-9">
                                <h1 class="modal-title" id="myModalLabel">
                                    <img src="{!! asset('local/public/assets/images/logo-white.png') !!}" alt="image">
                                </h1>

                                <div class="pull-right">
                                    <a class="btn" href="javascript:void(0);"><span class="glyphicon glyphicon-share-alt"></span></a>
                                    <a class="btn" href="javascript:void(0);"><i class="fa fa-heart-o" aria-hidden="true"></i></a>
                                </div><!-- /.modal-header-btn -->
                            </div><!-- /.col-md-9 -->

                            <div class="col-md-3">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            </div><!-- /.col-md-3 -->
                        </div><!-- /.modal-header -->

                        <!-- Modal Body -->
                        <div class="modal-body">
                            <div class="col-md-9">
                                <div class="row">
                                    <div class="modal-map">
                                        <img src="{!! asset('local/public/assets/images/map-modal.jpg') !!}" alt="image">
                                    </div>
                                </div><!-- /.row -->
                            </div><!-- /.col-md-9 -->

                            <div class="col-md-3">
                                <div class="buyer-detail">
                                    <div class="buyer-img">
                                        <img src="{!! asset('local/public/assets/images/a2.jpeg') !!}" alt="image">
                                    </div>

                                    <div class="buyer-detail-wrapper">
                                        <div class="buyer-name">Marilyn Manson</div>
                                        <div>
                                            <div class="buyer-rating"></div>
                                            <span>(6)</span>
                                        </div>
                                        <a href="javascript:void(0);" class="btn btn-blue"><span class="glyphicon glyphicon-erase"></span>Contact Marilyn</a>
                                    </div><!-- /.buyer-detail-wrapper -->
                                </div><!-- /.buyer-detail -->

                                <!-- Modal Content Detail -->
                                <div class="modal-content-detail">
                                    <div class="h3">Job Details</div>
                                    <p>Et hercule-fatendum est enim, quod sentio mirabilis est apud illos contextus rerum. Scio enim esse quosdam, qui quavis lingua philosophari possint; Sed quid attinet de rebus tam apertis plura requirere</p>

                                    <div class="h4">Items list to be delivered</div>
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            <div class="checkbox-container"><input type="checkbox"></div>
                                            <span>One large bread</span>
                                        </li><!-- /.list-group-item -->
                                        <li class="list-group-item">
                                            <div class="checkbox-container"><input type="checkbox"></div>
                                            <span>Half a dozen eggs</span>
                                        </li><!-- /.list-group-item -->
                                        <li class="list-group-item">
                                            <div class="checkbox-container"><input type="checkbox"></div>
                                            <span>Dish wash bar</span>
                                        </li><!-- /.list-group-item -->
                                        <li class="list-group-item">
                                            <div class="checkbox-container"><input type="checkbox"></div>
                                            <span>1 kg detergent bag</span>
                                        </li><!-- /.list-group-item -->
                                    </ul><!-- /.list-group -->

                                    <a href="javascript:void(0);" class="btn btn-block btn-orange">SUBMIT YOUR BID</a>
                                </div><!-- /.modal-content-detail -->

                            </div><!-- /.col-md-3 -->

                        </div><!-- /.modal-body -->
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->

        </div><!-- /.job-footer -->
    </div><!-- /.job-item -->

    <div class="job-item">
        <!-- Job Header -->
        <div class="job-header">
            <!-- Header Meta -->
            <div class="job-header-meta">
                <div class="pull-left">
                    <a href="javascript:void(0);" class="btn btn-sm btn-yellow">GROCERIES</a>
                    <a href="javascript:void(0);" class="btn btn-sm btn-red">FEATURED</a>
                </div><!-- /.job-btn-container -->

                <div class="time-remaining">
                    <div>JOB ENDS IN</div>
                    <div class="time"><span class="glyphicon glyphicon-time"></span>10 mins</div>
                </div><!-- /.time-remaining -->
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
        </div><!-- /.job-header -->

        <!-- Job Body -->
        <div class="job-body">
            <p class="job-detail">
                Et hercule-fatendum est enim, quod sentio mirabilis est apud illos contextus rerum. Scio enim esse quosdam, qui quavis lingua philosophari possint; Sed quid at at hercule-fatendum est enim, quod sentio mirabilis est apud illos contextus rerum. Scio enim esse quosdam
                <a href="javascript:void(0);" class="btn btn-link">more</a>
            </p><!-- /.job-detail -->

            <div class="buyer-detail">
                <div class="buyer-img">
                    <img src="{!! asset('local/public/assets/images/dummy-profile.jpg') !!}" alt="image">
                </div>

                <div class="buyer-detail-wrapper">
                    <div class="buyer-name">Ellen Pe</div>
                    <div class="buyer-rating"></div>

                    <div class="buyer-address">
                        <span class="glyphicon glyphicon-map-marker"></span>
                        <span class="buyer-address">7601 East Treasure Dr. Miami Beach, FL 33141</span>
                    </div><!-- /.place-to-deliver-->
                </div><!-- /.buyer-detail-wrapper -->
            </div><!-- /.buyer-detail -->
        </div><!-- /.job-body -->

        <!-- Job Footer -->
        <div class="job-footer">
            <a href="javascript:void(0);" class="btn btn-gray disabled"><span class="glyphicon glyphicon-star"></span></a>
            <a href="job_detail.blade.php" class="btn btn-gray">View details</a>
            <!-- Button trigger modal -->
            <a type="button" class="btn btn-gray" data-toggle="modal" data-target="#quick-view-modal" href="javascript:void(0);">Quick view</a>

            <!-- Modal -->
            <div class="modal fade" id="quick-view-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog container" role="document">
                    <div class="modal-content">
                        <!-- Modal Header -->
                        <div class="modal-header">
                            <div class="col-md-9">
                                <h1 class="modal-title" id="myModalLabel">
                                    <img src="{!! asset('local/public/assets/images/logo-white.png') !!}" alt="image">
                                </h1>

                                <div class="pull-right">
                                    <a class="btn" href="javascript:void(0);"><span class="glyphicon glyphicon-share-alt"></span></a>
                                    <a class="btn" href="javascript:void(0);"><i class="fa fa-heart-o" aria-hidden="true"></i></a>
                                </div><!-- /.modal-header-btn -->
                            </div><!-- /.col-md-9 -->

                            <div class="col-md-3">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            </div><!-- /.col-md-3 -->
                        </div><!-- /.modal-header -->

                        <!-- Modal Body -->
                        <div class="modal-body">
                            <div class="col-md-9">
                                <div class="row">
                                    <div class="modal-map">
                                        <img src="{!! asset('local/public/assets/images/map-modal.jpg') !!}" alt="image">
                                    </div>
                                </div><!-- /.row -->
                            </div><!-- /.col-md-9 -->

                            <div class="col-md-3">
                                <div class="buyer-detail">
                                    <div class="buyer-img">
                                        <img src="{!! asset('local/public/assets/images/a3.jpg') !!}" alt="image">
                                    </div>

                                    <div class="buyer-detail-wrapper">
                                        <div class="buyer-name">Marilyn Manson</div>
                                        <div>
                                            <div class="buyer-rating"></div>
                                            <span>(6)</span>
                                        </div>
                                        <a href="javascript:void(0);" class="btn btn-blue"><span class="glyphicon glyphicon-erase"></span>Contact Marilyn</a>
                                    </div><!-- /.buyer-detail-wrapper -->
                                </div><!-- /.buyer-detail -->

                                <!-- Modal Content Detail -->
                                <div class="modal-content-detail">
                                    <div class="h3">Job Details</div>
                                    <p>Et hercule-fatendum est enim, quod sentio mirabilis est apud illos contextus rerum. Scio enim esse quosdam, qui quavis lingua philosophari possint; Sed quid attinet de rebus tam apertis plura requirere</p>

                                    <div class="h4">Items list to be delivered</div>
                                    <ul class="list-group">
                                        <li class="list-group-item">
                                            <div class="checkbox-container"><input type="checkbox"></div>
                                            <span>One large bread</span>
                                        </li><!-- /.list-group-item -->
                                        <li class="list-group-item">
                                            <div class="checkbox-container"><input type="checkbox"></div>
                                            <span>Half a dozen eggs</span>
                                        </li><!-- /.list-group-item -->
                                        <li class="list-group-item">
                                            <div class="checkbox-container"><input type="checkbox"></div>
                                            <span>Dish wash bar</span>
                                        </li><!-- /.list-group-item -->
                                        <li class="list-group-item">
                                            <div class="checkbox-container"><input type="checkbox"></div>
                                            <span>1 kg detergent bag</span>
                                        </li><!-- /.list-group-item -->
                                    </ul><!-- /.list-group -->

                                    <a href="javascript:void(0);" class="btn btn-block btn-orange">SUBMIT YOUR BID</a>
                                </div><!-- /.modal-content-detail -->

                            </div><!-- /.col-md-3 -->

                        </div><!-- /.modal-body -->
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->

        </div><!-- /.job-footer -->
    </div><!-- /.job-item -->



    <div class="btn-center-block">
        <a href="javascript:void(0);" class="btn btn-white">SHOW MORE</a>
    </div><!-- /.btn-center-block -->
</div><!-- /.dashboard-content -->

@endsection
