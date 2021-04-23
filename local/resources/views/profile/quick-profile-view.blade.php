{{--

    * Created by   :  Muhammad Yasir
    * Project Name : demedat
    * Product Name : PhpStorm
    * Date         : 23-Jul-16 4:29 PM
    * File Name    : 

--}}
<div class="drivers-list" style="margin-top: 70px">
    <div class="col-md-6">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-2">
                    <div class="row">
                        <a href="{{route('profile',[encodeId($driver['id'],'favourite')])}}">
                            <img src="{{getImage($driver['profile_photo_url'])}}"
                                 alt="image">
                        </a>
                    </div>
                </div>
                <div class="col-md-10">
                    <div class="profile-wrapper">
                        <div class="name_l">
                            <div class="userName">
                                <a href="{{route('profile',[encodeId($driver['id'],'favourite')])}}">
                                    <h2>{{$driver['display_name']}}</h2>
                                </a>

                                <div class="location">
                                    <a data-toggle="modal"
                                       data-target="#quick-view-modal"
                                       href="{{route('quick-view.driver',[encodeId($driver['id'],'favourite')])}}"
                                       id="quick-view-{{$driver['id']}}"> <span
                                                class="glyphicon glyphicon-map-marker"></span></a>

                                    {{$driver['address']}}
                                </div>
                            </div>
                        </div>
                        {{--<div class="description">
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores,
                                fuga
                                repellat! <a href="#">more</a></p>
                        </div>--}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="date-box">
            <div id="rating" data-rating="{{$driver['rating']}}"></div>
            ({{getReviewCount($driver[ 'id' ])}} Reviews)
        </div>
        <div class="progress-wrapper">
            <?php $getJobSuccess = getJobSuccess($driver['rating'],$driver[ 'id' ]);?>
            @if(isset($getJobSuccess['status']) && $getJobSuccess['status'] == 1)
                {{$getJobSuccess['message']}}
            @else
                <div class="text">{{$getJobSuccess}}% job success</div>
                <div class="bar-box">
                    <div class="bar" style="width:{{$getJobSuccess}}%;"></div>
                </div>
            @endif
        </div>
    </div>
    <div class="col-md-3">
        <div class="addFav">
            <i class="fa fa-heart" aria-hidden="true"></i>
            @if(!empty($favourite))
                Added to favorites
                <a href="#" data-id="{{encodeId($driver['id'],'favourite')}}" data-type="remove">Remove</a>
            @else
                <a href="#" data-id="{{encodeId($driver['id'],'favourite')}}" data-type="add">Add to
                    favorites</a>
            @endif
        </div>
        <div class="clearfix"></div>
        <a class="btn btn-orange btn-block" href="{{route('invite',[encodeId($driver['id'],'favourite')])}}"
           data-toggle="modal"
           data-target="#invitation" id="invitation-btn">Invite to Job</a>
    </div>
</div>
{!! HTML::script('local/public/assets/pages/favourite.js') !!}
<script>
    var rating = $('#rating').data('rating');
    $('#rating').rateYo({
        rating: rating,
        readOnly: true,
        spacing: '2px',
        height: '20px'
    });
    $('#invitation-btn').click(function(){
        $('#quick-view-modal').modal('hide');
    })
</script>
