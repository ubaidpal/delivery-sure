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
                    Update Password
                </h1>
                @include('admin.alert.alert')

                {!! Form::model(null , ['method' => 'PATCH', 'url' => "admin/changePassword/update/".Auth::user()->id, "enctype"=>"multipart/form-data" ,"id" =>"changePassword"]) !!}

                @if (count($errors) > 0)
                    <div class="alert alert-danger" style="width:100%;line-height: 20px;
                color: #ff0000;">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <span>
                        <li>{{ $error }}</li>
                        </span>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if(Session::has('message'))
                    <div class="alert alert-success fade in">
                        <a href="#" class="close" data-dismiss="alert {{ Session::get('alert-class display-success', 'alert-info') }}" aria-label="close">&times;</a>
                        <strong>Success!</strong> {{ Session::get('message') }}
                    </div>
                @endif

                <div class="form-group">
                    <label for="user-title">Old Password *</label>
                    <input  class="form-control" type="password" name="old_password" placeholder="old password">
                </div>
                <div class="form-group">
                    <label for="user-title">New Password *</label>
                    <input  class="form-control" id="password" type="password" name="password" placeholder="retype password">
                </div>

                <div class="form-group">
                    <label for="user-title">Retype Password *</label>
                    <input  class="form-control" type="password" name="retype_password" placeholder="new password format e.g.demedat2#">
                </div>

                <button type="submit" class="btn btn-default savePassword">Submit</button>
                <a href="{{url('admin')}}"  class="btn btn-primary" type="submit">Cancel</a>
                <input type="hidden" name="_token" value="{{Session::token()}}">

                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

@stop

@section('scripts')
    {!! HTML::script('local/public/assets/js/jquery.validate.min.js') !!}

    <style>
        .error {
            color:#FF0000;
        }

    </style>
    <script type="text/javascript">

        jQuery(document).on('click','.savePassword',function (e) {
            e.preventDefault();
            jQuery('#changePassword').submit();
        });

        jQuery(document).ready(function(e){
            jQuery('#changePassword').validate({
                errorElement : 'span',
                rules : {
                    'old_password' : {required:true},
                    'password' : {required:true},
                    retype_password: {
                        required:true,
                        equalTo: "#password"
                    }
                }
            });
        });
        $('.close').click(function(e){
            $('.alert').hide('slow');

        });
    </script>

@stop

