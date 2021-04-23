{{--

    * Created by   :  Muhammad Yasir
    * Project Name : demedat
    * Product Name : PhpStorm
    * Date         : 18-Oct-16 11:48 AM
    * File Name    : 

--}}
<div class="modal fade bs-example-modal-lg" id="order-summary" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="os-wrapper">
                    <div class="os-header">
                        <h1>Order Summary</h1>
                    </div>
                    <div class="os-content">
                        <h2>Order Title</h2>
                        <p id="title">Et hercule-fatendum est enim, quod sentio mirabilis est apud illos contextus </p>
                        <h2>Special instructions for the driver</h2>
                        <p id="order_description" style=" white-space: pre-wrap;">Et hercule-fatendum est enim, quod sentio mirabilis est apud illos contextus rerum. Scio enim esse quosdam, qui quavis lingua philosophari possint; Sed quid attinet de rebus tam apertis plura requirere</p>
                        <div class="row">
                            <div class="col-md-6">
                                <address>
                                    <h4>Delivery Location and time</h4>
                                    <div class="os-address">
                                        <span class="glyphicon glyphicon-map-marker"></span>
                                        <div id="delivery_location">7601 East Treasure Dr. Miami Beach, FL 33141</div>
                                    </div>
                                    <div class="os-dt">
                    	<span class="mr10">
                        	<span class="glyphicon glyphicon-time"></span>
                            <span id="delivery_time">12:00 PM</span>
                        </span>
                                        <span>
                                            <span class="glyphicon glyphicon-calendar"></span>
                                            <span id="datepicker">29-10-2016</span>
                                        </span>
                                    </div>
                                </address>
                            </div>
                            <div class="col-md-6" id="pickup-block">
                                <address>
                                    <h4>Pickup Location and time</h4>
                                    <div class="os-address">
                                        <span class="glyphicon glyphicon-map-marker"></span>
                                        <div id="pickUp_location">7601 East Treasure Dr. Miami Beach, FL 33141</div>
                                    </div>
                                    <div class="os-dt">
                    	<span class="mr10">
                        	<span class="glyphicon glyphicon-time"></span>
                            <span id="pickup_time">12:00 PM</span>
                        </span>
                                        <span><span class="glyphicon glyphicon-calendar"></span>
                                            <span id="pickTime"> 29-10-2016</span>
                                        </span>
                                    </div>
                                </address>
                            </div>
                            <div class="clearfix"></div>
                        </div>

                        <h4 class="mt20">Items to be delivered</h4>
                        <div class="os-list-wrapper">
                            <table class="table">
                                <tbody id="items">
                                <tr>
                                    <td>One large bread</td>
                                    <td class="align-right">$ 2.20</td>
                                </tr>
                                <tr>
                                    <td>One small bread</td>
                                    <td class="align-right">$ 1.20</td>
                                </tr>
                                <tr>
                                    <td>Eggs - One Dozen</td>
                                    <td class="align-right">$ 3.00</td>
                                </tr>
                                </tbody>
                            </table>
                            <div class="row">
                                <div class="os-amount col-md-7 col-md-offset-5">
                                    <div class="os-item-price">
                                        <div class="text">Total item(s) price</div>
                                        <div class="value" id="item-price">$11.60</div>
                                    </div>
                                    <div class="os-item-price">
                                        <div class="text"><span class="glyphicon glyphicon-plus"></span> Estimated delivery fees</div>
                                        <div class="value" >$ <span id="estimate_delivery_fee">20.00</span> </div>
                                    </div>
                                    <div class="os-total">
                                        <div class="text">Total</div>
                                        <div class="value" id="total">$20.00</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="os-btn-wrapper row">
                            <div class="col-md-6">
                                <a class="btn btn-green" data-dismiss="modal" href="javascript:void(0)">Edit your order</a>
                            </div>
                            <div class="col-md-6">
                                <a class="btn btn-green" href="javascript:void(0)" id="submit-order">confirm &amp; proceed</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
