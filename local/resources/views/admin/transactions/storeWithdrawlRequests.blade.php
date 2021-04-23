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
                        Payments
                    </h1>

                    <form method="get" action="{{url('admin/withdrawalRequests')}}" id="serachForm">

                        <div class="input-group" style="margin-bottom: 10px">
                            <input value="{{$term}}" class=" form-control search" name="term" type="text"
                                   required="required"
                                   placeholder="Type store name" style="width: 100%;">

                      <span class="input-group-btn" style="width: 20%">
                                <select name="status" class="form-control">
                                    <option value="">All statuses</option>
                                    <option @if($status == 'pending') selected @endif value="pending">Pending</option>
                                    <option @if($status == 'processing') selected @endif value="processing">Processing
                                    </option>
                                    <option @if($status == 'completed') selected @endif value="completed">Completed
                                    </option>
                                    <option @if($status == 'canceled') selected @endif value="completed">Cancelled
                                    </option>
                                </select>
                      </span>
                             <span class="input-group-btn" style="width: 20%">

                            <button class="btn btn-default searchFormBtn" type="button">Search</button>
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
                            <th>Title</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Account <br/>Balance</th>
                            <th>Withdrawal Amount</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(!$withdrawals->isEmpty())
                            @foreach($withdrawals as $withdrawal)
                            <tr>
                                <td data-title="Title">{{$withdrawal->seller->display_name}}<span
                                            class="awdi-badge">(Seller)</span></td>
                                <td data-title="Date">{{getTimeByTZ($withdrawal->created_at,'m-d-Y')}}</td>
                                <td data-title="Status">{{ucfirst($withdrawal->status)}}</td>
                                <td data-title="Account">${{format_currency($withdrawal->balance,2)}}</td>
                                <td data-title="Withdrawal"> ${{format_currency($withdrawal->amount - ($withdrawal->amount*$withdrawal->fee_percentage)/100,2)}}</td>
                                <td data-title="Action">
                                    <a href="#" class="awdi-btn view_bank_detail" data-toggle="modal" data-target="#popup_container" id="{{$withdrawal->withdrawal_method_id}}">View bank detail</a>&nbsp;&nbsp;
                                @if($withdrawal->status == 'pending')
                                   <a class="start_process awdi-btn"
                                       href="{{url('admin/startPaymentProcess/'.$withdrawal->id)}}">Start Process</a>&nbsp;
                                @elseif($withdrawal->status == 'processing')
                                        <a href="#" class="change_status awdi-btn"  data-backdrop="static"
                                           data-keyboard="false"  data-toggle="modal" data-target="#markPaid" id="{{$withdrawal->id}}">Mark Paid</a>&nbsp;
                                @elseif($withdrawal->status == 'completed')
                                        <a href="#" class="view_payment_info awdi-btn" data-toggle="modal" data-target="#paymentInfo" id="{{$withdrawal->id}}"> Payment Info</a>
                                  </td>
                                @endif
                            </tr>
                            @endforeach
                            <span class="pagination">{!! $withdrawals->render() !!}</span>
                        @else
                            <tr> <td class="awdi-itm">No record found</td></tr>

                        @endif
                        </tbody>
                    </table>
                </div>

            </div>

        </div>
    </div>



@stop

