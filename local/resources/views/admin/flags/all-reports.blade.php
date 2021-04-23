@extends('admin.layout.default')

@section('styles')
{!! HTML::style('local/public/assets/admin/css/plugins/morris.css') !!}

        <!-- Custom Fonts -->

{!! HTML::style('local/public/assets/admin/font-awesome/css/font-awesome.min.css') !!}
        <!-- Post Div-->
{!! HTML::style('local/public/assets/admin/css/responsiveTable.css') !!}
{!! HTML::style('local/public/assets/admin/css/dataTable.css') !!}
@stop
@section('content')
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        All Reports
                    </h1>
                    {{--<ol class="breadcrumb">
                        <li>
                            <i class="fa fa-dashboard"></i>  <a href="">Dashboard</a>
                        </li>
                    </ol>--}}
                </div>
            </div>

            <div class="row" style="margin-left: 1px;margin-bottom: 10px">
                <div id="no-more-tables">
                    <table id="report" class="col-md-12 table-bordered table-striped table-condensed cf">
                        <thead class="cf">
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>


                            <tr>
                                <td data-title="Name">a</td>
                                <td data-title="Email">a</td>
                                <td data-title="Action">a</td>

                            </tr>


                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

    <div id="delRecord" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Delete Record</h4>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want delete this
                </div>
                <div class="modal-footer">
                    <input class="delUser" type="hidden" name="delUser" value="">
                    <a href="#" class="btn btn-danger delUser" data-dismiss="modal">Delete</a>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                </div>
            </div>

        </div>
    </div>

    {!! csrf_field() !!}

@stop
@section('scripts')
    {!! HTML::script('local/public/assets/admin/js/jquery.dataTables.min.js') !!}
    {!! HTML::script('local/public/assets/admin/js/dataTables.buttons.min.js') !!}
    {!! HTML::script('local/public/assets/admin/js/button.flash.js') !!}
    {!! HTML::script('local/public/assets/admin/js/jszip.min.js') !!}
    {!! HTML::script('local/public/assets/admin/js/pdfmake.min.js') !!}
    {!! HTML::script('local/public/assets/admin/js/vfs_fonts.js') !!}
    {!! HTML::script('local/public/assets/admin/js/buttons.html5.min.js') !!}
    {!! HTML::script('local/public/assets/admin/js/buttons.print.min.js') !!}
    {!! HTML::script('local/public/assets/admin/js/dataTables.bootstrap.js') !!}
<style>

    .btn {
        background-color: #008CBA;
        border: none;
        color: white;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 12px;
        margin: 12px 2px;
        cursor: pointer;
    }#report_filter{
             float: right;
    }

    @media (max-width: 768px) {
        #report_filter {
            float: right;
            position: relative;
            top: -40px;
            right: 16px;
        }
        .input-sm {
            width: 80px;
        }

    }

    @media (max-width: 736px) {
        #report_filter {
            float: right;
            position: relative;
            top: -40px;
            right: 16px;
        }
        .input-sm {
            width: 100px;
        }
    }
    @media (max-width: 667px) {
        #report_filter {
            float: right;
            position: relative;
            top: -62px;
            right: 16px;
        }

        .input-sm {
            width: 66px;
        }
    }
</style>

    <script>
        $(document).ready(function() {
            $('#report').DataTable( {
                dom: 'Bfrtip',
                buttons:[{
                    extend: "copy",
                    className: "btn"
                }, {
                    extend: "csv",
                    className: "btn"
                }, {
                    extend: "excel",
                    className: "btn"
                }, {
                    extend: "pdf",
                    className: "btn"
                }, {
                    extend: "print",
                    className: "btn"
                }],

            } );
        } );
    </script>
@stop



