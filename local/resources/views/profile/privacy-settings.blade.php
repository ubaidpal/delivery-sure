{{--

    * Created by   :  Muhammad Yasir
    * Project Name : demedat
    * Product Name : PhpStorm
    * Date         : 31-Oct-16 12:16 PM
    * File Name    : 

--}}
@extends('layouts.default')


@section('content')
    @include('includes.sidebar-right-menu')
    <div class="profile-setting autoheight">
        <div class="container">
            <div class="col-xs-12 nopadding">
                <div class="h2b pull-left">Privacy Settings</div>
                <div class="pull-right mt10 row">
                    <button type="submit" class="btn btn-green btn-block mw160">Update
                    </button>
                </div>
            </div><!-- /.col-xs-12 -->

            <div class="row">
                @include('includes.profile-sidebar')
                <div class="col-md-9 col-xs-12 nopadding">
                    <div class="edit-profile list-group list-group-item">
                        {!! Form::open(['route' => ['settings.save-privacy']]) !!}
                        <?php
                        $privacy = config('constant_privacy');

                        ?>
                        @foreach($privacy as $key =>  $row)
                            <div class="form-group">
                                <span class="text"><b>{{$row['TITLE']}}</b></span>
                                @foreach($row['OPTIONS'] as $index => $option)


                                    <?php
                                       // echo $index; die;

                                    ?>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="{{$key}}" value="{{$index}}" @if((isset($privacy_settings[$key]) && $privacy_settings[$key] == $index) || $index == 0) checked @endif>{{$option}}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                        <button type="submit" class="btn btn-green">Save</button>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection


