@extends('layouts.default')

        <!-- Sidebar right menue -->
@section('content')
@include('includes.sidebar-right-menu')
        <!-- Profile Setting Statement-->
<div class="profile-setting-statement autoheight">
    <div class="container">
        <div class="col-xs-12">
            <div class="h2b">Settings</div>
        </div><!-- /.col-xs-12 -->

        <div class="row">
            @include('includes.profile-sidebar')

            <div class="statement-container col-md-9 col-xs-12">
                <ul class="list-group">
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-xs-6">
                                <div class="h3b">Statments</div>
                            </div><!-- /.col-xs-6 -->
                            <div class="col-xs-6">
                                <div class="h3b ar">Total Balance: {{format_currency($earning)}}</div>
                            </div><!-- /.col-xs-6 -->
                        </div><!-- /.row -->

                        <div class="statement-calendar mt20 row">
                            {!! Form::open(['route' => ['statement']]) !!}
                            <div class="col-sm-3">
                                <div class="form-group focus">
                                    <label class="">From Date</label>
                                    <input class="form-control" id="from" name="from"
                                           placeholder="" value="{{date('Y/m/d',strtotime($from))}}"/>
                                </div><!-- /.form-group -->
                            </div><!-- /.col-sm-3 -->
                            <div class="col-sm-3">
                                <div class="form-group focus">
                                    <label class="">To Date</label>
                                    <input class="form-control" id="to" name="to"
                                           placeholder="" value="{{date('Y/m/d',strtotime($to))}}"/>

                                </div><!-- /.form-group -->
                            </div><!-- /.col-sm-3 -->
                            <div class="col-sm-3">
                                <div class="form-group focus">
                                    <label class="">Transaction type</label>
                                    <select class="form-control" name="transaction_type">
                                       {{-- <option value="">All Transaction Types</option>--}}
                                        <option @if($transaction_type == 'credit') selected="selected"
                                                @endif value="credit">Credit
                                        </option>
                                        <option @if($transaction_type == 'debit') selected="selected"
                                                @endif value="debit">Debit
                                        </option>
                                    </select>


                                </div><!-- /.form-group -->
                            </div><!-- /.col-sm-3 -->
                            <div class="col-sm-3">
                                <button class="btn btn-green" type="submit">Go</button>
                            </div>
                            {!! Form::close() !!}
                        </div><!-- /.row -->
                    </li><!-- /.list-group-item -->

                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-xs-3">
                                <div class="h4b">Date</div>
                            </div><!-- /.col-xs-3 -->
                            <div class="col-xs-3">
                                <div class="h4b">Ref Id</div>
                            </div><!-- /.col-xs-3 -->
                            <div class="col-xs-3">
                                <div class="h4b">Type</div>
                            </div><!-- /.col-xs-3 -->
                            <div class="col-xs-3">
                                <div class="h4b">Amount / Balance</div>
                            </div><!-- /.col-xs-3 -->
                        </div><!-- /.row -->

                    </li><!-- /.list-group-item -->

                    <li class="statement-list list-group-item">

                        <!-- Nested List Group - Statement List -->
                        <ul class="list-group">
                            <?php $debit = 0;
                            $totalDebits = 0;
                            $totalCredit = 0;
                            ?>
                            @if(count($transactions) > 0)
                                @foreach($transactions as $row)
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-xs-3">{{getTimeByTZ($row->created_at, 'M. d, Y')}}</div>
                                            <div class="col-xs-3">{{encodeId($row->id,'message')}}</div>
                                            <div class="col-xs-3">{{config('constant_settings.STATEMENT_TYPES_STRING.'.$row->type)}}</div>
                                            <div class="col-xs-3">{{format_currency($row->amount)}}</div>
                                        </div><!-- /.row -->
                                    </li><!-- /.list-group-item -->
                                    @if($row->transaction_type == 'credit')
                                        <?php $debit = $debit + $row->amount;
                                        $totalDebits = $totalDebits + $row->amount;
                                        ?>
                                    @elseif($row->transaction_type == 'debit')
                                        <?php $debit = $debit - $row->amount;
                                        $totalCredit = $totalCredit + $row->amount;
                                        ?>
                                    @endif
                                @endforeach
                            @else
                                No data found!
                            @endif

                            <li class="statement-footer list-group-item">
                                <div class="row">
                                    <div class="statement-time col-xs-6">
                                        <div class="statement-period small">Statement Period :</div>
                                        <div class="statement-date small">{{getTimeByTZ($from, 'M. d, Y')}}
                                            to {{getTimeByTZ($to, 'M. d, Y')}}</div>
                                    </div><!-- /.col-xs-7 -->

                                    <div class="statement-balance-group col-xs-6">
                                        <div class="row">
                                            <div class="statement-balance-item">
                                                <div class="col-xs-7">
                                                    <div class="h4b">Beginnning Balance :</div>
                                                </div>
                                                <div class="col-xs-5">
                                                    <div class="txtb">{{format_currency($beginning_balance)}}</div>
                                                </div>
                                            </div><!-- /.statement-balance-item -->
                                        </div><!-- /.row -->

                                        <div class="row">
                                            <div class="statement-balance-item">
                                                <div class="col-xs-7">
                                                    <div class="h4b">Total Debits :</div>
                                                </div>
                                                <div class="col-xs-5">
                                                    <div>${{number_format($totalDebits)}}</div>
                                                </div>
                                            </div><!-- /.statement-balance-item -->
                                        </div><!-- /.row -->

                                        <div class="row">
                                            <div class="statement-balance-item">
                                                <div class="col-xs-7">
                                                    <div class="h4b">Total Credits :</div>
                                                </div>
                                                <div class="col-xs-5">
                                                    <div>$ {{number_format($totalCredit)}}</div>
                                                </div>
                                            </div><!-- /.statement-balance-item -->
                                        </div><!-- /.row -->

                                        <div class="row">
                                            <div class="statement-balance-item">
                                                <div class="col-xs-7">
                                                    <div class="h4b">Ending Balance :</div>
                                                </div>
                                                <div class="col-xs-5">
                                                    <div class="txtb">{{format_currency($earning)}}</div>
                                                </div>
                                            </div><!-- /.statement-balance-item -->
                                        </div><!-- /.row -->

                                    </div><!-- /.statement-balance-item /.col-xs-5 -->
                                </div><!-- /.row -->
                            </li><!-- /.list-group-item -->

                        </ul><!-- /.list-group - Nested -->

                    </li><!-- /.list-group-item -->

                </ul><!-- /.place-an-order-group .list-group -->


            </div><!-- /.col-md-9 -->
        </div><!-- /.row -->


    </div><!-- /.container -->
</div><!-- /.profile-setting-statement -->

@endsection

@section('footer-scripts')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">

    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
	<script>
        $(function () {
            $("#from").datepicker({
                dateFormat: "yy/mm/dd",
                //showOn: 'both',
                // buttonImage: '{{asset('local/public/assets/images/img-Start-Time.png')}}', //minDate : 0,
                onClose: function (selectedDate) {
                    $("#to").datepicker("option", "minDate", selectedDate);
                }
            });


            $("#to").datepicker({
                dateFormat: "yy/mm/dd",
                // showOn: 'both',
                // buttonImage: '{{asset('local/public/assets/images/img-Start-Time.png')}}', //minDate : 0,
                onClose: function (selectedDate) {
                    $("#from").datepicker("option", "maxDate", selectedDate);
                }
            });


        });
    </script>

@stop
