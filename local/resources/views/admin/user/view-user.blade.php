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
                        Approve User
                    </h1>
                    @if (Session::has('error'))
                        <div class="alert alert-danger" style="width:100%;line-height: 20px;
                color: #ff0000;">
                            <ul>

                            <span>
                        <li>{{ Session::get('error') }}</li>
                        </span>

                            </ul>
                        </div>
                    @endif
                    @if($user->approved == config('constant_settings.USERS_APPROVAL.APPROVED'))
                        <a style="float: right; color: #ee4b08;margin-right: 2px" href="{{route('users.ban-user',[$user->id])}}"
                           data-toggle="confirmation">Mark
                            Un-approved</a>
                    @else
                        <a style="float: right; color: #ee4b08;margin-right: 2px" href="{{route('users.approve-user',[$user->id])}}"
                           data-toggle="confirmation">Approve
                            User</a>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    @if($user->approved != config('constant_settings.USERS_APPROVAL.APPROVED'))
                        <div class="form-group">
                            <label for="user-title">Leave Comment:</label>
                             <textarea id="comment" name="comment" placeholder="Leave Comment" class="form-control" style="border:1px solid;"cols="70">{{$user->approval_comment}}</textarea>
                        </div>
                        <div class="form-group">
                        <button class="btn btn-default" id="save-comment" type="button">Save</button>
                        </div>
                    @endif

                        <div id="no-more-tables">
                            <table class="col-md-12 table-bordered table-striped table-condensed cf">
                                <thead class="cf">
                                <tr>
                                    <th>Photo ID</th>
                                    <th>Country or region</th>
                                    <th>Email</th>
                                    <th>Name</th>
                                    <th>Address</th>
                                    <th>Phone number</th>
                                    <th>Date of Birth</th>
                                    <th>Driver Type</th>
                                    <th>Be able to lift 50 lbs</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td data-title="Photo">
                                        @if(is_null($user->profile_photo_url) || empty($user->profile_photo_url))N/A
                                        @else
                                            <img src="{{getImage($user->profile_photo_url)}}" class="img-responsive" width="200">
                                        @endif</td>
                                    <td data-title="Country">{!!  country_name($user->country)!!}</td>
                                    <td data-title="Email">{{$user->email}}</td>
                                    <td data-title="Name">{{$user->display_name}}</td>
                                    <td data-title="Address">{{$user->address}}</td>
                                    <td data-title="Phone">{{$user->phone_number}}</td>
                                    <td data-title="Date">{{$user->dob}}
                                        @if($user->dob != '0000-00-00')(Age: {{\Carbon\Carbon::now()->diffForHumans(\Carbon\Carbon::parse($user->dob), TRUE) }})
                                        @endif</td>
                                    <td data-title="Driver">
                                        <?php $array_types = config('constant_settings.DELIVERY_PERSON_FLIP_TYPES');?>
                                        <?php $types = array_flip($array_types);?>
                                        <div class="user-input">{{isset($types[$user->driver_type])?ucfirst($types[$user->driver_type]):'N/A'}}
                                        </div></td>
                                    <td data-title="Be">
                                        @if($user->lift_weight == 1)
                                            Yes
                                        @else
                                            No
                                        @endif</td>
                                </tr>

                                </tbody>
                            </table>
                        </div>

                </div>
            </div>


            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Document</h1>
                    @if($user->approved == config('constant_settings.USERS_APPROVAL.APPROVED'))
                        <a style="float: right; color: #ee4b08" href="{{route('users.ban-user',[$user->id])}}"
                           data-toggle="confirmation">
                            Mark Un-approved
                        </a>
                    @else
                        <a style="float: right; color: #ee4b08;margin-right: 2px" href="{{route('users.approve-user',[$user->id])}}"
                           data-toggle="confirmation">Approve
                            User</a>
                    @endif

                </div>
            </div>


            <div class="row">
                <div class="col-sm-2">
                    <h3>Front Picture</h3>
                </div>
                <div class="col-sm-10">

                    <div class="col-sm-3">
                        <?php
                        $frontPic = (isset($documents[ 1 ]) ? $documents[ 1 ] : '');
                        ?>
                        @if(!empty($frontPic))
                            <img style="width:270px; height: 200px; float: left;" id="nic_front_picture"
                                 src="{!! getImage($frontPic->document_url) !!}"
                                 alt="image" class="zoom img-responsive" data-zoom-image="{!! getImage($frontPic->document_url) !!}">
                    </div>
                    <div class="col-sm-6">
                        <div class="verify" style="float: left;">
                            @if($frontPic->status == 1)
                                <span class="verified">Verified</span>
                                {{--<a href="{{route('users.disapprove-document',[$frontPic->id])}}" data-toggle="confirmation">
                                    Reject</a>--}}
                                <a data-toggle="confirmation" data-reject="" id="reject-{{$frontPic->id}}">Reject</a>
                                <div class="reject-reason reject-{{$frontPic->id}}" style="display: none">
                                    <textarea class="" name="reject-reason" placeholder="Reject Reason..."></textarea>
                                    <input type="submit" value="Save" class="save-reject" data-id="{{$frontPic->id}}">
                                </div>
                            @else
                                @if($frontPic->status == 0)
                                    <span class="not-verified"> Rejected</span>
                                @else
                                    <span class="in-process"> In Process</span>
                                @endif
                                <a href="{{route('users.verify-document',[$frontPic->id,1])}}" data-toggle="confirmation">
                                    Accept</a> |

                                @if($frontPic->status == 2)
                                    <a data-toggle="confirmation" data-reject="" id="reject-{{$frontPic->id}}">Reject</a>
                                    <div class="reject-reason reject-{{$frontPic->id}}" style="display: none">
                                        <textarea class="" name="reject-reason" placeholder="Reject Reason..."></textarea>
                                        <input type="submit" value="Save" class="save-reject" data-id="{{$frontPic->id}}">
                                    </div>
                                @else
                                    <a href="{{route('users.verify-document',[$frontPic->id, 2])}}"
                                       data-toggle="confirmation">
                                        In Process
                                    </a>
                                @endif
                            @endif
                        </div>
                    </div>

                    @else
                        <div class="col-sm-3">
                            <img style="min-width:270px; min-height: 200px;" id="nic_front_picture" class="img-responsive"
                                 src="{!! asset('local/public/assets/images/id-card-back.jpg') !!}"
                                 alt="image">
                        </div>
                </div><!--extra div for alignment-->
                    @endif
                </div>
            </div>

            <div class="row" style="margin-top: 20px">
                <div class="col-sm-2">
                    <h3>Back Picture</h3>
                </div>
                <div class="col-sm-10">

                    <div class="col-sm-3">
                        <?php
                        $backPic = (isset($documents[ 2 ]) ? $documents[ 2 ] : '');
                        ?>
                        @if(!empty($backPic))
                            <img style="width: 270px; height: 200px; float: left;" id="nic_front_picture"
                                 src="{!! getImage($backPic->document_url) !!}"
                                 alt="image" class="zoom img-responsive" data-zoom-image="{!! getImage($backPic->document_url) !!}">
                    </div>
                    <div class="col-sm-6">
                        <div class="verify">
                            @if($backPic->status == 1)
                                <span class="verified">Verified</span>
                                {{--<a href="{{route('users.disapprove-document',[$backPic->id])}}" data-toggle="confirmation">Reject</a>--}}
                                <a data-toggle="confirmation" data-reject="" id="reject-{{$backPic->id}}">Reject</a>
                                <div class="reject-reason reject-{{$backPic->id}}" style="display: none">
                                    <textarea class="" name="reject-reason" placeholder="Reject Reason..."></textarea>
                                    <input type="submit" value="Save" class="save-reject" data-id="{{$backPic->id}}">
                                </div>
                            @else
                                @if($backPic->status == 0)
                                    <span class="not-verified"> Rejected</span>
                                @else
                                    <span class="in-process"> In Process</span>
                                @endif

                                <a href="{{route('users.verify-document',[$backPic->id,1])}}" data-toggle="confirmation">
                                    Accept</a> |
                                @if($backPic->status == 2)
                                    <a data-toggle="confirmation" data-reject="" id="reject-{{$backPic->id}}">Reject</a>
                                    <div class="reject-reason reject-{{$backPic->id}}" style="display: none">
                                        <textarea class="" name="reject-reason" placeholder="Reject Reason..."></textarea>
                                        <input type="submit" value="Save" class="save-reject" data-id="{{$backPic->id}}">
                                    </div>
                                @else
                                    <a href="{{route('users.verify-document',[$frontPic->id, 2])}}"
                                       data-toggle="confirmation">
                                        In Process
                                    </a>
                                @endif

                            @endif
                        </div>
                        @else
                            <div class="col-sm-3">
                                <img style="min-width:270px; min-height: 200px;" id="nic_front_picture" class="img-responsive"
                                     src="{!! asset('local/public/assets/images/id-card-back.jpg') !!}"
                                     alt="image">
                            </div>
                        @endif


                    </div>
                </div>
            </div>


            <div class="row" style="margin-top: 20px">
                <div class="col-sm-2">
                    <h3>Licence Picture</h3>
                </div>
                <div class="col-sm-10">

                    <div class="col-sm-3">
                        <?php
                        $licensePic = (isset($documents[ 3 ]) ? $documents[ 3 ] : '');
                        ?>
                        <div class="add-form-block"
                             style="@if($user->driver_type == config('constant_settings.DELIVERY_PERSON_TYPES.WALKER') || $user->driver_type == config('constant_settings.DELIVERY_PERSON_TYPES.BIKER')) display:none; @else display: block; @endif ">

                            @if(!empty($licensePic))
                                <img style="width: 270px; height: 200px; float: left;" id="nic_front_picture"
                                     src="{!! getImage($licensePic->document_url) !!}"
                                     alt="image" class="zoom img-responsive" data-zoom-image="{!! getImage($licensePic->document_url) !!}">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="verify" style="float: left;">
                            @if($licensePic->status == 1)
                                <span class="verified">  Verified</span>
                                {{--<a href="{{route('users.disapprove-document',[$licensePic->id])}}"
                                   data-toggle="confirmation">Reject</a>--}}
                                <a data-toggle="confirmation" data-reject="" id="reject-{{$licensePic->id}}">Reject</a>
                                <div class="reject-reason reject-{{$licensePic->id}}" style="display: none">
                                    <textarea class="" name="reject-reason" placeholder="Reject Reason..."></textarea>
                                    <input type="submit" value="Save" class="save-reject" data-id="{{$licensePic->id}}">
                                </div>
                            @else
                                @if($licensePic->status == 0)
                                    <span class="not-verified"> Rejected</span>
                                @else
                                    <span class="in-process"> In Process</span>
                                @endif

                                <a href="{{route('users.verify-document',[$licensePic->id,1])}}" data-toggle="confirmation">
                                    Accept</a> |
                                @if($licensePic->status == 2)
                                    <a data-toggle="confirmation" data-reject="" id="reject-{{$licensePic->id}}">Reject</a>
                                    <div class="reject-reason reject-{{$licensePic->id}}" style="display: none">
                                        <textarea class="" name="reject-reason" placeholder="Reject Reason..."></textarea>
                                        <input type="submit" value="Save" class="save-reject" data-id="{{$licensePic->id}}">
                                    </div>
                                @else
                                    <a href="{{route('users.verify-document',[$licensePic->id, 2])}}"
                                       data-toggle="confirmation">
                                        In Process
                                    </a>
                                @endif
                            @endif

                        </div>
                        @else
                            <div class="col-sm-3">
                                <img style="min-width:270px; min-height: 200px;" id="nic_front_picture" class="img-responsive"
                                     src="{!! asset('local/public/assets/images/id-card-back.jpg') !!}"
                                     alt="image">
                            </div>
                    </div><!--Extra div for alignment-->
                        @endif
                    </div>
                </div>
            </div>



            <div class="row" style="margin-top: 20px">
                <div class="col-sm-2">
                    <h3>Commercial Picture</h3>
                </div>
                <div class="col-sm-10">

                    <div class="col-sm-3">
                        <?php
                        $ComlicensePic = (isset($documents[ 4 ]) ? $documents[ 4 ] : '');
                        ?>
                        <div class="add-form-block"
                             style="@if($user->driver_type == config('constant_settings.DELIVERY_PERSON_TYPES.TRUCK DRIVER') ) display:block; @else display: none; @endif ">
                            <div class="user-title">Commercial License Picture :</div>
                            @if(!empty($ComlicensePic))
                                <img style="width: 270px; height: 200px; float: left;" id="nic_front_picture"
                                     src="{!! getImage($ComlicensePic->document_url) !!}"
                                     alt="image" class="img-responsive zoom" data-zoom-image="{!! getImage($ComlicensePic->document_url) !!}">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="verify" style="float: left;">
                            @if($ComlicensePic->status == 1)
                                <span class="verified">  Verified</span>

                                <a data-toggle="confirmation" data-reject="" id="reject-{{$ComlicensePic->id}}">Reject</a>
                                <div class="reject-reason reject-{{$ComlicensePic->id}}" style="display: none">
                                    <textarea class="" name="reject-reason" placeholder="Reject Reason..."></textarea>
                                    <input type="submit" value="Save" class="save-reject" data-id="{{$ComlicensePic->id}}">
                                </div>
                            @else
                                @if($ComlicensePic->status == 0)
                                    <span class="not-verified"> Rejected</span>
                                @else
                                    <span class="in-process"> In Process</span>
                                @endif

                                <a href="{{route('users.verify-document',[$ComlicensePic->id,1])}}"
                                   data-toggle="confirmation">
                                    Accept</a> |
                                @if($licensePic->status == 2)
                                    <a data-toggle="confirmation" data-reject=""
                                       id="reject-{{$ComlicensePic->id}}">Reject</a>
                                    <div class="reject-reason reject-{{$ComlicensePic->id}}" style="display: none">
                                        <textarea class="" name="reject-reason" placeholder="Reject Reason..."></textarea>
                                        <input type="submit" value="Save" class="save-reject"
                                               data-id="{{$ComlicensePic->id}}">
                                    </div>
                                @else
                                    <a href="{{route('users.verify-document',[$ComlicensePic->id, 2])}}"
                                       data-toggle="confirmation">In Process</a>
                                @endif
                            @endif

                        </div>
                        @else
                            <div class="col-sm-3">
                                <img style="min-width:270px; min-height: 200px;" id="nic_front_picture" class="img-responsive"
                                     src="{!! asset('local/public/assets/images/id-card-back.jpg') !!}"
                                     alt="image">
                            </div>
                        @endif



                    </div>
                </div>

            </div>
        </div>
    </div>

    {!! csrf_field() !!}

