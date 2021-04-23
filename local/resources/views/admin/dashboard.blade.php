@extends('admin.layout.default')

@section('styles')
    {!! HTML::style('local/public/assets/admin/css/plugins/morris.css') !!}

    <!-- Custom Fonts -->

    {!! HTML::style('local/public/assets/admin/font-awesome/css/font-awesome.min.css') !!}
@stop

@section('content')

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Dashboard
                        <small></small>
                    </h1>
                    <ol class="breadcrumb">
                        <li class="active">
                            <i class="fa fa-dashboard"></i> Dashboard
                        </li>
                    </ol>
                </div>
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-money fa-5x"></i>
                                </div>
                                <div class="col-xs-4 text-left">
                                    <div class="huge">{{format_currency($monthly_revenue)}}</div>
                                    <div>Monthly</div>
                                </div>
                                <div class="col-xs-5 text-right">
                                    <div class="huge">{{format_currency($yearly_revenue)}}</div>
                                    <div>Yearly</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">View Revenue</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-jamni">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-dollar fa-5x"></i>
                                </div>
                                <div class="col-xs-4 text-left">
                                    <div class="huge">{{format_currency($daily_profit)}}</div>
                                    <div>Daily</div>
                                </div>
                                <div class="col-xs-5 text-right">
                                    <div class="huge">{{format_currency($monthly_profit)}}</div>
                                    <div>Monthly</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">View Earning</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-credit-card fa-5x"></i>
                                </div>
                                <div class="col-xs-4 text-left">
                                    <div class="huge">{{format_currency($daily_spent_purchaser)}}</div>
                                    <div>Daily</div>
                                </div>
                                <div class="col-xs-5 text-right">
                                    <div class="huge">{{format_currency($monthly_spent_purchaser)}}</div>
                                    <div>Monthly</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">View Purchasers Spent</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-credit-card fa-5x"></i>
                                </div>
                                <div class="col-xs-4 text-left">
                                    <div class="huge">{{format_currency($daily_spent_retailer)}}</div>
                                    <div>Daily</div>
                                </div>
                                <div class="col-xs-5 text-right">
                                    <div class="huge">{{format_currency($monthly_spent_retailer)}}</div>
                                    <div>Monthly</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">View Retailers Spent</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-dollar fa-5x"></i>
                                </div>
                                <div class="col-xs-4 text-left">
                                    <div class="huge">{{format_currency($daily_driver_earning)}}</div>
                                    <div>Daily</div>
                                </div>
                                <div class="col-xs-5 text-right">
                                    <div class="huge">{{format_currency($monthly_driver_earning)}}</div>
                                    <div>Monthly</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">View Drivers Earning</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-gray">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-dollar fa-5x"></i>
                                </div>
                                <div class="col-xs-4 text-left">
                                    <div class="huge">12</div>
                                    <div>Daily</div>
                                </div>
                                <div class="col-xs-5 text-right">
                                    <div class="huge">12</div>
                                    <div>Monthly</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">View Taxs</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-support fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">13</div>
                                    <div>Support Tickets!</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <!-- /.row -->

            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading col-md-12">
                            <div class="panel-title col-md-6">
                                <i class="fa fa-bar-chart-o fa-fw"></i> Area Chart
                            </div>
                            <div class="col-md-6 pull-right">
                                <div id="reportrange" class="pull-right"
                                     style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc">
                                    <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                                    <span>December 30, 2014 - January 28, 2015</span> <b class="caret"></b>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="panel-body">
                            {{--<div id="morris-area-chart"></div>--}}
                            <div id="chartContainer" style="height: 400px; ">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->

            <div class="row">

                <div class="col-lg-8">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="fa fa-clock-o fa-fw"></i> Recent Activities</h3>
                        </div>

                        <div class="panel-body">
                            <div class="list-group">
                                <a href="#" class="list-group-item">
                                    <span class="badge">just now</span>
                                    <i class="fa fa-fw fa-calendar"></i> Calendar updated
                                </a>
                                <a href="#" class="list-group-item">
                                    <span class="badge">4 minutes ago</span>
                                    <i class="fa fa-fw fa-comment"></i> Commented on a post
                                </a>
                                <a href="#" class="list-group-item">
                                    <span class="badge">23 minutes ago</span>
                                    <i class="fa fa-fw fa-truck"></i> Order 392 shipped
                                </a>
                                <a href="#" class="list-group-item">
                                    <span class="badge">46 minutes ago</span>
                                    <i class="fa fa-fw fa-money"></i> Invoice 653 has been paid
                                </a>
                                <a href="#" class="list-group-item">
                                    <span class="badge">1 hour ago</span>
                                    <i class="fa fa-fw fa-user"></i> A new user has been added
                                </a>
                                <a href="#" class="list-group-item">
                                    <span class="badge">2 hours ago</span>
                                    <i class="fa fa-fw fa-check"></i> Completed task: "pick up dry cleaning"
                                </a>
                                <a href="#" class="list-group-item">
                                    <span class="badge">yesterday</span>
                                    <i class="fa fa-fw fa-globe"></i> Saved the world
                                </a>
                                <a href="#" class="list-group-item">
                                    <span class="badge">two days ago</span>
                                    <i class="fa fa-fw fa-check"></i> Completed task: "fix error on sales page"
                                </a>
                            </div>
                            <div class="text-right">
                                <a href="#">View All Activity <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="fa fa-users fa-fw"></i>New Users</h3>
                        </div>
                        <div class="panel-body">
                            <div class="list-group">
                                @foreach($latest_users as $user)
                                    <a href="#" class="list-group-item">

                                        <span class="badge"></span>
                                        <i class="fa fa-fw fa-user fa-2x"></i>
                                        {{$user->display_name}}
                                        <div class="clearfix"></div>
                                        {{\Carbon\Carbon::parse($user->created_at)->diffForHumans()}}
                                    </a>
                                @endforeach

                            </div>
                            <div class="text-right">
                                <a href="#">View All Activity <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

