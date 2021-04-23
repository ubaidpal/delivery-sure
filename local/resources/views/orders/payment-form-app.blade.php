{{--

    * Created by   :  Muhammad Yasir
    * Project Name : demedat
    * Product Name : PhpStorm
    * Date         : 20-Sep-16 10:58 AM
    * File Name    : 

--}}
{{--

    * Created by   :  Muhammad Yasir
    * Project Name : demedat
    * Product Name : PhpStorm
    * Date         : 16-Jun-16 4:52 PM
    * File Name    :

--}}
<link href="http://dev.demedat.com/local/public/assets/css/style.css" rel="stylesheet">
<script src="https://cdn.worldpay.com/v1/worldpay.js"></script>
{!! Form::open(['route' => ['order-payment-app',\Hashids::connection('orders')->encode($bid->order_id)], "id" => "paymentForm",  "class"=>"form-block"]) !!}
{!! Form::hidden('bid_id', \Hashids::connection('orders')->encode($bid->id)) !!}
{!! Form::hidden('bidder_id', \Hashids::connection('orders')->encode($bid->bidder_id)) !!}
<div class="row">
    <div class="col-sm-7">
        <div class="form-group">
            <input placeholder="Card Number &ast;" type="text" data-worldpay="number" name="number"
                   class="form-control form-control-animate-border">
        </div><!-- /.form-group animate-label -->
        <div class="form-group">
            <input placeholder="Card Holder’s Name &ast;" data-worldpay="name" name="name" type="text"
                   class="form-control form-control-animate-border">
        </div><!-- /.form-group animate-label -->

        <div class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <input placeholder="Expiration Month &ast;" data-worldpay="exp-month" name="exp-month" type="text"
                           class="form-control form-control-animate-border">
                </div><!-- /.form-group animate-label -->
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <input placeholder="Expiration Year &ast;" type="text" data-worldpay="exp-year" name="exp-year"
                           class="form-control form-control-animate-border">
                </div><!-- /.form-group animate-label -->
            </div>
        </div><!-- /.row -->

        <div class="row">
            <div class="col-sm-8">
                <div class="form-group">
                    <input placeholder="Card Verification Code &ast;" type="text" data-worldpay="cvc" name="cvc"
                           class="form-control form-control-animate-border">
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
                        <span class="txtb">{{format_currency($bid->proposed_item_value)}}</span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6">
                        <span>Delivery Fees</span>
                    </div>
                    <div class="col-xs-6">
                        <span class="txtb">{{format_currency($bid->bid_amount)}}</span>
                    </div>
                </div>
            </li><!-- /.list-group-item -->

            <li class="list-group-item">
                <span>Total</span>

                <div class="h2 mt5">{{format_currency($bid->proposed_item_value + $bid->bid_amount)}}</div>
            </li><!-- /.list-group-item -->
        </ul>
    </div><!-- /.col-sm-5 -->


</div><!-- /.row -->
<button type="submit" class="btn btn-green" id="pay-now">PAY NOW</button>
{!! Form::close() !!}
<?php
$client_key = \Config::get('constant_settings.WORLDPAY_CLIENT_KEY');
?>


<script>
    jQuery(document).on("click", '#pay-now', function (e) {
        e.preventDefault();
        // $("#loading-div-background").css({opacity: 0.8});
        // $("#loading-div-background").show();
        //$("#loading-div-background").hide();

        jQuery('#paymentForm').submit();
    });
    var form = document.getElementById('paymentForm');

    Worldpay.useOwnForm({
        'clientKey': '{{$client_key}}',
        'form': form,
        'reusable': true,
        'callback': function (status, response) {
            // document.getElementById('paymentErrors').innerHTML = '';
            if (response.error) {
                $("#loading-div-background").css({opacity: 0});
                $("#loading-div-background").hide();
                Worldpay.handleError(form, document.getElementById('paymentErrors'), response.error);
            } else {
                var token = response.token;
                Worldpay.formBuilder(form, 'input', 'hidden', 'token', token);
                form.submit();
            }
        }
    });
</script>
