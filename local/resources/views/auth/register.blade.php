@extends('layouts.signup')

@section('content')
<div class="signup-wrapper"></div>
<div class="text-center">
	<div class="signup-box">
        @include('includes.register-form')
        </div>
</div>
    <script>
        $(function(){
            $('#user_type').change(function(){
                var userType = $(this).val();
                if(userType == 102){
                    $('#referral_id').show();
                }else{
                    $('#referral_id').hide();
                }
           }) ;
        });
    </script>
@endsection