@stop
@section('scripts')

    {!! HTML::script('local/public/assets/admin/js/plugins/morris/raphael.min.js') !!}
    {!! HTML::script('local/public/assets/admin/js/plugins/morris/morris.min.js') !!}
    {{-- {!! HTML::script('local/public/assets/admin/js/plugins/morris/morris-data.js') !!}--}}
    {!! HTML::script('local/public/assets/admin/js/plugins/canvasJS/canvasjs.min.js') !!}
    {!! HTML::script('local/public/assets/js/moment.min.js') !!}
    {!! HTML::script('local/public/assets/js/daterangepicker.js') !!}
    <script>
        var usersChart;
        window.onload = function () {
           usersChart = new CanvasJS.Chart("chartContainer", {
                title: {
                    text: "Users Registration",
                    //margin: 15
                },
                toolTip: {
                    shared: true
                },
                axisX: {
                    valueFormatString: "DD MMM",
                    interval: 1,
                    //intervalType: "month"
                },
                axisY: {
                    //maximum: 15,
                    interval: 1
                },

                legend: {
                    verticalAlign: "top",
                    horizontalAlign: "center"
                },
                data: [
                    {
                        type: "splineArea",
                        name: "Purchaser",
                        showInLegend: "true",
                        color: '#77C720',
                        dataPoints: <?php echo $purchaser?>
                    },
                    {
                        type: "splineArea",
                        name: "Retailer",
                        showInLegend: "true",
                        color: "#00ADFF",
                        dataPoints:<?php echo $retailer?>
                    },
                    {
                        type: "splineArea",
                        name: "Driver",
                        showInLegend: "true",
                        color: "#FF6E00",
                        dataPoints:<?php echo $driver?>
                    }

                ]
            });

            usersChart.render();
        }

        function renderChart(data) {
            usersChart.options.data[0].dataPoints = data.purchaser;
            usersChart.options.data[1].dataPoints = data.retailer;
            usersChart.options.data[2].dataPoints = data.driver;
            usersChart.render();
        }
        function getDateWiseData(endDate, startDate) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-Token': "{{csrf_token()}}"
                }
            });

            $.ajax({
                type:"POST",
                url:"{{url('admin/dashboard/get-date-data')}}",
                data:{start_date:startDate, end_date:endDate},
                success:function(data){
                    renderChart(data);
                }
            })
        }
        $(document).ready(function () {

            var cb = function (start, end, label) {
                console.log(start.toISOString(), end.toISOString(), label);
                $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
                //alert("Callback has fired: [" + start.format('MMMM D, YYYY') + " to " + end.format('MMMM D, YYYY') + ", label = " + label + "]");
            };

            var optionSet1 = {
                startDate: moment().subtract(29, 'days'),
                endDate: moment(),
                //minDate: '01/01/2012',
                maxDate: moment(),
                /*dateLimit: {
                 days: 60
                 },*/
                showDropdowns: true,
                showWeekNumbers: true,
                timePicker: false,
                timePickerIncrement: 1,
                timePicker12Hour: true,
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                },
                opens: 'left',
                buttonClasses: ['btn btn-default'],
                applyClass: 'btn-small btn-primary',
                cancelClass: 'btn-small',
                format: 'MM/DD/YYYY',
                separator: ' to ',
                locale: {
                    applyLabel: 'Submit',
                    cancelLabel: 'Clear',
                    fromLabel: 'From',
                    toLabel: 'To',
                    customRangeLabel: 'Custom',
                    daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
                    monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                    firstDay: 1
                }
            };
            $('#reportrange span').html(moment().subtract(29, 'days').format('MMMM D, YYYY') + ' - ' + moment().format('MMMM D, YYYY'));
            $('#reportrange').daterangepicker(optionSet1, cb);
            $('#reportrange').on('show.daterangepicker', function () {
                console.log("show event fired");
            });
            $('#reportrange').on('hide.daterangepicker', function () {
                console.log("hide event fired");
            });
            $('#reportrange').on('apply.daterangepicker', function (ev, picker) {
                console.log("apply event fired, start/end dates are " + picker.startDate.format('MMMM D, YYYY') + " to " + picker.endDate.format('DD MMM, YYYY'));
                var endDate = picker.endDate.format('MMMM D, YYYY');
                var startDate = picker.startDate.format('MMMM D, YYYY');
                getDateWiseData(endDate, startDate);
            });
            $('#reportrange').on('cancel.daterangepicker', function (ev, picker) {
                console.log("cancel event fired");
            });
            $('#options1').click(function () {
                // $('#reportrange').data('daterangepicker').setOptions(optionSet1, cb);
            });
            $('#options2').click(function () {
                // $('#reportrange').data('daterangepicker').setOptions(optionSet2, cb);
            });
            $('#destroy').click(function () {
                $('#reportrange').data('daterangepicker').remove();
            });
        });
    </script>
    <style>
        .cu-padding {
            padding-right: 0px;
            padding-left: 8px;
        }
    </style>
@stop
