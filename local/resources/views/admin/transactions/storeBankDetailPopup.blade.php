
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="user-title">Bank Account Holder's Name:</label>
                    <input class="form-control" type="text" disabled value="{{$bank->account_title}}">
                </div>

                <div class="form-group">
                    <label for="user-title">Swift Code:</label>
                    <input type="text" class="form-control" disabled value="{{$bank->swift_code}}">
                </div>

                <div class="form-group">
                    <label for="user-title">Bank Account Number:</label>
                    <input type="text" class="form-control" disabled value="{{$bank->account_number}}">
                </div>
                <div class="form-group">
                    <label for="user-title">Bank Account IBAN:</label>
                    <input type="text" class="form-control" disabled value="{{$bank->iban_number}}">
                </div>
                <div class="form-group">
                    <label for="user-title">Bank Name in Full:</label>
                    <input type="text" class="form-control" disabled value="{{$bank->bank_name}}">
                </div>

                <div class="form-group">
                    <label for="user-title">Bank Branch City:</label>
                    <input type="text" class="form-control" disabled value="{{$bank->bank_branch_city}}">
                </div>

                <div class="form-group">
                    <label for="user-title">Bank Branch Country:</label>
                    <input type="text" class="form-control" disabled value="{{$bank->bank_branch_country_code}}">
                </div>

            </div>
        </div>

    </div>
</div>
