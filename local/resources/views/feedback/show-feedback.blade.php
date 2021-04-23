{{--

    * Created by   :  Muhammad Yasir
    * Project Name : demedat
    * Product Name : PhpStorm
    * Date         : 02-Jul-16 4:23 PM
    * File Name    : 

--}}
<div class="col-md-12">

    <h2>Feedback to Delivery driver</h2>
    @if(!empty($clientFeedback))
        <label>Your rating</label>

        <div class="clearfix"></div>
        <div class="feedback-rating" id="driver-rating"></div>
        <div class="clearfix" style="margin-bottom: 10px"></div>
        <div class="text-success" style="margin-bottom: 10px">{{$clientFeedback->feedback}}</div>
        <div class="modal-footer" style="padding: 0;"></div>
    @else
        No feedback
    @endif
    <h2>Feedback you received</h2>
    @if(!empty($myFeedback) && !empty($clientFeedback))

        <label>Rating</label>
        <div class="feedback-rating" id="my-rating"></div>
        <div class="clearfix" style="margin-bottom: 10px"></div>
        <div class="text-success" style="margin-bottom: 10px">{{$myFeedback->feedback}}</div>
    @else
        <div class="text-success" style="margin-bottom: 10px">
            You cannot view feedback you received until you give feedback
        </div>
        <a href="{{route('job-progress',[$order_id])}}" class="link">Click to check job progress</a>
    @endif

</div><!-- /.col-md-9 -->
@if(!empty($clientFeedback))
    <?php $feedback = $clientFeedback->rating  ?>
@else
    <?php $feedback = 0  ?>
@endif
@if(!empty($myFeedback))
    <?php $myFeedback = $myFeedback->rating  ?>
@else
    <?php $myFeedback = 0  ?>
@endif
<script>
    $(function () {
        $("#driver-rating").rateYo({
            rating: "{{$feedback}}",
            readOnly: true,
            spacing: '2px',
            height: '20px'
        });
        $("#my-rating").rateYo({
            rating: "{{$myFeedback}}",
            readOnly: true,
            spacing: '2px',
            height: '20px'
        });
        $("#feedback-rating").rateYo({
            rating: 0,
            fullStar: true,
            spacing: '2px',
            height: '20px'
        });
    });
</script>
