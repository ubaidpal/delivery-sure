
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Place An Order</title>

    <!-- Bootstrap -->
    <link href="assets/stylesheets/bootstrap.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>

<!--Sidebar Right Container-->
<div class="sidebar-right-container">
    <!-- SideBar Trigger Button -->
    <button type="button" class="c-hamburger c-hamburger--htla" data-toggle="modal" data-target="#sidebar-right">
        <span>Right Sidebar Modal</span>
    </button>

    <!-- SideBar - Modal -->
    <div class="modal right fade" id="sidebar-right" tabindex="-1" role="dialog" aria-labelledby="siderbarLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="sidebar-modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h1 class="sidebar-modal-title" id="siderbarLabel">
                        <img src="assets/images/logo-sidebar.png" alt="image">
                    </h1><!-- /.modal-title -->
                </div><!-- /.modal-header -->

                <div class="modal-body">
                    <ul class="sidebar-menu">
                        <li class="sidebar-menu-item"><a href="profile-setting.html">Profile Settings</a></li>
                        <li class="sidebar-menu-item"><a href="my-jobs.html">My Jobs</a></li>
                        <li class="sidebar-menu-item"><a href="notifications.html">Notification</a></li>
                        <li class="sidebar-menu-item"><a href="javascript:void(0);">Change Password</a></li>
                        <li class="sidebar-menu-item"><a href="javascript:void(0);">Logout</a></li>
                    </ul>
                </div><!-- /.modal-body -->
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</div><!-- sidebar-right-container -->

<!-- Header -->
<header>
    <nav class="navbar navbar-default">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="javascript:void(0);"><img src="assets/images/logo.png" alt="image"></a>
            </div><!-- /.navbar-header -->

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li><a href="javascript:void(0);">EARN CASH</a></li>
                    <li><a href="javascript:void(0);">SHOPPERS</a></li>
                    <li><a href="my-jobs.html">MY JOBS</a></li>
                    <li><a href="my-orders.html">MY ORDERS</a></li>
                    <li><a href="message-center.html">MESSAGES</a></li>
                </ul><!-- /.navbar-nav -->

                <a class="btn btn-white navbar-btn hidden-sm hidden-xs" href="my-orders.html">Place An Order</a><!-- /.hidden-xs -->

                <a class="profile-icon hidden-xs" href="profile-setting.html">
                    <div class="profile-name hidden-md hidden-sm">Hi, <span>John Doe</span></div>
                    <div class="profile-img"><img src="assets/images/profile-img.jpg" alt="img"></div>
                </a><!-- /.profile-icon -->
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container -->
    </nav><!-- /.navbar-default -->
</header>

<!-- Place An Order -->
<div class="place-an-order autoheight">
    <div class="container">
        <div class="col-xs-12">
            <div class="h2b">Place an order</div>
        </div><!-- /.col-xs-12 -->

        <div class="row">
            <div class="place-an-order-group col-md-9">
                <ul class=" list-group">
                    <li class="list-group-item">
                        <div class="h3b">Your Order Information</div>
                        <form action="">
                            <div class="form-group">
                                <label class="animate-label">Enter your order title</label>
                                <input type="text" class="form-control form-control-animate-border">
                            </div><!-- /.form-group animate-label -->
                            <div class="form-group">
                                <label class="animate-label">What driver needs to know?</label>
                                <input type="text" class="form-control form-control-animate-border">
                            </div><!-- /.form-group animate-label -->

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="animate-label">Estimated delivery fees</label>
                                        <select class="form-control form-control-animate-border">
                                            <option></option>
                                            <option>1</option>
                                        </select>
                                    </div><!-- /.form-group -->
                                    <div class="form-group dollar">
                                        <label class="animate-label">Estimated delivery fees</label>
                                        <input type="text" class="form-control form-control-animate-border">
                                    </div><!-- /.form-group animate-label -->
                                </div>
                            </div><!-- /.row -->
                        </form>
                    </li><!-- /.list-group-item -->

                    <li class="list-group-item">
                        <div class="h3b">Delivery location and time</div>

                        <div class="form-group">
                            <label class="animate-label">Where you want your items to be delivered?</label>
                            <input type="text" class="form-control form-control-animate-border">
                            <button type="button" class="btn toltip" data-toggle="tooltip" data-placement="top" title="Tooltip on bottom"></button>
                        </div><!-- /.form-group animate-label -->

                        <p>Place the pin using the address above</p>
                        <img src="assets/images/place-an-order.jpg" alt="image">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="animate-label">Esitimated delivery fees</label>
                                    <select class="form-control form-control-animate-border">
                                        <option></option>
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                        <option>5</option>
                                    </select>
                                </div><!-- /.form-group -->
                            </div><!-- /.col-md-4 -->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="animate-label">Esitimated delivery fees</label>
                                    <select class="form-control form-control-animate-border">
                                        <option></option>
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                        <option>5</option>
                                    </select>
                                </div><!-- /.form-group -->
                            </div><!-- /.col-md-4 -->
                        </div><!-- /.row -->

                        <div class="checkbox">
                            <label>
                                <input type="checkbox">Add a pick up point
                            </label>
                        </div><!-- /.checkbox -->

                    </li><!-- /.list-group-item -->
                </ul><!-- /.place-an-order-group .list-group -->


            </div><!-- /.col-md-9 -->

            <div class="list-group-green-header col-md-3 col-xs-6">
                <ul class=" list-group">
                    <li class="list-group-item active">Your Order Information</li><!-- /.list-group-item -->

                    <li class="list-group-item">List Item</li><!-- /.list-group-item -->

                    <li class="list-group-item">Delivery information</li><!-- /.list-group-item -->

                    <li class="list-group-item">
                        <p class="small">You will Pay</p>
                        <div class="h3">$ 0.00</div>
                    </li><!-- /.list-group-item -->

                </ul><!-- /.list-group-green-header -->

                <a class="btn btn-green btn-block" href="my-orders.html">PLACE YOUR ORDER</a>
            </div><!-- /.list-group-green-header -->
        </div><!-- /.row -->
    </div><!-- /.container -->
</div><!-- /.place-an -->




<!-- Footer DashBoard -->
<footer class="footer-dashboard">
    <div class="container">
        <div class="col-xs-6">
            <div class="rights-reserved">DeliverySure - All rights reserved</div>
        </div><!-- /.col-sm-6 -->

        <div class="col-xs-6">
            <ol class="breadcrumb">
                <li><a href="javascript:void(0);">TERMS</a></li>
                <li><a href="javascript:void(0);">FAQ</a></li>
                <li><a href="javascript:void(0);">HELP</a></li>
                <li><a href="javascript:void(0);">CONTACT</a></li>
            </ol>
        </div><!-- /.col-sm-6 -->
    </div><!-- /.container -->
</footer><!-- /.dashboard-footer -->











<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>-->
<script src="assets/javascripts/jquery-1-11-3.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="assets/javascripts/bootstrap.min.js"></script>
<script src="assets/javascripts/custom.js"></script>

</body>
</html>













