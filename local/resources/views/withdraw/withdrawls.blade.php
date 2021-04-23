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
            @include('includes.profile-sidebar')
            <style>
                .error {
                    color: red;
                }


            </style>
            <div class="withdrawl col-md-9 col-xs-12">
                @if(Session::has('error'))
                    <div class="alert-box error">
                        <h2>{{ Session::get('error') }}</h2>
                    </div>
                @endif
                <ul class="list-group">
                    <li class="list-group-item">
                        <div class="withdrawl-header">


                            <div class="h3b pull-left">Withdrawals</div>
                            <div class="h4b t-balance">Total Balance:{{format_currency($available_balance)}}</div>
                        </div>
                        @include('alert.alert')
                        @if(empty($pending_withdrawals))
                            <p class="withdrawl-msg">You currently have no withdrawals pending or queued for
                                processing.</p>
                            @else
                            <p class="withdrawl-msg">You currently have one withdrawals pending or queued for
                                processing.</p>
                        @endif

                        <div class="btn-container">
                            @if(!empty($bank->id))
                                @if(empty($pending_withdrawals))
                                    <a class="btn btn-gray" id="make_withdrawal">Make a Withdrawal</a>
                                @endif
                                <a class="btn btn-link" href="{{url('/getBankAccount')}}">Edit Bank Account</a>
                            @else
                                <a href="{{url('/getBankAccount')}}" class="change-bank btn btn-green">Add bank
                                    account</a>
                            @endif


                        </div>
                    </li><!-- /.list-group-item -->
                </ul><!-- /.list-group -->
                @if(!empty($pending_withdrawals))
                    <ul class="withdrawl-list-group list-group">
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="h4b">Pending withdrawals :</div>
                                </div>

                                <div class="col-sm-9">

                                    <ul class="nested-withdrawl list-group">

                                            <li class="list-group-item">
                                                <div class="pull-left">
                                                    {{format_currency($pending->amount - ($pending->amount * $pending->fee_percentage)/100)}}
                                                    <span class="h4b">to {{$pending->method}}</span></div>
                                                <div class="pull-right">Requested Date: {{$pending->created_at}}</div>

                                                @if($pending->status == 'pending')
                                                    <a class="btn btn-gray" style="margin-left: 10px;"
                                                       href="{{url('cancelWithdrawalRequest/'.$pending->id)}}">Cancel</a>
                                                @endif
                                            </li><!-- /.list-group-item -->

                                        <li class="list-group-item">
                                            <div>Your withdrawals will be processed within (7 - 14 business days)</div>
                                        </li><!-- /.list-group-item -->

                                    </ul><!-- /.nested-withdrawl -->
                                </div><!-- /.col-sm-9 -->
                            </div><!-- /.row -->
                        </li><!-- /.list-group-item -->
                    </ul><!-- /.withdrawl-list-group /.list-group -->
                @endif
                <?php $fee_amount = (($available_balance - $pending_amount) * $fee_percentage) / 100; ?>
                @if(empty($pending_withdrawals))
                    <ul class="withdrawl-list-group list-group" style="@if(count($errors) < 1) display: none; @endif"
                        id="request_container">
                        {!! Form::open(['url' => url("/sendWithdrawalRequest"), "id" => "requestForm"]) !!}
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
                                                    <input type="radio" name="payment_type" value="full" checked>
                                                    Available Balance
                                                </label>
                                            </div><!-- /.radio -->

                                            <div class="withdrawl-payment-type">
                                                <div class="radio pull-left">
                                                    <label>
                                                        <input type="radio" name="payment_type" value="partial">

                                                        Other Amount - $
                                                    </label>
                                                </div><!-- /.radio -->
                                                <div class="pull-left">
                                                    <input disabled="disabled" class="form-control amount" type="text"
                                                           name="amount" placeholder="Amount">
                                                </div>
                                                @if(count($errors) > 0)
                                                    @foreach ($errors->all() as $error)
                                                        <span class="error">{{ $error }}</span>
                                                    @endforeach
                                                @endif
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

                                            <div><span class="h4b"><b
                                                            id="fee_amount">{{format_currency($fee_amount)}}</b></span>
                                                ({{$fee_percentage}}% of the total withdrawal amount)
                                            </div>
                                        </li><!-- /.list-group-item -->

                                        <li class="list-group-item">
                                            <div>You are about to send <span class="h4b"><b
                                                            id="myAmount">{{format_currency(($available_balance - $pending_amount)- $fee_amount)}}</b></span>
                                                to your bank account
                                            </div>
                                        </li><!-- /.list-group-item -->
                                    </ul><!-- /.nested-withdrawl -->

                                    <div class="btn-container">
                                        <a class="btn btn-green" id="submit_request">SUBMIT WITHDRAWL</a>
                                        <a class="btn btn-gray" id="canecl_request">CANCEL</a>
                                    </div>
                                </div><!-- /.col-sm-9 -->
                            </div><!-- /.row -->
                        </li><!-- /.list-group-item -->
                        {!! Form::close() !!}
                    </ul><!-- /.withdrawl-list-group /.list-group -->
                @endif
                <div class="dispute-wrapper" style="display: none;" id="balanced_out">
                    <span class="error" style="color:#F00000;">You have not sufficient amount to proceed with withdrawal or there are pending withdrawals.</span>
                </div>
            </div><!-- /.add-bank-account /.col-md-9 /.col-xs-12-->

        </div><!-- /.row -->
    </div><!-- /.container -->
