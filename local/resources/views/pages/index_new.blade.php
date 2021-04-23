@extends('layouts.landing')

@section('content')
<div class="slider-container">
     <div class="slider_container">
		<div class="flexslider">
	      <ul class="slides">
	    	<li>
	    		<img src="{!! asset('local/public/assets/images/slider/slide1.jpg') !!}" alt="" title=""/>
	    		<div class="featured-content">
                    <div class="featured-content-wrapper">
                        <h4 class="h1">Get a break, get it delivered!</h4>
                        <div class="landing-content">
                        	<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.<br/> Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, <br/>when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                        </div>
                        <div class="signup-buttons">
                        	<a class="btn btn-green white-blank" href="javascript:void(0);">LEARN MORE</a>
                            <a class="btn btn-green" href="javascript:void(0);">SIGN UP</a>
                        </div>
                    </div><!-- /.featured-content-wrapper -->
                </div>
	    	</li>
	    	<li>
	    		<img src="{!! asset('local/public/assets/images/slider/slide2.jpg') !!}" alt="" title=""/>
	    		<div class="featured-content">
                    <div class="featured-content-wrapper">
                        <h4 class="h1">Start delivering, earn cash</h4>
                        <div class="landing-content">
                        	<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.<br/> Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, <br/>when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                        </div>
                        <div class="signup-buttons">
                        	<a class="btn btn-green white-blank" href="javascript:void(0);">LEARN MORE</a>
                            <a class="btn btn-green" href="javascript:void(0);">SIGN UP</a>
                        </div>
                    </div><!-- /.featured-content-wrapper -->
                </div>
	    	</li>
            
            <li>
	    		<img src="{!! asset('local/public/assets/images/slider/slide3.jpg') !!}" alt="" title=""/>
	    		<div class="featured-content">
                    <div class="featured-content-wrapper">
                        <h4 class="h1">Impress your customers with</h4>
                        <h4 class="h1">on-demand delivery</h4>
                        <div class="landing-content">
                        	<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.<br/> Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, <br/>when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                        </div>
                        <div class="signup-buttons">
                        	<a class="btn btn-green white-blank" href="javascript:void(0);">LEARN MORE</a>
                            <a class="btn btn-green" href="javascript:void(0);">SIGN UP</a>
                        </div>
                    </div><!-- /.featured-content-wrapper -->
                </div>
	    	</li>
	    </ul>
	  </div>
   </div> 
</div>
@endsection
