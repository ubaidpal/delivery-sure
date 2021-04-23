
@extends('layouts.home')

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
                        <div class="h2b mt40">My Orders</div>
                    </div><!-- /.col-sm-8 -->

                    <div class="col-md-2 col-md-offset-3 col-sm-4 col-xs-4">
                        <div class="form-group">
                            <label class="animate-label">Status</label>
                            <select class="form-control form-control-animate-border">
                                <option></option>
                                <option>1</option>
                            </select>
                        </div><!-- /.form-group -->
                    </div><!-- /.col-sm-4 -->
                    <div class="col-md-2 col-sm-4 col-xs-4">
                        <div class="form-group">
                            <label class="animate-label">Rider</label>
                            <select class="form-control form-control-animate-border">
                                <option></option>
                                <option>1</option>
                            </select>
                        </div><!-- /.form-group -->
                    </div><!-- /.col-sm-4 -->
                    <div class="col-md-2 col-sm-4 col-xs-4">
                        <div class="form-group">
                            <label class="animate-label">Time Period</label>
                            <select class="form-control form-control-animate-border">
                                <option></option>
                                <option>1</option>
                            </select>
                        </div><!-- /.form-group -->
                    </div><!-- /.col-sm-4 -->

                </div><!-- /.row -->
            </div><!-- /.col-xs-12 -->
        </div><!-- /.row -->

        <ul class="list-group">
            <li class="list-group-item">
                <div class="row">
                    <div class="col-xs-4">
                        <div class="h4b">Contracts</div>
                    </div><!-- /.col-xs-4 -->
                    <div class="col-xs-2">
                        <div class="h4b">Job Awarded</div>
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

        <ul class="my-jobs-list list-group">
            <li class="list-group-item">
                <div class="row">
                    <div class="col-xs-4">
                        <div class="h3g">I need my goods delivered as soon as possible quae duo sunt, unum facit.</div>
                        <div>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iure, veritatis. Lorem ipsum dolor sit.</div>
                    </div><!-- /.col-xs-4 -->
                    <div class="col-xs-2">
                        <div class="message-thread-img">
                            <img src="{!! asset('local/public/assets/images/dummy-profile.jpg') !!}" alt="image">
                        </div><!-- /.message-thread-item -->
                        <div>Adam Lambert</div>
                    </div><!-- /.col-xs-2 -->
                    <div class="col-xs-2">
                        <div>09:30 PM Oct 04, 2013</div>
                    </div><!-- /.col-xs-2 -->
                    <div class="col-xs-2">
                        <div class="">
                            <a href="javascript:void(0);" class="total-earning-value">$300</a>
                            <div class="total-earning-hover">
                                <div class="earning-hover-item">
                                    <div class="h4b">Goods Value:</div>
                                    <div>$150.00</div>
                                </div><!-- /.earning-hover-item -->
                                <div class="earning-hover-item">
                                    <div class="h4b">Delivery Fees:</div>
                                    <div>$150.00</div>
                                </div><!-- /.earning-hover-item -->
                            </div><!-- /.total-earning-hover -->
                        </div><!-- /.total-earning-value -->
                    </div><!-- /.col-xs-2 -->
                    <div class="col-xs-2">
                        <div>In Progress</div>
                    </div><!-- /.col-xs-2 -->
                </div><!-- /.row -->
            </li><!-- /.list-group-item -->

            <li class="list-group-item">
                <div class="row">
                    <div class="col-xs-4">
                        <div class="h3g">I need my goods delivered as soon as possible quae duo sunt, unum facit.</div>
                        <div>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iure, veritatis. Lorem ipsum dolor sit.</div>
                    </div><!-- /.col-xs-4 -->
                    <div class="col-xs-2">
                        <div class="message-thread-img">
                            <img src="{!! asset('local/public/assets/images/dummy-profile.jpg') !!}" alt="image">
                        </div><!-- /.message-thread-item -->
                        <div>Adam Lambert</div>
                    </div><!-- /.col-xs-2 -->
                    <div class="col-xs-2">
                        <div>09:30 PM Oct 04, 2013</div>
                    </div><!-- /.col-xs-2 -->
                    <div class="col-xs-2">
                        <div class="">
                            <a href="javascript:void(0);" class="total-earning-value">$300</a>
                            <div class="total-earning-hover">
                                <div class="earning-hover-item">
                                    <div class="h4b">Goods Value:</div>
                                    <div>$150.00</div>
                                </div><!-- /.earning-hover-item -->
                                <div class="earning-hover-item">
                                    <div class="h4b">Delivery Fees:</div>
                                    <div>$150.00</div>
                                </div><!-- /.earning-hover-item -->
                            </div><!-- /.total-earning-hover -->
                        </div><!-- /.total-earning-value -->
                    </div><!-- /.col-xs-2 -->
                    <div class="col-xs-2">
                        <div>In Progress</div>
                    </div><!-- /.col-xs-2 -->
                </div><!-- /.row -->
            </li><!-- /.list-group-item -->

            <li class="list-group-item">
                <div class="row">
                    <div class="col-xs-4">
                        <div class="h3g">I need my goods delivered as soon as possible quae duo sunt, unum facit.</div>
                        <div>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iure, veritatis. Lorem ipsum dolor sit.</div>
                    </div><!-- /.col-xs-4 -->
                    <div class="col-xs-2">
                        <div class="message-thread-img">
                            <img src="{!! asset('local/public/assets/images/dummy-profile.jpg') !!}" alt="image">
                        </div><!-- /.message-thread-item -->
                        <div>Adam Lambert</div>
                    </div><!-- /.col-xs-2 -->
                    <div class="col-xs-2">
                        <div>09:30 PM Oct 04, 2013</div>
                    </div><!-- /.col-xs-2 -->
                    <div class="col-xs-2">
                        <div class="">
                            <a href="javascript:void(0);" class="total-earning-value">$300</a>
                            <div class="total-earning-hover">
                                <div class="earning-hover-item">
                                    <div class="h4b">Goods Value:</div>
                                    <div>$150.00</div>
                                </div><!-- /.earning-hover-item -->
                                <div class="earning-hover-item">
                                    <div class="h4b">Delivery Fees:</div>
                                    <div>$150.00</div>
                                </div><!-- /.earning-hover-item -->
                            </div><!-- /.total-earning-hover -->
                        </div><!-- /.total-earning-value -->
                    </div><!-- /.col-xs-2 -->
                    <div class="col-xs-2">
                        <div>In Progress</div>
                    </div><!-- /.col-xs-2 -->
                </div><!-- /.row -->
            </li><!-- /.list-group-item -->

            <li class="list-group-item">
                <div class="row">
                    <div class="col-xs-4">
                        <div class="h3g">I need my goods delivered as soon as possible quae duo sunt, unum facit.</div>
                        <div>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iure, veritatis. Lorem ipsum dolor sit.</div>
                    </div><!-- /.col-xs-4 -->
                    <div class="col-xs-2">
                        <div class="message-thread-img">
                            <img src="{!! asset('local/public/assets/images/dummy-profile.jpg') !!}" alt="image">
                        </div><!-- /.message-thread-item -->
                        <div>Adam Lambert</div>
                    </div><!-- /.col-xs-2 -->
                    <div class="col-xs-2">
                        <div>09:30 PM Oct 04, 2013</div>
                    </div><!-- /.col-xs-2 -->
                    <div class="col-xs-2">
                        <div class="">
                            <a href="javascript:void(0);" class="total-earning-value">$300</a>
                            <div class="total-earning-hover">
                                <div class="earning-hover-item">
                                    <div class="h4b">Goods Value:</div>
                                    <div>$150.00</div>
                                </div><!-- /.earning-hover-item -->
                                <div class="earning-hover-item">
                                    <div class="h4b">Delivery Fees:</div>
                                    <div>$150.00</div>
                                </div><!-- /.earning-hover-item -->
                            </div><!-- /.total-earning-hover -->
                        </div><!-- /.total-earning-value -->
                    </div><!-- /.col-xs-2 -->
                    <div class="col-xs-2">
                        <div>In Progress</div>
                    </div><!-- /.col-xs-2 -->
                </div><!-- /.row -->
            </li><!-- /.list-group-item -->

            <li class="list-group-item">
                <div class="row">
                    <div class="col-xs-4">
                        <div class="h3g">I need my goods delivered as soon as possible quae duo sunt, unum facit.</div>
                        <div>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iure, veritatis. Lorem ipsum dolor sit.</div>
                    </div><!-- /.col-xs-4 -->
                    <div class="col-xs-2">
                        <div class="message-thread-img">
                            <img src="{!! asset('local/public/assets/images/dummy-profile.jpg') !!}" alt="image">
                        </div><!-- /.message-thread-item -->
                        <div>Adam Lambert</div>
                    </div><!-- /.col-xs-2 -->
                    <div class="col-xs-2">
                        <div>09:30 PM Oct 04, 2013</div>
                    </div><!-- /.col-xs-2 -->
                    <div class="col-xs-2">
                        <div class="">
                            <a href="javascript:void(0);" class="total-earning-value">$300</a>
                            <div class="total-earning-hover">
                                <div class="earning-hover-item">
                                    <div class="h4b">Goods Value:</div>
                                    <div>$150.00</div>
                                </div><!-- /.earning-hover-item -->
                                <div class="earning-hover-item">
                                    <div class="h4b">Delivery Fees:</div>
                                    <div>$150.00</div>
                                </div><!-- /.earning-hover-item -->
                            </div><!-- /.total-earning-hover -->
                        </div><!-- /.total-earning-value -->
                    </div><!-- /.col-xs-2 -->
                    <div class="col-xs-2">
                        <div>In Progress</div>
                    </div><!-- /.col-xs-2 -->
                </div><!-- /.row -->
            </li><!-- /.list-group-item -->



        </ul><!-- /.list-group -->

    </div><!-- /.container -->
</div><!-- My Orders -->


@endsection