@stop

@section('scripts')


    {!! HTML::script('local/public/assets/plugins/image-zoom/jquery.elevatezoom.js') !!}
    {{--{!! HTML::script('local/public/assets/js/bootstrap.min-1.js') !!}--}}
    {!! HTML::script('local/public/assets/js/bootstrap/confirmation.js') !!}
    <script type="text/javascript">

        $(document).ready(function () {
            $('[data-toggle="confirmation"]').confirmation({
                singleton: true,
                popout: true,

            });
            $('[data-toggle="confirmation"]').on('confirmed.bs.confirmation', function (e) {
                e.preventDefault();
                if (e.currentTarget.hasAttribute('data-reject')) {
                    var id = $(e.currentTarget).attr('id');
                    $('.' + id).show();
                }

            });

            $('.save-reject').click(function (e) {
                e.preventDefault();
                var id = $(this).data('id');
                var reason = $(this).siblings('textarea').val();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('input[name="_token"]').val()
                    }
                });

                $.ajax({
                    url: '/admin/users/reject-document',
                    data: {id: id, reason: reason, status: 0},
                    type: 'POST',
                    success: function (data) {
                        window.location.reload();
                    }
                })
            });
            $('#save-comment').click(function (e) {
                e.preventDefault();
                var val = $('#comment').val();
                if (val == '') {
                    return false;
                }
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('input[name="_token"]').val()
                    }
                });
                $('#save-comment').text('Saving..');
                $.ajax({
                    url: '{{url('admin/users/leave-comment')}}',
                    data: {comment: val, userId: {{$user->id}}},
                    type: 'POST',
                    success: function (data) {
                        // window.location.reload();
                        if (data == 1) {
                            $('#save-comment').text('Save');
                        }
                    }
                })
            })
        });
    </script>
    <style>
        .header-main {
            position: relative;
        }

        .verify {
            float: left;
            margin-left: 20px;

        }

        .verify a {
            color: #ee4b08;
        }

        .verified {
            background: green none repeat scroll 0 0;
            color: #ffffff;
            padding: 5px;
            text-align: center;
            width: 100px;
        }

        .not-verified {
            background: red none repeat scroll 0 0;
            color: #ffffff;
            padding: 5px;
            text-align: center;
            width: 100px;
        }

        .in-process {
            background: yellowgreen none repeat scroll 0 0;
            color: #ffffff;
            padding: 5px;
            text-align: center;
            width: 100px;
        }

        .reject-reason {
            width: 355px;
        }

        .reject-reason textarea {
            border: 1px solid;
            float: left;
            width: 80%;
        }
    </style>
    <script>
        $('.zoom').elevateZoom({
            //zoomType: "inner",
            cursor: "pointer",
            zoomWindowFadeIn: 500,
            zoomWindowFadeOut: 750,
            zoomWindowPosition: 12
        });

        $(document).ready(function() {
            $('#list').click(function(event){event.preventDefault();$('#products .item').addClass('list-group-item');});

        });
    </script>

@stop

