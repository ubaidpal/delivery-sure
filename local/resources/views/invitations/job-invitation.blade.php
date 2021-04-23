{{--

    * Created by   :  Muhammad Yasir
    * Project Name : demedat
    * Product Name : PhpStorm
    * Date         : 25-Jul-16 12:30 PM
    * File Name    : 

--}}
@if(count($drivers) > 0)
    <div class="popup-wrapper">
        {!! Form::open(['route'=>['send-job-invitation']]) !!}
        <div class="invited-person">
            <div class="col-md-9">
                <div class="row">
                    <div class="invited-name">{{$job->title}}</div>
                </div>
            </div>
        </div>
        {!! Form::hidden('job_id', encodeId($job->id,'favourite')) !!}
        <div class="col-md-12">
            <div class="select-orders">
                Select Orders to send an invite
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="jobs-list-wrapper">
            @if(count($drivers) > 0)
                @foreach($drivers as $driver)
                    <div class="single-job">
                        <div class="col-md-12">
                            <div class="check">
                                <input name="drivers[]" value="{{encodeId($driver->user->id,'favourite')}}" type="checkbox" id="">
                            </div>
                            <div class="tag-line">
                                <div class="col-md-3">
                                    <img src="{!! getImage($driver->user->profile_photo_url) !!}" alt="image">
                                </div>
                                <label for="group1 " class="">
                                    {{$driver->user->display_name}}
                                </label>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="single-job">
                    <div class="col-md-12">
                        No favorite driver found
                    </div>
                </div>
            @endif
        </div>
        <button type="submit" class="btn btn-green place">Send an invitation</button>
        {!! Form::close() !!}
    </div>
@else
    <div style="" class="popup-wrapper">
        <div class="instruction">You already sent invitation to all your favourite drivers</div>
    </div>
@endif
<style>
    .line-through {
        text-decoration: line-through;
    }
</style>
