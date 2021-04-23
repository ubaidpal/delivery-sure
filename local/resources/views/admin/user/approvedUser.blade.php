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
                        Active User
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <i class="fa fa-dashboard"></i>  <a href="">Dashboard</a>
                        </li>
                        <span class="pull-right">
                            <a style="height: 28px;padding-top: 3px;" type="button" class="btn btn-primary delete_all">Delete Selected</a>
                        </span>
                    </ol>
                </div>
            </div>

            <div class="row" style="margin-left: 1px;margin-bottom: 10px">
                <div id="no-more-tables">
                    <table class="col-md-12 table-bordered table-striped table-condensed cf">
                        <thead class="cf">
                        <tr>
                            <th><input  name="allUser" id="allUser" type="checkbox"/></th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($users as $user)
                            <tr data-row-id="{{$user->id}}">
                                <td><input class="users" data-id="{{$user->id}}"  type="checkbox"/></td>
                                <td data-title="Name">{{$user->display_name}}</td>
                                <td data-title="Email">{{$user->email}}</td>

                                <td data-title="Action">
                                    <?php if($user->active <= 0){ ?>
                                    <?php if($user->id != Auth::user()->id){ ?>
                                    <a href="{{$user->active}}" class="ActiveUser" id="{{$user->id}}">Active</a>&nbsp;&nbsp;
                                    <?php } ?>
                                    <?php } ?>

                                    <?php if($user->active == 1){ ?>
                                    <?php if($user->id != Auth::user()->id){ ?>
                                    <a href="{{$user->active}}" class="disableUser" id="{{$user->id}}">Disable</a>&nbsp;&nbsp;

                                    <?php } ?>
                                    <?php } ?>

                                    @if($user->approved == 1 && $user->id != Auth::user()->id)
                                        <a href="{{route('users.ban-user',[$user->id])}}" class="" id="{{$user->id}}">Un-approved</a>&nbsp;&nbsp;

                                    @endif

                                    <a href="{{url('admin/users/edit/'.$user->id)}}" class="editUser" id="{{$user->id}}"
                                       title="Edit">Edit</a>&nbsp;&nbsp;
                                    <a href="#" data-toggle="modal" data-target="#delRecord" class="deleteUser" id="{{$user->id}}" title="Delete">Delete</a>&nbsp;&nbsp;

                                </td>

                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
                {!!  $users->render() !!}
            </div>

                <div style="text-align: center;display: none;z-index: 999999999;" id="loading">
                    <img class="img-responsive" src="{!! asset('local/public/assets/images/load/waiting.gif') !!}">
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
    {!! HTML::script('local/public/assets/admin/js/plugins/morris/raphael.min.js') !!}
    {!! HTML::script('local/public/assets/admin/js/plugins/morris/morris.min.js') !!}
    {!! HTML::script('local/public/assets/admin/js/plugins/morris/morris-data.js') !!}
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('input[name="_token"]').val()
            }
        });

        $(document).on("click", ".deleteUser", function (e) {
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });//for token purpose in laravel
            var delUser = e.target.id;
            $(".delUser").val(delUser);
            return false;
        });

        jQuery(document).on('click', '.delUser', function (e) {
            e.preventDefault();
            var user_id =  $('.delUser').val();
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

        jQuery('#allUser').on('click', function(e) {
            if($(this).is(':checked',true))
            {
                $(".users").prop('checked', true);
            }
            else
            {
                $(".users").prop('checked',false);
            }
        });
        jQuery('.delete_all').on('click', function(e) {
            var allVals = [];
            $(".users:checked").each(function() {
                allVals.push($(this).attr('data-id'));
            });
            //alert(allVals.length); return false;
            if(allVals.length <=0)
            {
                alert("Please select row.");
            }
            else {
                //$("#loading").show();
                WHEN_USER_DELETE = "Are you sure you want to delete this row?";
                var check = confirm(WHEN_USER_DELETE);
                if(check == true){
                    var user_selected_values = allVals.join(",");
                    $.ajax({
                        type: "POST",
                        url: "{{url("admin/users/allUsrDelete")}}",
                        data: 'ids=' + user_selected_values,
                        success: function (response) {
                            //$("#loading").hide();
                            if(response !=0){
                                alert('Delete Successfully...');
                            }else {
                                alert('Record Not Deleted..');
                            }

                            //$("#msgdiv").html(response);
                        }
                    });
                    //for client side
                    $.each(allVals, function( index, value ) {
                        $('table tr').filter("[data-row-id='" + value + "']").remove();
                    });


                }
            }
        });
    </script>

    <style>
        .cu-padding{
            padding-right: 0px; padding-left: 8px;
        }
    </style>
@stop



