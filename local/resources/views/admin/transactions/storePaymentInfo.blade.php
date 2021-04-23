<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                @if(!empty($claim))
                    <form enctype="multipart/form-data" method="post" id="paymentInfoForm"
                          action="{{url('admin/saveClaimPaymentinfo/'.$withdrawal_id)}}">
                        @else
                            <form enctype="multipart/form-data" method="post" id="paymentInfoForm"
                                  action="{{url('admin/savePaymentinfo/'.$withdrawal_id)}}">
                        @endif

                                <div class="form-group">
                                    <label for="user-title">Deposit to:</label>
                                    <input class="form-control" type="text" id="dptTo" placeholder="Deposited to"
                                           name="deposited_to"
                                           value="{{$withdrawal->deposited_to}}">
                                </div>

                                <div class="form-group">
                                    <label for="user-title">Date:</label>
                                    <input type="text" class="form-control" id="depositDate" placeholder="Deposit Date"
                                           name="deposit_date"
                                           value="{{$withdrawal->deposit_date}}">
                                </div>


                                <div class="form-group">
                                    <label for="user-title">Deposit Slip Number:</label>
                                    <input type="text" class="form-control" placeholder="Slip Number"
                                           name="deposit_slip_number"
                                           value="{{$withdrawal->deposit_slip_number}}">
                                </div>


                                <div class="form-group">
                                    <label for="user-title">Attachment:</label>
                                    <input class="btn-upld" type="file" id="deposit_slip_attachment" name="attachment"
                                           style="visibility: hidden;">
                                    <span id="attachment_name"></span>

                                    <div class="btn btn-default" id="uploadFile">Browse</div>
                                </div>
                                @if(!empty($withdrawal->attachment_path))
                                    <div class="form-group">
                                        <label for="user-title">Previous Attachment</label>
                                        <a href="{{$withdrawal->attachment_path}}" target="_blank">
                                            <img src="{{$withdrawal->attachment_path}}" width="100">
                                        </a>
                                    </div>
                                @endif
                                <div class="form-group">
                                    <button type="button" class="btn btn-primary" id="submitPaymentFrom">Confirm</button>
                                    <button type="button" class="btn btn-default cancel" data-dismiss="modal">Close</button>
                                </div>
                            </form>
                    </form>

            </div>
        </div>

    </div>
</div>
{!! HTML::script('local/public/assets/admin/js/jquery-ui.js') !!}
<script>

    $(function(){
        $('#dptTo').datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: 'yy-mm-dd',
            yearRange: "-90:+0",
            maxDate: 0,
            inline: true,
            showOtherMonths: true,
            dayNamesMin: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat']

        });
    });
    $(function(){
        $('#depositDate').datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: 'yy-mm-dd',
            yearRange: "-90:+0",
            maxDate: 0,
            inline: true,
            showOtherMonths: true,
            dayNamesMin: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat']

        });
    });

    $('.cancel').click(function(e) {
        e.preventDefault();
        var url = '{{url('admin/withdrawalRequests')}}';
        window.location.href = url;
        return false;
    });
    $('.close').click(function(e) {
        e.preventDefault();
        var url = '{{url('admin/withdrawalRequests')}}';
        window.location.href = url;
        return false;
    });
</script>




















