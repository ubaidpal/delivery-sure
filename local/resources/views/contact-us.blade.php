{{--

    * Created by   :  Muhammad Yasir
    * Project Name : demedat
    * Product Name : PhpStorm
    * Date         : 16-Nov-16 4:36 PM
    * File Name    : 

--}}
@extends('layouts.default')
@section('content')
    @if(Auth::check())
        @include('includes.sidebar-right-menu')
    @endif
    <!-- Job Detail View -->
    <div class="job-detail-view autoheight">
        <div class="container">

            <header class="job-detail-header">
                <div class="jd-header-btn">
                    <div class="h2b pull-left nopadding">Contact Us</div>
                </div><!-- /.jd-header-btn -->
            </header><!-- /.job-detail-header -->
        @include('includes.alerts')
        <!-- Job Detail View - Body -->
            <div class="job-detail-view-body">
                <div class="col-md-12 list-group-item">
                    <div class="row">

                        {!! Form::open(['url' => 'contact-us', 'class'=> 'form-horizontal']) !!}
                        @if(!Auth::check())
                            <div class="form-group">
                                <label for="email" class="col-sm-2 control-label">E-mail</label>
                                <div class="col-sm-4">
                                    <input type="email" class="form-control" id="email" name="email" placeholder="E-mail Address"
                                           required
                                           autofocus>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">Name</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Name" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">Phone Number</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone Number" required>
                                </div>
                            </div>
                        @endif
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Message</label>
                            <div class="col-sm-6">
                                <textarea id="message" name="message" class="form-control" placeholder="Your Message" rows="5"
                                          required></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-6">
                                <button type="submit" class="btn btn-primary">Send Message</button>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div><!-- /.row -->
                </div><!-- /.col-md-8 -->


            </div><!-- /.job-detail-view-body -->
        </div><!-- /.job-detail -->
    </div><!-- /.job-detail -->

@endsection


