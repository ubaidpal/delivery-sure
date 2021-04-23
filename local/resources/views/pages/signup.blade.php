@extends('layouts.signup')

@section('content')

<div class="signup-wrapper">
	<div class="signup-box">
    	<h1>Sign up</h1>
        <div class="signup-form">
        	<div class="form-group">
                <label class="animate-label">Email <span>*</span></label>
                <input type="email" class="form-control form-control-animate-border">
            </div>
            <div class="form-group">
                <label class="animate-label">Password <span>*</span></label>
                <input type="password" class="form-control form-control-animate-border">
            </div>
            <div class="form-group">
                <label class="animate-label">Retype Password <span>*</span></label>
                <input type="password" class="form-control form-control-animate-border">
            </div>
            <div class="form-group">
                <label class="animate-label">First name <span>*</span></label>
                <input type="text" class="form-control form-control-animate-border">
            </div>
            <div class="form-group">
                <label class="animate-label">Last name <span>*</span></label>
                <input type="text" class="form-control form-control-animate-border">
            </div>
            <div class="form-group">
                <label class="animate-label">Phone number <span>*</span></label>
                <input type="tel" class="form-control form-control-animate-border">
            </div>
            <div class="form-group">
                <label class="animate-label">What are you looking for? <span>&ast;</span></label>
                <select class="form-control form-control-animate-border">
                    <option></option>
                    <option>job</option>
                </select>
            </div>
            
        </div>
        <!-- /.add-bank-account /.list-group /.col-md-9 -->
        
        <button type="button" class="btn-green btn">start registration</button>
        <p>By signing up you agree to our <a href="#">Terms of Service</a> and <a href="#">Privacy Policy</a>.</p>
    </div>
</div>

@endsection