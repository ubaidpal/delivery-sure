{{--

    * Created by   :  Muhammad Yasir
    * Project Name : demedat
    * Product Name : PhpStorm
    * Date         : 20-Jun-16 11:58 AM
    * File Name    : 

--}}
<?php //echo '<tt><pre>'; print_r(session('exception')); die;?>
@if(session('exception'))
    <div class="alert alert-danger">
        <ul>
            <li>{{'Error description: ' . session('exception')->getDescription()}}</li>
            <li>{{'Error message: ' . session('exception')->getMessage()}}</li>
        </ul>

    </div>
@endif
@if(session('message'))
    <div class="alert alert-danger">
        <ul>
            <li>
                {{session('message')}}
            </li>
        </ul>
    </div>
@endif
@if(session('success'))
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
        </button>
        <strong>Success!</strong> {{session('success')}}
    </div>
@endif
@if(session('error'))
    <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
        </button>
        <strong>Error!</strong> {!! session('error') !!}
    </div>
@endif

@if (count($errors) > 0)
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{!! $error !!}</li>
        @endforeach
    </ul>
</div>
@endif

