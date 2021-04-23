{{--

    * Created by   :  Muhammad Yasir
    * Project Name : demedat
    * Product Name : PhpStorm
    * Date         : 15-Oct-16 5:02 PM
    * File Name    : 

--}}
@if(count($purchasers) > 0)
    <div class="popup-wrapper" style="min-height: 500px">
        @if(!empty($job))
            {!! Form::open(['route'=>['share.jobs']]) !!}
            {!! Form::hidden('drivers_id', NULL,['id' => 'purchasers_id']) !!}
            {!! Form::hidden('job_id', $job->id,['id' => 'purchasers_id']) !!}
            <div class="invited-person">
                <div class="col-md-9">
                    <div class="row">
                        <div class="invited-name">{{$job->title}}</div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                Select Drivers to share
            </div>
            <div class="clearfix"></div>
            <div id="ms-renderer"></div>
            <div class="clearfix"></div>
            <button class="btn btn-orange " type="submit" style="margin-top: 20px">Share</button>
        @else
            <div role="alert" class="alert alert-danger ">
                Order is deleted or archived by purchaser
            </div>
        @endif
    </div>
@else
    <div style="" class="popup-wrapper">
        <div class="instruction">Please place an order before sending an invitation</div>
        <a href="{{route('place-order')}}" class="btn btn-green place">Place your order</a>
    </div>
@endif
<script>
    $(function () {
        $.ajaxSetup({
            headers: {'X-CSRF-TOKEN': "{{csrf_token()}}"}
        });
        var ms = $('#ms-renderer').magicSuggest({
            renderer: function (data) {
                var file = data.country === 'France' ? 'fr.png' : 'us.png';
                var img = '{{url('photo')}}/' + data.profile_photo_url + '/61x61';
                return '<img class="i img-responsive" src="' + img + '"/>' + data.name + '</div>';
            },
            allowFreeEntries: false,
            data: '{{url('share/get-drivers')}}',
            ajaxConfig: {

                xhrFields: {
                    withCredentials: true
                }
            },
            selectionStacked: true,
            selectionPosition: 'bottom'
        });
        $(ms).on('selectionchange', function () {
            $('#purchasers_id').val(this.getValue());
        });

    })
</script>
<style>
    .line-through {
        text-decoration: line-through;
    }
</style>
