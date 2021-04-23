{{--

    * Created by   :  Muhammad Yasir
    * Project Name : demedat
    * Product Name : PhpStorm
    * Date         : 16-Jun-16 4:52 PM
    * File Name    : 

--}}
{!! Form::open(['route' => ['order-payment',\Hashids::connection('orders')->encode($bid->order_id)], "id" => "paymentForm",  "class"=>"form-block"]) !!}
{!! Form::hidden('bid_id', \Hashids::connection('orders')->encode($bid->id)) !!}
{!! Form::hidden('bidder_id', \Hashids::connection('orders')->encode($bid->bidder_id)) !!}
<div class="col-sm-12 hide" id="alert-msg">
    <div class="alert alert-danger alert-dismissible" role="alert" >
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
        </button>
         <span id="error-msg"></span>
    </div>
</div>
<div class="row">
    <div class="col-sm-7">
        <div class="form-group">
            <input placeholder="Card Number &ast;" type="text" data-worldpay="number" name="number" class="form-control form-control-animate-border" required>
        </div><!-- /.form-group animate-label -->
        <div class="form-group">
            <input placeholder="Card Holder’s Name &ast;" data-worldpay="name" name="name" type="text" class="form-control form-control-animate-border" required>
        </div><!-- /.form-group animate-label -->

        <div class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <input placeholder="Expiration Month &ast;" data-worldpay="exp-month" name="month" type="text"
                           class="form-control form-control-animate-border" required>
                </div><!-- /.form-group animate-label -->
            </div>
            <div class="col-sm-4">
                <div class="form-group">
                    <input placeholder="Expiration Year &ast;" type="text" data-worldpay="exp-year" name="year"
                           class="form-control form-control-animate-border" required>
                </div><!-- /.form-group animate-label -->
            </div>
        </div><!-- /.row -->

        <div class="row">
            <div class="col-sm-8">
                <div class="form-group">
                    <input placeholder="Card Verification Code &ast;" type="text" data-worldpay="cvc" name="cvc" class="form-control form-control-animate-border" required>
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
        <button type="submit" class="btn btn-green pull-right" id="pay-now">PAY NOW</button>
    </div><!-- /.col-sm-5 -->


</div><!-- /.row -->

{!! Form::close() !!}
<?php
$client_key = \Config::get('constant_settings.WORLDPAY_CLIENT_KEY');
?>


<script>
    jQuery('#pay-now').unbind('click').bind('click', function (e) {

        $('#paymentForm').unbind('submit').bind('submit', function (e) {
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val()
                }
            });
            var data = $('#paymentForm').serialize();
            $.ajax({
                type:"POST",
                url:"{{route('order-payment',[\Hashids::connection('orders')->encode($bid->order_id)])}}",
                data:data,
                beforeSend:function(){
                    $('#pay-now').text('Wait....').prop('disabled', true)
                },
                success:function(data){
                    if(data.error == 1){
                        $('#error-msg').empty().html('<strong>Error!</strong> '+ data.message);
                        $('#alert-msg').removeClass('hide');
                    }else if(data.error == 2){
                        var html = '<ul>';
                        $.each(data.errors,function(index, value){
                            html += '<li>'+value+'</li>'
                        });
                        html += '</ul>';
                        $('#error-msg').empty().html(html);
                        $('#alert-msg').removeClass('hide');
                    }else if(data.error == 0){
                        window.location = '{{url('my-orders')}}'
                    }
                },error:function(){

                }, complete: function () {
                    $('#pay-now').text('Pay Now').prop('disabled', false)
                }
            });
        });

    });
</script>
