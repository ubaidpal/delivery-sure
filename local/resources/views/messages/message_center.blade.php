@extends('layouts.default')
@section('content')
    <!-- Sidebar right menue -->
    @include('includes.sidebar-right-menu')
    <!-- Message Center -->
    <div class="message-center autoheight">
        <div class="container">
            <div class="row">

                <!-- Message Left Menu -->
                <div class="message-left-menu col-md-4">
                    <ul class="list-group">
                        <li class="list-group-item">
                            <div class="message-thread-heading h3b">Message Centre</div>
                        </li><!-- /.list-group-item -->

                        <li class="list-group-item" id="search-form">
                            <div class="form-group">
                                <div class="input-group">
                                    <input type="text" class="form-control search-input" placeholder="Type Keyword Here..."
                                           id="search-input">

                                    <div class="input-group-btn">
                                        <button class="btn btn-default search-icon" type="submit"><i
                                                    class="glyphicon glyphicon-search"></i></button>
                                    </div>
                                </div><!-- /.input-group -->
                            </div>
                        </li><!-- /.list-group-item -->
                        <li class="list-group-item message-thread-container">
                            <ul class="message-thread-group">
                                @foreach($conversations as $row)
                                    <li data-id="{{$row['id']}}" data-url="{{url('messages/'.$user->id.'/'.$row['id'])}}"
                                        class="message-thread-item @if($conv_id == $row['id']) unread @endif conversation-head cursor-pointer" data-conv="{{$row['conv_for']}}">
                                        <div class="message-thread-close">
                                            <span>&times;</span>
                                        </div>
                                        <div class="message-thread-img">
                                            @if($row['conv_for'] == 'admin')
                                                <img src="{{asset('local/public/assets/images/delivery-sure.png')}}">
                                            @else
                                                <img src="{!! isset($row['participant']['profile_pic'])?$row['participant']['profile_pic']:'' !!}"
                                                     alt="{{isset($row['participant']['name']) ? $row['participant']['name']:''}}"
                                                     title="{{isset($row['participant']['name']) ? $row['participant']['name']:''}}">
                                            @endif
                                        </div><!-- /.message-thread-item -->
                                        <div class="message-thread-txt">
                                            <div class="message-thread-name" data-title="">
                                                @if($row['conv_for'] == 'admin')
                                                    Delivery Sure

                                                @elseif(isset($row['participant']['name']))
                                                    {{$row['participant']['name']}}
                                                @endif
                                            </div>
                                            <div class="message-thread-name"
                                                 data-title="{{isset($row['participant']['name']) ? $row['participant']['name']:''}}">
                                                {{$row['title']}}
                                            </div>
                                            <div class="message-thread-info">
                                                <div class="message-thread-shown">
                                                    @if($row['last_message'] != '?-empty-?')
                                                        <span>{!! $row['last_message'] !!}</span>
                                                    @endif
                                                </div>
                                                <div class="message-thread-time">
                                                    <span>{{\Carbon\Carbon::parse($row['time'])->diffForHumans()}}</span>
                                                </div>
                                            </div><!-- /.message-thread-info -->
                                        </div><!-- /.message-thread-txt -->
                                    </li><!-- /.message-threads-item -->
                                @endforeach


                            </ul><!-- /.message-threads-group -->
                        </li><!-- /.list-group-item -->
                    </ul><!-- /.list-group -->
                </div><!-- /.dashboard-left-main .col-md-4 -->


                <!-- Message Thread Content -->
                <div class="col-md-8">
                    <ul class="message-thread-content">
                        <li class="list-group-item">
                            <div class="message-thread-content-header">
                                <div class="message-thread-heading h3b">
                                    @if(!empty($first_conversation))
                                        <?php  $participant = $first_conversation->getTheOtherParticipant($user->id); ?>
                                        @if(isset($users[$participant]))
                                            <h4 class="message-thread-title">
                                                {{$first_conversation->getTitle()}}
                                                @if($first_conversation->getConvFor() == 'admin')
                                                    (Delivery Sure Admin)
                                                @endif
                                            </h4>
                                        @endif
                                    @endif
                                </div>
                                {{--<a class="btn btn-link" href="javascript:void(0);">Go to Job Application</a>--}}
                            </div><!-- /.message-thread-content-header -->
                        </li><!-- /.list-group-item -->

                        <li class="list-group-item">
                            <div>
                                <div>
                                    <!-- Web Messenger -->
                                    <ul class="web-messenger messengerheight" id="web-messenger">
                                        <!-- Messenger Msg - Left -->
                                        @if(!empty($messages) && count($messages)>0)
                                            @foreach($messages as $msg)
                                                @if($msg->getContent() != '?-empty-?')
                                                    @include('includes.messages-list',['msg'=>$msg])
                                                @endif
                                            @endforeach
                                        @else
                                            No message found!
                                        @endif
                                    </ul><!-- /.web-messenger -->
                                </div>
                            </div>

                        </li><!-- /.list-group-item -->

                        <li class="list-group-item" id="message-form-box @if(!empty($first_conversation) && $first_conversation->getConvFor() == 'admin') hide @endif">
                            <div class="messenger-type-msg">
                                {!! Form::open(['route' => ['message.store'], 'id' => 'msg-form','enctype'=>"multipart/form-data"]) !!}
                                <div class="form-group">
                                    @if(isset($conv_id))
                                        {!! Form::hidden('conv_id', Hashids::connection('message')->encode($conv_id),['class' => 'conv-id']) !!}
                                    @else
                                        {!! Form::hidden('receiver_id', Hashids::connection('message')->encode(10),['class' => 'receiver_id']) !!}
                                    @endif
 {!! Form::hidden('conv_type', (!empty($first_conversation)?$first_conversation->getConvFor():"")) !!}

                                    <input type="file" accept="" id="attachment" name="attachment"
                                           style="position: fixed; top: -30px;"/>
                                    <input type="text" class="form-control" name="body" placeholder="Type your message ..."
                                           id="message-body" @if(!empty($first_conversation) && $first_conversation->getConvFor() == 'admin')  @endif>
                                    <a class="btn btn-attachment" id="btn-attachment" href="javascript:void(0);"></a>
                                    <a class="btn send-msg" href="javascript:void(0);"><span
                                                class="glyphicon glyphicon-send"></span></a>
                                </div>
                                {!! Form::close() !!}
                            </div>
                        </li><!-- /.list-group-item -->
                    </ul><!-- /.message-thread-content -->


                </div><!-- /.dashboard-content -->
            </div><!-- /.row -->
        </div><!-- /.container -->
    </div><!-- /.Message Center -->

@stop
@section('footer-scripts')
    {!! HTML::script('local/public/assets/pages/messages.js') !!}
    <style>
        #web-messenger, .message-thread-group {
            overflow-y: auto;
            overflow-x: hidden;
        }

    </style>
@stop

