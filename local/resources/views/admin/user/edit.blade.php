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
                        Update User
                    </h1>

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
                    @if(Session::has('errorMessage'))
                        <div class="alert alert-danger fade in">
                            <a href="#" class="close" data-dismiss="alert {{ Session::get('alert-class display-success', 'alert-info') }}" aria-label="close">&times;</a>
                            <strong>Success!</strong> {{ Session::get('errorMessage') }}
                        </div>
                    @endif
                    {!! Form::model($users , ['method' => 'PATCH', 'url' => "admin/users/update/".$users->id, "enctype"=>"multipart/form-data"]) !!}

                    <div class="form-group">
                        <?php $roll = array_except($rolls, ['id', '1']);?>
                        <div class="user-title">User Type * :</div>
                            <select class="form-control" name="roll">
                                @foreach($roll as $key => $row)

                                    <option @if($key == $myRole->role_id) selected
                                            @endif value="{{$key.'-'.$row}}">{{$row}}</option>

                                @endforeach
                            </select>
                    </div>

                    <div class="form-group">
                        <div class="user-title">Permissions * :</div>
                        <br/>
                        <div class="user-input">
                            @foreach($allPermissions as $perm)
                                {!!  Form::checkbox('permissions[]', $perm->id  ,(isset($permissions[$perm->id])?'checked':''),['class' => 'form-control' , 'id' => 'user-input'])!!}
                                <span>
                            {{$perm->name}}
                        </span>
                            @endforeach
                        </div>
                        <br/>
                    </div>


                    <div class="form-group">
                        <div class="user-title">Country or region * :</div>
                        <div class="user-input">{!!  Form::select('countries', $countries , $users->country ,['class' => 'form-control' , 'id' => 'user-input' ,'required' => 'required'])!!}</div>
                    </div>

                    <div class="form-group">
                        <div class="user-title">First Name * :</div>
                        <input  class="form-control"  name="first_name" placeholder="First Name" value="{{$users->first_name}}" type="text">
                    </div>

                    <div class="form-group">
                        <div class="user-title">Last Name * :</div>
                        <input  class="form-control"  name="last_name" placeholder="Last Name" value="{{$users->last_name}}" type="text">
                    </div>
                    <div class="form-group">
                        <div class="user-title">Email * :</div>
                        <input  class="form-control"  name="email" placeholder="e.g.demedat@yahoo.com" value="{{$users->email}}" type="text">
                        <br/>
                    </div>
                    <div class="form-group">
                        <div class="user-title">Password * :</div>
                        <input  class="form-control"  name="password" placeholder="demedat@123" value="" type="password">
                    </div>
                    <div class="form-group">
                        <div class="user-title">Retype Password * :</div>
                        <input  class="form-control"  name="retype_password" placeholder="demedat@123" value="" type="password">
                    </div>

                    <button id="btn-proceed" class="btn btn-default" type="submit">Save</button>
                    <a href="{{url('admin/users')}}" id="btn-proceed" class="btn btn-primary" type="submit">Cancel</a>
                    <input type="hidden" name="_token" value="{{Session::token()}}">
                    {!! Form::close() !!}
                    <br/>
                </div>
            </div>
        </div>
    </div>
@stop
@section('scripts')
<script>
    $('.close').click(function(e){
        $('.alert').hide('slow');

    });
</script>

@stop




