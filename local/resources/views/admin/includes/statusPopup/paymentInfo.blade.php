
<div id="paymentInfo" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Payment Info</h4>
            </div>
            <div class="modal-body">
                <div style="text-align: center;display: none;z-index: 999999999;" id="payment_loader">
                    <img class="img-responsive" src="{!! asset('local/public/assets/images/load/waiting.gif') !!}">
                </div>
                <span id="paymentDetail"></span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>
