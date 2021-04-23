<!-- Footer -->
<footer class="footer-container">
    <div class="container">
        <div class="row">
            <div class="footer-contact">
                <div class="col-md-4 col-xs-12">
                    <address class="lead col-md-12 col-sm-4 col-xs-4">PO Box CT16122 Collins Street West, Victoria 8007, UK.</address>

                    <ul class="nav-contact col-md-12 col-sm-4 col-xs-4">
                        <li><span class="glyphicon glyphicon-earphone"></span> +1 (2) 345 6789</li>
                        <li><span class="glyphicon glyphicon-earphone"></span> +1 (2) 345 6789</li>
                        <li><span class="glyphicon glyphicon-earphone"></span> contact@yourdomain.com</li>
                    </ul><!-- /.nav-contact -->

                    <ul class="nav-social col-md-12 col-sm-4 col-xs-4">
                        <li><a class="nav-social-item fb" href="javascript:void(0);"></a></li><!-- /.nav-social-item -->
                        <li><a class="nav-social-item tw" href="javascript:void(0);"></a></li><!-- /.nav-social-item -->
                        <li><a class="nav-social-item gp" href="javascript:void(0);"></a></li><!-- /.nav-social-item -->
                        <li><a class="nav-social-item li" href="javascript:void(0);"></a></li><!-- /.nav-social-item -->
                        <li><a class="nav-social-item pin" href="javascript:void(0);"></a></li><!-- /.nav-social-item -->
                    </ul><!-- /.nav-social -->
                </div><!-- /.col-md-4 -->

                <div class="col-md-8 col-xs-12">
                    <div class="news-letter">
                        <div class="h2">News Letter</div>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation.</p>

                        {!! Form::open(['route'=>['subscribe']]) !!}
                            <div class="form-group">
                                <input type="email" class="form-control" placeholder="Your Email..." name="email" required>
                                <button type="submit" class="btn btn-green">SUBSCRIBE</button>
                            </div><!-- /.form-group -->
                        {!! Form::close() !!}
                    </div><!-- /.news-letter -->
                </div><!-- /.col-md-8 -->
            </div><!-- /.footer-contact -->

            <div class="footer-main">
                <div class="col-md-6 col-xs-6">
                    <div class="footer-copyright">&copy; COPYRIGHT 2016. ALL RIGHTS RESERVED</div>
                </div><!-- /.col-md-6 -->
                <div class="col-md-6 col-xs-6">
                    <ol class="breadcrumb">
                        <li><a href="{{url('terms')}}">TERMS OF USE</a></li>
                        <li><a href="javascript:void(0);">PRIVACY AND SECURITY</a></li>
                        <li><a href="{{url('privacy-policy')}}">POLICY</a></li>
                        <li><a href="javascript:void(0);">SITEMAP</a></li>
                    </ol>
                </div><!-- /.col-md-6 -->
            </div><!-- /.footer-main -->
        </div><!-- /.row -->
    </div><!-- /.container -->
</footer><!-- /.d-footer -->
