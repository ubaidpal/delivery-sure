@extends('layouts.home')

<!-- Sidebar right menue -->
@include('includes.sidebar-right-menu')

@section('content')
    <!-- Job Detail View -->
    <div class="job-detail-view autoheight">
        <div class="container">
            <!-- Job Detail View - Body -->
            <div class="job-detail-view-body">
                <div class="col-md-8">
                    <div class="row">

                        <!-- Job View Detail Block -->
                        <div class="job-view-detail-block">
                        	<div class="col-md-12">
                            	<div class="row">
                                	<div class="col-md-3">
                                    	<div class="row">
                                    		<img src="{!! asset('local/public/assets/images/dummy-profile.jpg') !!}" alt="image">
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                    	<div class="profile-wrapper">
                                            <div class="name_l">
                                            	<div class="userName">
                                                <h2>Marilyn Manson</h2>
                                                <div class="location"><span class="glyphicon glyphicon-map-marker"></span> London, United Kigdom</div>
                                            </div>
                                            	<div class="addFav"><i class="fa fa-heart" aria-hidden="true"></i> <a href="#">Add to favorites</a></div>
                                            </div>
                                            <div class="description">
                                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores, fuga repellat! Alias consequuntur dolorem neque numquam provident quisquam quo, totam.Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores, fuga repellat! Alias consequuntur dolorem neque numquam provident quisquam quo, totam. <a href="#">more</a></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- /.job-view-detail-block -->

                        <!-- Job View Detail Block -->
                        <div class="job-view-detail-block">
                            <div class="work-history">Work History <span>(3 Reviews)</span></div><!-- /.jvd-item-title -->
                            <div class="review-wrapper">
                            	<div class="date-box">
                                	<div class="date">Oct 4, 2013 | </div>
                                    <div class="buyer-rating"></div>
                                </div>
                                <div class="tag-line">I need my goods delivered as soon as possible...</div>
                                <p>Sed tamen intellego quid velit. Maximus dolor, inquit, brevis est. Cur igitur easdem res, inquam, Peripateticis dicentibus verbum nullum est, quod non intellegatur? Ne amores quidem sanctos a sapiente alienos esse arbitrantur. At ego quem huic anteponam non audeo dicere;</p>
                            </div>
                            <div class="review-wrapper">
                            	<div class="date-box">
                                	<div class="date">Oct 4, 2013 | </div>
                                    <div class="buyer-rating"></div>
                                </div>
                                <div class="tag-line">I need my goods delivered as soon as possible...</div>
                                <p>Sed tamen intellego quid velit. Maximus dolor, inquit, brevis est. Cur igitur easdem res, inquam, Peripateticis dicentibus verbum nullum est, quod non intellegatur? Ne amores quidem sanctos a sapiente alienos esse arbitrantur. At ego quem huic anteponam non audeo dicere;</p>
                            </div>
                            <div class="review-wrapper">
                            	<div class="date-box">
                                	<div class="date">Oct 4, 2013 | </div>
                                    <div class="buyer-rating"></div>
                                </div>
                                <div class="tag-line">I need my goods delivered as soon as possible...</div>
                                <p>Sed tamen intellego quid velit. Maximus dolor, inquit, brevis est. Cur igitur easdem res, inquam, Peripateticis dicentibus verbum nullum est, quod non intellegatur? Ne amores quidem sanctos a sapiente alienos esse arbitrantur. At ego quem huic anteponam non audeo dicere;</p>
                            </div>
                            <div class="review-wrapper">
                            	<div class="date-box">
                                	<div class="date">Oct 4, 2013 | </div>
                                    <div class="buyer-rating"></div>
                                </div>
                                <div class="tag-line">I need my goods delivered as soon as possible...</div>
                                <p>Sed tamen intellego quid velit. Maximus dolor, inquit, brevis est. Cur igitur easdem res, inquam, Peripateticis dicentibus verbum nullum est, quod non intellegatur? Ne amores quidem sanctos a sapiente alienos esse arbitrantur. At ego quem huic anteponam non audeo dicere;</p>
                            </div>							
                        </div><!-- /.job-view-detail-block -->

                    </div><!-- /.row -->
                </div><!-- /.col-md-8 -->


                <div class="col-md-4">
                    <div class="job-view-buyer-detail">
                        <!-- Buyer Detail -->
                        <div class="reputaiton">
                        	<h1>Reputation</h1>
                            <h2>3.8 <span>/ 5</span></h2>
                            <div class="date-box">
                                <div class="date">Oct 4, 2013 | </div>
                                <div class="buyer-rating"></div>
                            </div>
                            <div class="progress-wrapper">
                            	<div class="text">78% job success</div>
                                <div class="bar-box">
                                	<div class="bar" style="width:78%;"></div>
                                </div>
                            </div>
                        	<a class="btn btn-orange btn-block" href="my_jobs.blade.php">SEND A JOB INVITATION</a>
                        </div>
                    </div><!-- /.job-view-buyer-detail -->
                </div><!-- /.col-md-4 -->
            </div><!-- /.job-detail-view-body -->

        </div><!-- /.container -->
    </div><!-- /.job-detail -->

@endsection