</div><!-- Withdrawls -->


@endsection
@section('footer-scripts')

    <script src="{{url('local/public/assets/js/jquery.validate.min.js')}}"></script>
    <script type="text/javascript">

        jQuery(document).on('click', '#submit_request', function (e) {
            e.preventDefault();
            jQuery('#requestForm').submit();
        });
        jQuery(document).on('click', '#make_withdrawal', function (e) {
            e.preventDefault();
            var balance = {{$available_balance - $pending_amount}};
            if (balance > 10) {
                jQuery('#request_container').show(0, function (e) {
                    $('html, body').animate({
                        scrollTop: $("#request_container").offset().top
                    }, 2000);
                });
            } else {
                jQuery('#balanced_out').show(0, function (e) {
                    $('html, body').animate({
                        scrollTop: $("#balanced_out").offset().top
                    }, 2000);
                });
            }
        });
        jQuery(document).on('click', '#canecl_request', function (e) {
            e.preventDefault();
            jQuery('#request_container').hide('slow');
        });
        jQuery(document).on('click', 'input[name="payment_type"]', function (e) {
            if (jQuery(this).val() == 'partial') {
                jQuery('input[name="amount"]').prop('disabled', false);
            } else {
                jQuery('input[name="amount"]').prop('disabled', true).val("").removeClass('error');
                jQuery('#fee_amount').text('${{$fee_amount}}');
                jQuery('#amount-error').css('display', 'none');
            }
        });

        jQuery('input[name="amount"]').keyup('keyup', function (e) {
            var amount = jQuery(this).val();
            var available = {{$available_balance-$pending_amount}};
            var percentage = {{$fee_percentage}};
            if (amount > 0 && amount <= available) {
                fee = (amount * percentage) / 100;
                fee = Math.round(fee * 100) / 100;
                jQuery('#fee_amount').text('$' + fee);
                myAmount = Math.round((amount - fee) * 100) / 100;
                jQuery("#myAmount").text('$' + myAmount);
            } else {
                jQuery('#fee_amount').text('$0.00');
            }
        });

        jQuery(document).ready(function (e) {
            jQuery('#requestForm').validate({
                errorElement: 'span',
                rules: {
                    "payment_type": {required: true},
                    "amount": {
                        required: function (e) {
                            if (jQuery('input[name="payment_type"]').val() == 'partial') {
                                return false;
                            } else {
                                return true;
                            }
                        }, max:{{$available_balance - $pending_amount}}, min: 10, number: true
                    }
                }
            });
        });
    </script>
@stop

