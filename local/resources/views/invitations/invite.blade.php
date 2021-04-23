{{--

    * Created by   :  Muhammad Yasir
    * Project Name : demedat
    * Product Name : PhpStorm
    * Date         : 20-Jul-16 3:27 PM
    * File Name    : 

--}}
@if(count($jobs) > 0)
    <div class="popup-wrapper">
        {!! Form::open(['route'=>['send-invitation']]) !!}
        <div class="invited-person">
            <div class="col-md-3">
                <img src="{!! getImage($driver->profile_photo_url) !!}" alt="image">
            </div>
            <div class="col-md-9">
                <div class="row">
                    <div class="invited-name">{{$driver->display_name}}</div>
                </div>
            </div>
        </div>
        {!! Form::hidden('driver_id', encodeId($driver->id,'favourite')) !!}
        <div class="col-md-12">
            <div class="select-orders">
                Select Orders to send an invite
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="jobs-list-wrapper">
            @foreach($jobs as $job)
                <div class="single-job">
                    <div class="col-md-12">
                        <div class="check">
                            @if(!in_array($job->id,$invitedDrivers))
                                <input name="jobs[]" value="{{encodeId($job->id,'favourite')}}" type="checkbox" id="">
                            @endif
                        </div>
                        <div class="tag-line">
                            <label for="group1 " class="@if(in_array($job->id,$invitedDrivers)) line-through @endif">
                                {{$job->title}}
                            </label>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <button type="submit" class="btn btn-green place">Send an invitation</button>
        {!! Form::close() !!}
    </div>
@else
    <div style="" class="popup-wrapper">
        <div class="instruction">Please place an order before sending an invitation</div>
        <a href="{{route('place-order')}}" class="btn btn-green place">Place your order</a>
    </div>
@endif
<style>
    .line-through {
        text-decoration: line-through;
    }
</style>