@section('scripts')

    @include('admin.includes.statusPopup.bankDetail')
    @include('admin.includes.statusPopup.paymentInfo')
    @include('admin.includes.statusPopup.Info')
    <script type="text/javascript" src="{!! asset('local/public/assets/js/jquery.form.min.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('local/public/assets/js/jquery-ui.min.js') !!}"></script>
    <link rel="stylesheet" href="{!! asset('local/public/assets/css/jquery-ui.min.css') !!}">
    <script type="text/javascript" src="{!! asset('local/public/assets/js/jquery.validate.min.js') !!}"></script>


    <style>
        .error {
            color:#FF0000;
        }

    </style>


    <script type="text/javascript">

        jQuery(document).on('click', '.searchFormBtn', function (e) {
            e.preventDefault();
            jQuery('#serachForm').submit();
        })
        jQuery(document).on('click', '.view_bank_detail', function (e) {
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });//for token purpose in laravel
            $("#page_loader").show();
            var method_id = e.target.id;
            jQuery.ajax({
                type: "Post",
                url: '{{url('admin/viewPaymentMethodDetails')}}',
                data: {method_id: method_id},
                success: function (data) {
                    if (data != 0) {
                        $("#page_loader").hide();
                        $("#viewDetail").html(data);
                    } else {
                        $("#page_loader").hide();
                        $("#viewDetail").html("No Record Found");
                        return false;
                    }
                }, error: function (xhr, ajaxOptions, thrownError) {
                    alert("ERROR:" + xhr.responseText + " - " + thrownError);
                }
            });
        });

        jQuery(document).on('click', '.view_payment_info', function (e) {
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });//for token purpose in laravel
            $("#payment_loader").show();
            var withdrawal_id = e.target.id;
            jQuery.ajax({
                type: "Post",
                url: '{{url('admin/viewPaymentInfo')}}',
                data: {withdrawal_id: withdrawal_id},
                success: function (data) {
                    if (data != 0) {
                        $("#payment_loader").hide();
                        $("#paymentDetail").html(data);
                    } else {
                        $("#payment_loader").hide();
                        $("#paymentDetail").html("No Record Found");
                        return false;
                    }
                }, error: function (xhr, ajaxOptions, thrownError) {
                    alert("ERROR:" + xhr.responseText + " - " + thrownError);
                }
            });
        });

        jQuery(document).on('click', '.change_status', function (e) {
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });//for token purpose in laravel
            $("#Info_loader").show();
            var withdrawal_id = e.target.id;
            jQuery.ajax({
                type: "Post",
                url: '{{url('admin/chagePaymentStatus')}}',
                data: {withdrawal_id: withdrawal_id},
                success: function (data) {
                    if (data != 0) {
                        $("#Info_loader").hide();
                        $("#paidDetail").html(data);
                    } else {
                        $("#Info_loader").hide();
                        $("#paidDetail").html("No Record Found");
                        return false;
                    }
                }, error: function (xhr, ajaxOptions, thrownError) {
                    alert("ERROR:" + xhr.responseText + " - " + thrownError);
                }
            });
        });

        jQuery(document).on('click', '.js-modal-close', function (e) {
            e.preventDefault();
            $(".modal-box, .modal-overlay").fadeOut(500, function () {
            });
        });

        jQuery(document).on('click', '#uploadFile', function (e) {
            e.preventDefault();
            jQuery('#deposit_slip_attachment').trigger('click');
        });
        jQuery(document).on('change', '#deposit_slip_attachment', function (e) {
            var fullPath = document.getElementById('deposit_slip_attachment').value;
            if (fullPath) {
                var startIndex = (fullPath.indexOf('\\') >= 0 ? fullPath.lastIndexOf('\\') : fullPath.lastIndexOf('/'));
                var filename = fullPath.substring(startIndex);
                if (filename.indexOf('\\') === 0 || filename.indexOf('/') === 0) {
                    filename = filename.substring(1);
                }
                jQuery('#attachment_name').text(filename);
            }
        });
        jQuery(document).on('click', '#submitPaymentFrom', function (e) {
            e.preventDefault();
            validateForm();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })
            if (jQuery('#paymentInfoForm').valid()) {
                jQuery('#myLoader').show();
                jQuery('#paymentInfoForm').ajaxSubmit({
                    success: function (responseText, statusText, xhr, $form) {
                        if (responseText.status == 1) {
                            $(".modal-box, .modal-overlay").fadeOut(500);
                            window.location.reload();
                        } else {
                            alert('Error Saveing Data')
                        }
                    }
                });
            }
        });

        validateForm = function () {
            jQuery('#paymentInfoForm').validate({
                errorElement: 'span',
                rules: {
                    'deposited_to': {required: true,date: true},
                    'deposit_date': {required: true,date: true},
                    'slip_number': {required: true}
                }
            });
        }

    </script>

@stop

