@extends('admin.layout.default')

@section('styles')
{!! HTML::style('local/public/assets/admin/css/plugins/morris.css') !!}

        <!-- Custom Fonts -->

{!! HTML::style('local/public/assets/admin/font-awesome/css/font-awesome.min.css') !!}
        <!-- Post Div-->
{!! HTML::style('local/public/assets/admin/css/responsiveTable.css') !!}
@stop
@section('content')
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Sales & Accounts
                    </h1>
                    <form action="{{url('admin/transactions')}}" method="get" id="serachFrom">
                        <div class="input-group" style="margin-bottom: 10px">
                            <input value="{{$key}}" class=" form-control search" name="key" type="text" required="required"
                                   placeholder="Type store name" style="width: 100%;">
                             <span class="input-group-btn" style="width: 20%">
                            <button class="btn btn-default search-btn" type="button">Search</button>
                                    </span>
                        </div>
                    </form>
                </div>
            </div>

            <div class="row" style="margin-left: 1px;margin-bottom: 10px">
                <div id="no-more-tables">
                    <table class="col-md-12 table-bordered table-striped table-condensed cf">
                        <thead class="cf">
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Orders</th>
                            <th>Amount</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($transactions as $transaction)
                            <tr>
                                <td data-title="Name">{{$transaction->user->display_name}}</td>
                                <td data-title="Email">&nbsp;{{format_currency($transaction->last_month_sales)}}</td>
                                <td data-title="Orders">{{$transaction->total_orders}}</td>
                                <td data-title="Amount">&nbsp;{{format_currency($transaction->balance)}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                {!!  $transactions->render() !!}
            </div>

        </div>
    </div>

@stop

@section('scripts')
    {!! HTML::script('local/public/assets/admin/js/plugins/morris/raphael.min.js') !!}
    {!! HTML::script('local/public/assets/js/jquery.validate.min.js') !!}

  {{--  {!! HTML::script('local/public/assets/js/bootstrap.min-1.js') !!}--}}
    {!! HTML::script('local/public/assets/js/bootstrap/confirmation.js') !!}

    <style>
        .error {
            color:#FF0000;
        }

    </style>
    <script type="text/javascript">

        jQuery(document).on('click','.search-btn',function (e) {
            e.preventDefault();
            jQuery('#serachFrom').submit();
        });

        jQuery(document).ready(function(e){
            jQuery('#serachFrom').validate({
                errorElement : 'span',
                rules : {
                    'key' : {required:true}
                }
            });
        });

    </script>

@stop
