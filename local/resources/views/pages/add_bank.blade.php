@extends('layouts.default')

<!-- Sidebar right menue -->
@include('includes.sidebar-right-menu')


@section('content')

<div class="col-xs-12">
    <div class="h2b">Add Bank Account</div>
</div><!-- /.col-xs-12 -->

@include('includes.sidebar-left-menu')	        
		
<div class="add-bank-account list-group col-md-9 col-xs-12">
    <li class="list-group-item">
        <div class="h3b">Add Bank Account</div>

        <div class="form-group">
            <label class="animate-label">Full Name <span>&ast;</span></label>
            <input type="text" class="form-control form-control-animate-border">
        </div><!-- /.form-group animate-label -->

        <div class="form-group">
            <label class="animate-label">Billing Address Line 1 <span>&ast;</span></label>
            <input type="text" class="form-control form-control-animate-border">
        </div><!-- /.form-group animate-label -->

        <div class="form-group">
            <label class="animate-label">Billing Address Line 2 <span>&ast;</span></label>
            <input type="text" class="form-control form-control-animate-border">
        </div><!-- /.form-group animate-label -->

        <div class="form-group">
            <label class="animate-label">Billing Address Line 3 <span>&ast;</span></label>
            <input type="text" class="form-control form-control-animate-border">
        </div><!-- /.form-group animate-label -->

        <div class="form-group">
            <label class="animate-label">City <span>&ast;</span></label>
            <input type="text" class="form-control form-control-animate-border">
        </div><!-- /.form-group animate-label -->

        <div class="form-group">
            <label class="animate-label">State <span>&ast;</span></label>
            <input type="text" class="form-control form-control-animate-border">
        </div><!-- /.form-group animate-label -->

        <div class="form-group">
            <label class="animate-label">Passcode <span>&ast;</span></label>
            <input type="text" class="form-control form-control-animate-border">
        </div><!-- /.form-group animate-label -->

        <div class="form-group">
            <label class="animate-label">Country <span>&ast;</span></label>
            <select class="form-control form-control-animate-border">
                <option></option>
                <option>1</option>
            </select>
        </div><!-- /.form-group -->

        <div class="form-group">
            <label class="animate-label">Account Holder’s Name <span>&ast;</span></label>
            <input type="text" class="form-control form-control-animate-border">
        </div><!-- /.form-group animate-label -->

        <div class="form-group">
            <label class="animate-label">IBAN Number <span>&ast;</span></label>
            <input type="text" class="form-control form-control-animate-border">
        </div><!-- /.form-group animate-label -->

        <div class="form-group">
            <label class="animate-label">SWIFT Code <span>&ast;</span></label>
            <input type="text" class="form-control form-control-animate-border">
        </div><!-- /.form-group animate-label -->

        <div class="form-group">
            <label class="animate-label">Full Bank Name <span>&ast;</span></label>
            <input type="text" class="form-control form-control-animate-border">
        </div><!-- /.form-group animate-label -->

        <div class="form-group">
            <label class="animate-label">Bank Branch City <span>&ast;</span></label>
            <input type="text" class="form-control form-control-animate-border">
        </div><!-- /.form-group animate-label -->

        <div class="form-group">
            <label class="animate-label">Bank Branch Country <span>&ast;</span></label>
            <select class="form-control form-control-animate-border">
                <option></option>
                <option>1</option>
            </select>
        </div><!-- /.form-group -->

        <div class="btn-container">
            <a class="btn btn-green" href="javascript:void(0);">Save</a>
            <a class="btn btn-gray" href="javascript:void(0);">Cancel</a>
        </div>
    </li><!-- /.list-group-item -->
</div><!-- /.add-bank-account /.list-group /.col-md-9 -->
@endsection
