
@extends('layouts.default')

<!-- Sidebar right menue -->
@include('includes.sidebar-right-menu')

@section('content')

<!-- Message Center -->
<div class="message-center autoheight">
    <div class="container">
        <div class="row">

            <!-- Message Left Menu -->
            <div class="message-left-menu col-md-4">
                <ul class="list-group">
                    <li class="list-group-item">
                        <div class="message-thread-heading h3b">Message Centre</div>
                    </li><!-- /.list-group-item -->

                    <li class="list-group-item">
                        <div class="form-group">
                            <div class="input-group">
                                <input type="text" class="form-control search-input" placeholder="Type Keyword Here...">
                                <div class="input-group-btn">
                                    <button class="btn btn-default search-icon" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                                </div>
                            </div><!-- /.input-group -->
                        </div>
                    </li><!-- /.list-group-item -->

                    <li class="list-group-item message-thread-container">
                        <ul class="message-thread-group">
                            <li class="message-thread-item unread">
                                <div class="message-thread-close"><span>&times;</span></div>
                                <div class="message-thread-img">
                                    <img src="{!! asset('local/public/assets/images/dummy-profile.jpg') !!}" alt="image">
                                </div><!-- /.message-thread-item -->
                                <div class="message-thread-txt">
                                    <div class="message-thread-name">Fikri Ruslandi</div>
                                    <div class="message-thread-info">
                                        <div class="message-thread-shown">
                                            <span>Ko, Kumaha Project anu eta asdfsadfasd sdfasdf asdf sdf as asfd asdf sdfasdf sf assdf fsdf sdf</span>
                                        </div>
                                        <div class="message-thread-time">
                                            <span>1 min ago</span>
                                        </div>
                                    </div><!-- /.message-thread-info -->
                                </div><!-- /.message-thread-txt -->
                            </li><!-- /.message-threads-item -->

                            <li class="message-thread-item unread">
                                <div class="message-thread-close"><span>&times;</span></div>
                                <div class="message-thread-img">
                                    <img src="{!! asset('local/public/assets/images/dummy-profile.jpg') !!}" alt="image">
                                </div><!-- /.message-thread-item -->
                                <div class="message-thread-txt">
                                    <div class="message-thread-name">Fikri Ruslandi</div>
                                    <div class="message-thread-info">
                                        <div class="message-thread-shown">
                                            <span>Ko, Kumaha Project anu eta asdfsadfasd sdfasdf asdf sdf as asfd asdf sdfasdf sf assdf fsdf sdf</span>
                                        </div>
                                        <div class="message-thread-time">
                                            <span>1 min ago</span>
                                        </div>
                                    </div><!-- /.message-thread-info -->
                                </div><!-- /.message-thread-txt -->
                            </li><!-- /.message-threads-item -->

                            <li class="message-thread-item">
                                <div class="message-thread-close"><span>&times;</span></div>
                                <div class="message-thread-img">
                                    <img src="{!! asset('local/public/assets/images/dummy-profile.jpg') !!}" alt="image">
                                </div><!-- /.message-thread-item -->
                                <div class="message-thread-txt">
                                    <div class="message-thread-name">Fikri Ruslandi</div>
                                    <div class="message-thread-info">
                                        <div class="message-thread-shown">
                                            <span>Ko, Kumaha Project anu eta asdfsadfasd sdfasdf asdf sdf as asfd asdf sdfasdf sf assdf fsdf sdf</span>
                                        </div>
                                        <div class="message-thread-time">
                                            <span>1 min ago</span>
                                        </div>
                                    </div><!-- /.message-thread-info -->
                                </div><!-- /.message-thread-txt -->
                            </li><!-- /.message-threads-item -->

                            <li class="message-thread-item">
                                <div class="message-thread-close"><span>&times;</span></div>
                                <div class="message-thread-img">
                                    <img src="{!! asset('local/public/assets/images/dummy-profile.jpg') !!}" alt="image">
                                </div><!-- /.message-thread-item -->
                                <div class="message-thread-txt">
                                    <div class="message-thread-name">Fikri Ruslandi</div>
                                    <div class="message-thread-info">
                                        <div class="message-thread-shown">
                                            <span>Ko, Kumaha Project anu eta asdfsadfasd sdfasdf asdf sdf as asfd asdf sdfasdf sf assdf fsdf sdf</span>
                                        </div>
                                        <div class="message-thread-time">
                                            <span>1 min ago</span>
                                        </div>
                                    </div><!-- /.message-thread-info -->
                                </div><!-- /.message-thread-txt -->
                            </li><!-- /.message-threads-item -->

                            <li class="message-thread-item">
                                <div class="message-thread-close"><span>&times;</span></div>
                                <div class="message-thread-img">
                                    <img src="{!! asset('local/public/assets/images/dummy-profile.jpg') !!}" alt="image">
                                </div><!-- /.message-thread-item -->
                                <div class="message-thread-txt">
                                    <div class="message-thread-name">Fikri Ruslandi</div>
                                    <div class="message-thread-info">
                                        <div class="message-thread-shown">
                                            <span>Ko, Kumaha Project anu eta asdfsadfasd sdfasdf asdf sdf as asfd asdf sdfasdf sf assdf fsdf sdf</span>
                                        </div>
                                        <div class="message-thread-time">
                                            <span>1 min ago</span>
                                        </div>
                                    </div><!-- /.message-thread-info -->
                                </div><!-- /.message-thread-txt -->
                            </li><!-- /.message-threads-item -->

                            <li class="message-thread-item">
                                <div class="message-thread-close"><span>&times;</span></div>
                                <div class="message-thread-img">
                                    <img src="{!! asset('local/public/assets/images/dummy-profile.jpg') !!}" alt="image">
                                </div><!-- /.message-thread-item -->
                                <div class="message-thread-txt">
                                    <div class="message-thread-name">Fikri Ruslandi</div>
                                    <div class="message-thread-info">
                                        <div class="message-thread-shown">
                                            <span>Ko, Kumaha Project anu eta asdfsadfasd sdfasdf asdf sdf as asfd asdf sdfasdf sf assdf fsdf sdf</span>
                                        </div>
                                        <div class="message-thread-time">
                                            <span>1 min ago</span>
                                        </div>
                                    </div><!-- /.message-thread-info -->
                                </div><!-- /.message-thread-txt -->
                            </li><!-- /.message-threads-item -->

                        </ul><!-- /.message-threads-group -->
                    </li><!-- /.list-group-item -->
                </ul><!-- /.list-group -->
            </div><!-- /.dashboard-left-main .col-md-4 -->


            <!-- Message Thread Content -->
            <div class="col-md-8">
                <ul class="message-thread-content">
                    <li class="list-group-item">
                        <div class="message-thread-content-header">
                            <div class="message-thread-heading h3b">Abu Abdullah Nugraha</div>
                            <a class="btn btn-link" href="javascript:void(0);">Go to Job Application</a>
                        </div><!-- /.message-thread-content-header -->
                    </li><!-- /.list-group-item -->

                    <li class="list-group-item">
                        <div>
                            <div>
                                <!-- Web Messenger -->
                                <ul class="web-messenger messengerheight">
                                    <!-- Messenger Msg - Left -->
                                    <li class="messenger-msg-left">
                                        <div class="row">
                                            <div class="col-sm-7">
                                                <div class="message-thread-img">
                                                    <img src="{!! asset('local/public/assets/images/dummy-profile.jpg') !!}" alt="image">
                                                </div><!-- /.message-thread-img -->

                                                <div class="messenger-msg-content">
                                                    <div class="messenger-msg-txt">Nanti  kita technical meeting lomba jogja Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nobis, possimus?</div><!-- /.messenger-msg-txt -->

                                                    <ul class="messenger-msg-time">
                                                        <li>Apr 19</li>
                                                        <li>05:54 pm</li>
                                                    </ul><!-- /.messenger-msg-time -->
                                                </div><!-- /.messenger-msg-content -->
                                            </div><!-- /.col-sm-7 -->
                                        </div><!-- /.row -->
                                    </li><!-- /.messenger-msg-left -->

                                    <!-- Messenger Msg - Right -->
                                    <li class="messenger-msg-right">
                                        <div class="row">
                                            <div class="col-sm-7 col-sm-offset-5">
                                                <div class="message-thread-img">
                                                    <img src="{!! asset('local/public/assets/images/dummy-profile.jpg') !!}" alt="image">
                                                </div><!-- /.message-thread-img -->

                                                <div class="messenger-msg-content">
                                                    <div class="messenger-msg-txt">Nanti  kita technical meeting lomba jogja Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nobis, possimus?</div><!-- /.messenger-msg-txt -->

                                                    <ul class="messenger-msg-time">
                                                        <li>Apr 19</li>
                                                        <li>05:54 pm</li>
                                                    </ul><!-- /.messenger-msg-time -->
                                                </div><!-- /.messenger-msg-content -->
                                            </div><!-- /.col-sm-7 -->
                                        </div><!-- /.row -->
                                    </li><!-- /.messenger-msg-right -->

                                    <!-- Messenger Msg - Left -->
                                    <li class="messenger-msg-left">
                                        <div class="row">
                                            <div class="col-sm-7">
                                                <div class="message-thread-img">
                                                    <img src="{!! asset('local/public/assets/images/dummy-profile.jpg') !!}" alt="image">
                                                </div><!-- /.message-thread-img -->

                                                <div class="messenger-msg-content">
                                                    <div class="messenger-msg-txt">Nanti  kita technical meeting lomba jogja Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nobis, possimus?</div><!-- /.messenger-msg-txt -->

                                                    <ul class="messenger-msg-time">
                                                        <li>Apr 19</li>
                                                        <li>05:54 pm</li>
                                                    </ul><!-- /.messenger-msg-time -->
                                                </div><!-- /.messenger-msg-content -->
                                            </div><!-- /.col-sm-7 -->
                                        </div><!-- /.row -->
                                    </li><!-- /.messenger-msg-left -->

                                    <!-- Messenger Msg - Right -->
                                    <li class="messenger-msg-right">
                                        <div class="row">
                                            <div class="col-sm-7 col-sm-offset-5">
                                                <div class="message-thread-img">
                                                    <img src="{!! asset('local/public/assets/images/dummy-profile.jpg') !!}" alt="image">
                                                </div><!-- /.message-thread-img -->

                                                <div class="messenger-msg-content">
                                                    <div class="messenger-msg-txt">Nanti  kita technical meeting lomba jogja Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nobis, possimus?</div><!-- /.messenger-msg-txt -->

                                                    <ul class="messenger-msg-time">
                                                        <li>Apr 19</li>
                                                        <li>05:54 pm</li>
                                                    </ul><!-- /.messenger-msg-time -->
                                                </div><!-- /.messenger-msg-content -->
                                            </div><!-- /.col-sm-7 -->
                                        </div><!-- /.row -->
                                    </li><!-- /.messenger-msg-right -->

                                </ul><!-- /.web-messenger -->
                            </div>
                        </div>

                    </li><!-- /.list-group-item -->

                    <li class="list-group-item">
                        <div class="messenger-type-msg">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Type your message ...">
                                <a class="btn btn-attachment" href="javascript:void(0);"></a>
                                <a class="btn send-msg" href="javascript:void(0);"><span class="glyphicon glyphicon-send"></span></a>
                            </div>

                        </div>
                    </li><!-- /.list-group-item -->
                </ul><!-- /.message-thread-content -->




            </div><!-- /.dashboard-content -->
        </div><!-- /.row -->
    </div><!-- /.container -->
</div><!-- /.Message Center -->

@endsection

