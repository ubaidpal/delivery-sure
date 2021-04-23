
@extends('layouts.default')

<!-- Sidebar right menue -->
@include('includes.sidebar-right-menu')


@section('content')

<!-- Withdrawls -->
<div class="autoheight">
    <div class="container">
        <div class="col-xs-12">
            <div class="h2b">Settings</div>
        </div><!-- /.col-xs-12 -->

        <div class="row">
            <div class="list-group-green-header col-md-3 col-xs-6">
                <ul class=" list-group">
                    <li class="list-group-item"><a href="profile_setting.blade.php">My Profile</a></li><!-- /.list-group-item -->
                    <li class="list-group-item active"><a href="withdrawls.html">Withdrawls</a></li><!-- /.list-group-item -->
                    <li class="list-group-item"><a href="statements.blade.php">Statements</a></li><!-- /.list-group-item -->
                    <li class="list-group-item"><a href="profile_setting_feedback.blade.php">Feedbacks</a></li><!-- /.list-group-item -->
                    <li class="list-group-item"><a href="change_password.blade.php">Change Password</a></li><!-- /.list-group-item -->
                </ul><!-- /.list-group-green-header -->
            </div><!-- /.list-group-green-header -->

            <div class="withdrawl col-md-9 col-xs-12">
                <ul class="list-group">
                    <li class="list-group-item">
                        <div class="withdrawl-header">
                            <div class="h3b pull-left">Withdrawals</div>
                            <div class="h4b t-balance">Total Balance: USD 5,098.52</div>
                        </div>

                        <p class="withdrawl-msg">You currently have no withdrawals pending or queued for processing.</p>

                        <div class="btn-container">
                            <a class="btn btn-gray" href="javascript:void(0);">Make a Withdrawal</a>
                            <a class="btn btn-link" href="add-bank-account.html">Edit Bank Account</a>
                        </div>
                    </li><!-- /.list-group-item -->
                </ul><!-- /.list-group -->

                <ul class="withdrawl-list-group list-group">
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="h4b">Pending withdrawals :</div>
                            </div>
                            <div class="col-sm-9">
                                <ul class="nested-withdrawl list-group">
                                    <li class="list-group-item">
                                        <div class="pull-left">$2,000.00 <span class="h4b">to Bank Account</span></div>
                                        <div class="pull-right">Requested Date: 09 March 2016</div>
                                    </li><!-- /.list-group-item -->

                                    <li class="list-group-item">
                                        <div>Your withdrawals will be processed within (7 - 14 business days)</div>
                                    </li><!-- /.list-group-item -->

                                </ul><!-- /.nested-withdrawl -->
                            </div><!-- /.col-sm-9 -->
                        </div><!-- /.row -->
                    </li><!-- /.list-group-item -->
                </ul><!-- /.withdrawl-list-group /.list-group -->

                <ul class="withdrawl-list-group list-group">
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="h4b">Payment Type :</div>
                            </div>
                            <div class="col-sm-9">
                                <ul class="nested-withdrawl list-group">
                                    <li class="list-group-item add-border-bottom">
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked>
                                                Available Balance
                                            </label>
                                        </div><!-- /.radio -->

                                        <div class="withdrawl-payment-type">
                                            <div class="radio pull-left">
                                                <label>
                                                    <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked>
                                                    Other Amount - $
                                                </label>
                                            </div><!-- /.radio -->
                                            <div class="pull-left">
                                                <input type="text" class="form-control amount">
                                            </div>
                                        </div>
                                    </li><!-- /.list-group-item -->

                                </ul><!-- /.nested-withdrawl -->
                            </div><!-- /.col-sm-9 -->
                        </div><!-- /.row -->
                    </li><!-- /.list-group-item -->

                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="h4b">Fee :</div>
                            </div>
                            <div class="col-sm-9">
                                <ul class="nested-withdrawl list-group">
                                    <li class="list-group-item">
                                        <div><span class="h4b">$0.00</span> (10% of the total withdrawal amount)</div>
                                    </li><!-- /.list-group-item -->

                                    <li class="list-group-item">
                                        <div>You are about to send <span class="h4b">$0.00</span> to your bank account</div>
                                    </li><!-- /.list-group-item -->
                                </ul><!-- /.nested-withdrawl -->

                                <div class="btn-container">
                                    <a class="btn btn-green" href="javascript:void(0);">SUBMIT WITHDRAWL</a>
                                    <a class="btn btn-gray" href="javascript:void(0);">CANCEL</a>
                                </div>
                            </div><!-- /.col-sm-9 -->
                        </div><!-- /.row -->
                    </li><!-- /.list-group-item -->

                </ul><!-- /.withdrawl-list-group /.list-group -->

            </div><!-- /.add-bank-account /.col-md-9 /.col-xs-12-->




        </div><!-- /.row -->
    </div><!-- /.container -->
</div><!-- Withdrawls -->

@endsection

