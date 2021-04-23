@extends('layouts.landing')

@section('content')
   	<div class="video-wrapper">
        <video width="100%" autoplay loop>
          <source src="{!! asset('local/public/assets/video/welcome-video.mp4') !!}" type="video/mp4">
        </video>
    </div>
@endsection
@section('footer-content')
    @if(env('ACCESS_ENABLED'))
        @if(!\Session::get('accessGranted'))
            <script type="text/javascript">
                $(window).load(function () {
                    $('#access-token').modal('show');
                });
            </script>
        @endif
    @endif
@stop
