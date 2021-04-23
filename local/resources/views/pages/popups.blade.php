
@extends('layouts.home')

<!-- Sidebar right menue -->
@include('includes.sidebar-right-menu')

@section('content')

<!-- My Orders -->
<div class="my-jobs autoheight">
    <div class="container">
       <div class="popup-wrapper" style="margin-top:20px;">
       		<div class="instruction">Please place an order before sending an invitation</div>
            <a class="btn btn-green place" href="http://localhost/demedat/register">Place your order</a>
       </div>
       
       <div class="popup-wrapper" style="margin-top:50px;">
       		<div class="invited-person">
            	<div class="col-md-1"><img src="{!! asset('local/public/assets/images/dummy-profile.jpg') !!}" alt="image"></div>
                <div class="col-md-11">
                	<div class="row">
                    	<div class="invited-name">Invite Adam Lambart</div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
            	<div class="select-orders">
                	Select Orders to send an invite
                </div>
            </div>
            <div class="clearfix"></div>
             <div class="jobs-list-wrapper">
             	<div class="single-job">
                	<div class="col-md-12">
                    	<div class="check"><input type="checkbox" id="group1"></div>
                        <div class="tag-line"><label for="group1">I need my goods delivered as soon as possible...</label></div>
                    </div>
                </div>
                <div class="single-job">
                	<div class="col-md-12">
                    	<div class="check"><input type="checkbox" id="group1"></div>
                        <div class="tag-line"><label for="group1">I need my goods delivered as soon as possible...</label></div>
                    </div>
                </div>
                <div class="single-job">
                	<div class="col-md-12">
                    	<div class="check"><input type="checkbox" id="group1"></div>
                        <div class="tag-line"><label for="group1">I need my goods delivered as soon as possible...</label></div>
                    </div>
                </div>
                <div class="single-job">
                	<div class="col-md-12">
                    	<div class="check"><input type="checkbox" id="group1"></div>
                        <div class="tag-line"><label for="group1">I need my goods delivered as soon as possible...</label></div>
                    </div>
                </div>
                <div class="single-job">
                	<div class="col-md-12">
                    	<div class="check"><input type="checkbox" id="group1"></div>
                        <div class="tag-line"><label for="group1">I need my goods delivered as soon as possible...</label></div>
                    </div>
                </div>
                <div class="single-job">
                	<div class="col-md-12">
                    	<div class="check"><input type="checkbox" id="group1"></div>
                        <div class="tag-line"><label for="group1">I need my goods delivered as soon as possible...</label></div>
                    </div>
                </div>
                <div class="single-job">
                	<div class="col-md-12">
                    	<div class="check"><input type="checkbox" id="group1"></div>
                        <div class="tag-line"><label for="group1">I need my goods delivered as soon as possible...</label></div>
                    </div>
                </div>
                <div class="single-job">
                	<div class="col-md-12">
                    	<div class="check"><input type="checkbox" id="group1"></div>
                        <div class="tag-line"><label for="group1">I need my goods delivered as soon as possible...</label></div>
                    </div>
                </div>
                <div class="single-job">
                	<div class="col-md-12">
                    	<div class="check"><input type="checkbox" id="group1"></div>
                        <div class="tag-line"><label for="group1">I need my goods delivered as soon as possible...</label></div>
                    </div>
                </div>
                <div class="single-job">
                	<div class="col-md-12">
                    	<div class="check"><input type="checkbox" id="group1"></div>
                        <div class="tag-line"><label for="group1">I need my goods delivered as soon as possible...</label></div>
                    </div>
                </div>
                
             </div>
            <a class="btn btn-green place" href="http://localhost/demedat/register">Send an invitation</a>
       </div>
    </div><!-- /.container -->
</div><!-- My Orders -->

@endsection
