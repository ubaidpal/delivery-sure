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
                        Pending Approval
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <i class="fa fa-dashboard"></i>  <a href=""> Pending Approval Record</a>
                        </li>
                    </ol>
                </div>
            </div>

            <div class="row" style="margin-left: 1px;margin-bottom: 10px">
                <div id="no-more-tables">
                    <table class="col-md-12 table-bordered table-striped table-condensed cf">
                        <thead class="cf">
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td data-title="Name">{{$user->display_name}}</td>
                                <td data-title="Email">{{$user->email}}</td>
                                @if(is_null($user->approved) )
                                    <td data-title="Action"><a href="{{url('admin/users/start-approval/'.$user->id)}}" class="editUser"
                                                               id="{{$user->id}}"
                                                               title="Start process" data-toggle="confirmation" > Start Process</a></td>
                                @else
                                    <td data-title="Action"><a href="{{url('admin/users/get-user/'.$user->id)}}" class="editUser" id="{{$user->id}}"
                                                               title="Edit">View User Detail</a></td>
                                @endif
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                {!!  $users->render() !!}
            </div>

        </div>
    </div>

    <div class="modal-box cart" id="confirmation_popup" style="display: none;">
        <a href="#" class="js-modal-close close">?</a>

        <div class="modal-body">
            <div class="edit-photo-poup">
                <p class="mt10" style="width: 400px;height: 30px;line-height: normal">Are you sure you want delete this
                    user?</p><br>
                <a class="btn fltL blue mr10 confirmed" href="#">Yes</a>
                <a class="btn fltL grey mr10 js-modal-close" href="#">No</a>
            </div>
        </div>
    </div>
    {!! csrf_field() !!}
@stop

@section('scripts')
    {!! HTML::script('local/public/assets/admin/js/plugins/morris/raphael.min.js') !!}
    {!! HTML::script('local/public/assets/admin/js/plugins/morris/morris.min.js') !!}
    {!! HTML::script('local/public/assets/admin/js/plugins/morris/morris-data.js') !!}

   {{--{!! HTML::script('local/public/assets/js/bootstrap.min-1.js') !!}--}}
    {!! HTML::script('local/public/assets/js/bootstrap/confirmation.js') !!}

    <script type="text/javascript">

        $(document).ready(function () {
            $('[data-toggle="confirmation"]').confirmation()
        });
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('input[name="_token"]').val()
            }
        });
        $(document).on("click", ".deleteUser", function (e) {
            e.preventDefault();
            var user_id = e.target.id;
            e.preventDefault();
            var appendthis = ("<div class='modal-overlay js-modal-close'></div>");

            $("body").append(appendthis);
            $(".modal-overlay").fadeTo(500, 0.7);

            $('#confirmation_popup').fadeIn($(this).data());

            var url = jQuery(this).attr('id');
            jQuery('.confirmed').attr('id', url);

        });
        jQuery(document).on('click', '.confirmed', function (e) {
            e.preventDefault();
            var user_id = $(e.target).attr('id');
            jQuery.ajax({
                type: "Post",
                url: '{{url("admin/users/delete")}}',
                data: {user_id: user_id},
                success: function (data) {
                    if (data == 1) {
                        window.location.reload();
                    } else {
                        alert('No delete File');
                    }

                }, error: function (xhr, ajaxOptions, thrownError) {
                    alert("ERROR:" + xhr.responseText + " - " + thrownError);
                }
            });
        });
        $(document).on("click", ".disableUser", function (e) {
            e.preventDefault();
            var user_id = e.target.id;
            var user = $(this).attr('href');
            jQuery.ajax({
                type: "Post",
                url: '{{url("admin/users/userStatus")}}',
                data: {user_id: user_id, user: user},
                success: function (data) {
                    if (data == 1) {
                        window.location.reload();
                    }
                }, error: function (xhr, ajaxOptions, thrownError) {
                    alert("ERROR:" + xhr.responseText + " - " + thrownError);
                }
            });
        });
        $(document).on("click", ".ActiveUser", function (e) {
            e.preventDefault();
            var user_id = e.target.id;
            var user = $(this).attr('href');
            jQuery.ajax({
                type: "Post",
                url: '{{url("admin/users/userStatus")}}',
                data: {user_id: user_id, user: user},
                success: function (data) {
                    if (data == 1) {
                        window.location.reload();
                    }
                }, error: function (xhr, ajaxOptions, thrownError) {
                    alert("ERROR:" + xhr.responseText + " - " + thrownError);
                }
            });
        });

    </script>

    <style>
        .cu-padding{
            padding-right: 0px; padding-left: 8px;
        }
    </style>
@stop



