@extends('layouts.home')

<!-- Sidebar right menue -->
@include('includes.sidebar-right-menu')

@section('content')
<!-- Bidders-view -->
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

            <ul class="bidders-list-group list-group">
                <li class="list-group-item">
                    <div class="h2b">Bidders</div>
                </li><!-- /.list-group-item -->

                <li class="list-group-item">
                    <div class="col-sm-3">
                        <div class="buyer-detail">
                            <div class="buyer-img">
                                <img src="{!! asset('local/public/assets/images/dummy-profile.jpg') !!}" alt="image">
                            </div>

                            <div class="buyer-detail-wrapper">
                                <div class="buyer-name">Marilyn Manson</div>
                                <div class="buyer-rating"></div>
                                <div class="">(6 Reviews)</div>
                            </div><!-- /.buyer-detail-wrapper -->
                        </div>
                    </div>

                    <div class="col-sm-9">
                        <div class="job-status-item">
                            <div class="h4">Delivery Fees:</div>
                            <span>$30</span>
                        </div>
                        <div class="job-status-item">
                            <div class="h4">Proposed Item Value:</div>
                            <span>$93</span>
                        </div>

                        <div class="bidders-message">
                            <div class="h3g">Message</div>

                            <p class="txt-b">Sed tamen intellego quid velit. Maximus dolor, inquit, brevis est. Cur igitur easdem res, inquam, Peripateticis dicentibus verbum nullum est, quod non intellegatur? Ne amores quidem sanctos a sapiente alienos esse arbitrantur. At ego quem huic anteponam non audeo dicere;</p>
                            <p class="txt-b">Sed virtutem ipsam inchoavit, nihil amplius. Non est ista, inquam, Piso, magna dissensio. Duo Reges: constructio interrete. Nihilo beatiorem esse Metellum quam Regulum. Hoc tu nunc in illo probas. Quae cum magnifice primo dici viderentur, considerata minus probabantur. An ea, quae per vinitorem antea consequebatur, per se ipsa curabit?</p>
                            <p class="txt-b">Falli igitur possumus. Ut non sine causa ex iis memoriae ducta sit disciplina. Quia dolori non voluptas contraria est, sed doloris </p>

                        </div><!-- /.bidders-message -->

                        <!-- Button trigger modal -->
                        <a class="btn btn-green" data-toggle="modal" data-target="#dealModal1" href="javascript:void(0);">MAKE A DEAL</a>

                        <!-- Modal -->
                        <div class="modal fade" id="dealModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog make-deal" role="document">
                                <div class="modal-content">
                                    <div class="make-deal-header">
                                        <img src="{!! asset('local/public/assets/images/make-deal.jpg') !!}" alt="image">
                                        <h2 id="myModalLabel">Payment</h2>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-sm-7">
                                                <div class="form-group">
                                                    <label class="animate-label">Card Number <span>&ast;</span></label>
                                                    <input type="text" class="form-control form-control-animate-border">
                                                </div><!-- /.form-group animate-label -->
                                                <div class="form-group">
                                                    <label class="animate-label">Card Holder’s Name <span>&ast;</span></label>
                                                    <input type="text" class="form-control form-control-animate-border">
                                                </div><!-- /.form-group animate-label -->

                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label class="animate-label">Expiration Date <span>&ast;</span></label>
                                                            <input type="text" class="form-control form-control-animate-border">
                                                        </div><!-- /.form-group animate-label -->
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label class="animate-label">Expiration Year <span>&ast;</span></label>
                                                            <input type="text" class="form-control form-control-animate-border">
                                                        </div><!-- /.form-group animate-label -->
                                                    </div>
                                                </div><!-- /.row -->

                                                <div class="row">
                                                    <div class="col-sm-8">
                                                        <div class="form-group">
                                                            <label class="animate-label">Card Verification Code <span>&ast;</span></label>
                                                            <input type="text" class="form-control form-control-animate-border">
                                                        </div><!-- /.form-group animate-label -->
                                                    </div>
                                                </div><!-- /.row -->
                                            </div><!-- /.col-sm-7 -->

                                            <div class="col-sm-4 col-sm-offset-1">
                                                <ul class="list-group">
                                                    <li class="list-group-item">
                                                        <div class="row">
                                                            <div class="col-xs-6">
                                                                <span>Goods Value</span>
                                                            </div>
                                                            <div class="col-xs-6">
                                                                <span class="txtb">$ 130.00</span>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-xs-6">
                                                                <span>Delivery Fees</span>
                                                            </div>
                                                            <div class="col-xs-6">
                                                                <span class="txtb">$ 130.00</span>
                                                            </div>
                                                        </div>
                                                    </li><!-- /.list-group-item -->

                                                    <li class="list-group-item">
                                                            <span>Total</span>
                                                            <div class="h2 mt5">$ 170.00</div>
                                                    </li><!-- /.list-group-item -->
                                                </ul>
                                            </div><!-- /.col-sm-5 -->


                                        </div><!-- /.row -->
                                            <a href="javascript:void(0);" class="btn btn-green">PAY NOW</a>
                                        
                                    </div><!-- /.modal-body -->
                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                        </div><!-- /.modal -->

                        <a class="btn btn-gray" href="javascript:void(0);">Contact Bidder</a>

                    </div><!-- /.col-sm-9 -->
                </li><!-- /.list-group-item -->

                <li class="list-group-item">
                    <div class="col-sm-3">
                        <div class="buyer-detail">
                            <div class="buyer-img">
                                <img src="{!! asset('local/public/assets/images/dummy-profile.jpg') !!}" alt="image">
                            </div>

                            <div class="buyer-detail-wrapper">
                                <div class="buyer-name">Marilyn Manson</div>
                                <div class="buyer-rating"></div>
                                <div class="">(6 Reviews)</div>
                            </div><!-- /.buyer-detail-wrapper -->
                        </div>
                    </div>

                    <div class="col-sm-9">
                        <div class="job-status-item">
                            <div class="h4">Delivery Fees:</div>
                            <span>$30</span>
                        </div>
                        <div class="job-status-item">
                            <div class="h4">Proposed Item Value:</div>
                            <span>$93</span>
                        </div>

                        <div class="bidders-message">
                            <div class="h3g">Message</div>

                            <p class="txt-b">Sed tamen intellego quid velit. Maximus dolor, inquit, brevis est. Cur igitur easdem res, inquam, Peripateticis dicentibus verbum nullum est, quod non intellegatur? Ne amores quidem sanctos a sapiente alienos esse arbitrantur. At ego quem huic anteponam non audeo dicere;</p>
                            <p class="txt-b">Sed virtutem ipsam inchoavit, nihil amplius. Non est ista, inquam, Piso, magna dissensio. Duo Reges: constructio interrete. Nihilo beatiorem esse Metellum quam Regulum. Hoc tu nunc in illo probas. Quae cum magnifice primo dici viderentur, considerata minus probabantur. An ea, quae per vinitorem antea consequebatur, per se ipsa curabit?</p>
                            <p class="txt-b">Falli igitur possumus. Ut non sine causa ex iis memoriae ducta sit disciplina. Quia dolori non voluptas contraria est, sed doloris </p>

                        </div><!-- /.bidders-message -->

                        <!-- Button trigger modal -->
                        <a class="btn btn-green" data-toggle="modal" data-target="#dealModal1" href="javascript:void(0);">MAKE A DEAL</a>

                        <!-- Modal -->
                        <div class="modal fade" id="dealModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog make-deal" role="document">
                                <div class="modal-content">
                                    <div class="make-deal-header">
                                        <img src="{!! asset('local/public/assets/images/make-deal.jpg') !!}" alt="image">
                                        <h2 id="myModalLabel">Payment</h2>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-sm-7">
                                                <div class="form-group">
                                                    <label class="animate-label">Card Number <span>&ast;</span></label>
                                                    <input type="text" class="form-control form-control-animate-border">
                                                </div><!-- /.form-group animate-label -->
                                                <div class="form-group">
                                                    <label class="animate-label">Card Holder’s Name <span>&ast;</span></label>
                                                    <input type="text" class="form-control form-control-animate-border">
                                                </div><!-- /.form-group animate-label -->

                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label class="animate-label">Expiration Date <span>&ast;</span></label>
                                                            <input type="text" class="form-control form-control-animate-border">
                                                        </div><!-- /.form-group animate-label -->
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label class="animate-label">Expiration Year <span>&ast;</span></label>
                                                            <input type="text" class="form-control form-control-animate-border">
                                                        </div><!-- /.form-group animate-label -->
                                                    </div>
                                                </div><!-- /.row -->

                                                <div class="row">
                                                    <div class="col-sm-8">
                                                        <div class="form-group">
                                                            <label class="animate-label">Card Verification Code <span>&ast;</span></label>
                                                            <input type="text" class="form-control form-control-animate-border">
                                                        </div><!-- /.form-group animate-label -->
                                                    </div>
                                                </div><!-- /.row -->
                                            </div><!-- /.col-sm-7 -->

                                            <div class="col-sm-4 col-sm-offset-1">
                                                <ul class="list-group">
                                                    <li class="list-group-item">
                                                        <div class="row">
                                                            <div class="col-xs-6">
                                                                <span>Goods Value</span>
                                                            </div>
                                                            <div class="col-xs-6">
                                                                <span class="txtb">$ 130.00</span>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-xs-6">
                                                                <span>Delivery Fees</span>
                                                            </div>
                                                            <div class="col-xs-6">
                                                                <span class="txtb">$ 130.00</span>
                                                            </div>
                                                        </div>
                                                    </li><!-- /.list-group-item -->

                                                    <li class="list-group-item">
                                                        <span>Total</span>
                                                        <div class="h2 mt5">$ 170.00</div>
                                                    </li><!-- /.list-group-item -->
                                                </ul>
                                            </div><!-- /.col-sm-5 -->


                                        </div><!-- /.row -->
                                        <a href="javascript:void(0);" class="btn btn-green">PAY NOW</a>

                                    </div><!-- /.modal-body -->
                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                        </div><!-- /.modal -->

                        <a class="btn btn-gray" href="javascript:void(0);">Contact Bidder</a>

                    </div><!-- /.col-sm-9 -->
                </li><!-- /.list-group-item -->

            </ul><!-- /.list-group -->

        </div><!-- /.bidders-view-header -->
    </div><!-- /.container -->
</div><!-- /.bidders-view -->

@endsection