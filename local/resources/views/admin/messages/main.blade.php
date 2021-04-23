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
                        Messages
                    </h1>

                </div>

                <div class="clearfix"></div>
                @include('includes.alerts')
                <div class="clearfix"></div>
                <ul class="nav nav-tabs">
                    <li class="@if(Request::is('admin/users/purchaser')) active @endif">
                        <a href="{{url('admin/users/purchaser')}}">Purchaser</a>
                    </li>
                    <li class="@if(Request::is('admin/users/delivery_man')) active @endif">
                        <a href="{{url('admin/users/delivery_man')}}">Delivery</a>
                    </li>
                    <li class="@if(Request::is('admin/users/retailer')) active @endif">
                        <a href="{{url('admin/users/retailer')}}">Business</a>
                    </li>
                    <li class="pull-right">
                        <button type="button" class="btn btn-primary" id="send">Send</button>
                    </li>
                </ul>

                <div class="tab-content">
                    <div id="purchaser" class="tab-pane fade in active">
                        @include('admin.messages.users.purchaserMessages')
                    </div>

                </div>
            </div>
        </div>
    </div>





@stop
@section('scripts')
    <!-- Modal -->
    <div class="modal fade" id="messageForm" tabindex="-1" role="dialog"
         aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->

                {!! Form::open(['url' => 'admin/send-message','class' => 'form-horizontal', 'role' => 'form']) !!}
                <div class="modal-header">
                    <button type="button" class="close"
                            data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">
                        Message
                    </h4>
                </div>

                <!-- Modal Body -->
                <div class="modal-body">


                    {!! Form::hidden('users',NULL,['id' => 'allUsers']) !!}
                    <div class="form-group">
                        <label class="col-sm-2 control-label"
                               for="title">Title</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control"
                                   id="" placeholder="Title" required name="title"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"
                               for="description">Description</label>
                        <div class="col-sm-10">
                            <textarea style="resize:vertical" name="body" class="form-control" placeholder="Description..."></textarea>
                        </div>
                    </div>


                </div>

                <!-- Modal Footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-default"
                            data-dismiss="modal">
                        Close
                    </button>
                    <button type="submit" class="btn btn-primary" >
                        Send
                    </button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function (e) {

            $('#send').click(function () {
                if ($("input[name='users[]']:checked").length > 0) {
                    var values = $("input[name='users[]']:checked")
                            .map(function () {
                                return $(this).val();
                            }).get();
                    $('#allUsers').val(values);
                    $('#messageForm').modal('toggle');
                } else {
                    alert('Check at least one user.')
                }

            });
        })
    </script>
@stop



