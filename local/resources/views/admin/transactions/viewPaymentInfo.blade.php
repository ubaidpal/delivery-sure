<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="user-title">Deposit to:</label>
                        <input class="form-control" type="text" disabled value="{{$withdrawal->deposited_to}}">
                </div>

                <div class="form-group">
                    <label for="user-title">Date:</label>
                        <input type="text" class="form-control" disabled value="{{$withdrawal->deposit_date}}">
                </div>

                <div class="form-group">
                    <label for="user-title">Deposit Slip Number:</label>
                        <input type="text" class="form-control" disabled value="{{$withdrawal->deposit_slip_number}}">
                </div>

                @if(!empty($withdrawal->attachment_path))
                    <div class="form-group">
                        <label for="user-title">Attachment</label>
                            <a href="{{$withdrawal->attachment_path}}" target="_blank">
                                <img src="{{$withdrawal->attachment_path}}" width="100">
                            </a>
                    </div>
                @endif

            </div>
        </div>

    </div>
</div>





