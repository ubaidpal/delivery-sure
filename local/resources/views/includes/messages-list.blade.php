{{--

    * Created by   :  Muhammad Yasir
    * Project Name : demedat
    * Product Name : PhpStorm
    * Date         : 28-Jun-16 10:30 AM
    * File Name    : 

--}}

<li class="@if($msg->getSender() == $user->id) messenger-msg-right @else messenger-msg-left @endif ">
    <div class="row">
        <div class="col-sm-7 @if($msg->getSender() == $user->id) col-sm-offset-5 @endif">

            @if(isset($users[$msg->getSender()]))
                <?php $cuser = $users[ $msg->getSender() ];?>
            @else
                <?php
                $cuser = \App\User::where('id', $msg->getSender())->with('album_photo.storage_file')->first();
                ?>
            @endif
            <div class="message-thread-img">
                @if($cuser->is('super.admin'))
                    <img src="{{asset('local/public/assets/images/delivery-sure.png')}}">
                @else

                    <img src="{!! getImage($cuser->profile_photo_url,'41x41') !!}"
                         alt="image">
                @endif
            </div><!-- /.message-thread-img -->

            <div class="messenger-msg-content">
                <div class="user-name">
                    @if($cuser->is('super.admin'))
                        Delivery Sure
                    @elseif($msg->getSender() != $user->id)
                        {{$users[$msg->getSender()]->display_name}}
                    @else
                        Me
                    @endif
                </div>
                <div class="p-relative">
                    <div class="messenger-msg-txt"
                         data-id="{{$msg->getId()}}">
                        {{$msg->getContent()}}
                        @if(!is_null($msg->getFile()))
                            <span class="attachment-icon"></span>
                            <div class="linkDownload">
                                <?php $file = get_photo_by_id($msg->getFile(), true, true);
                                //echo '<tt><pre>'; print_r($file); die;?>

                                @if(strpos($file->mime_type,'image') !== FALSE)
                                <a href="{{$file['url']}}" download="">
                                    <img src="{{$file['url']}}"
                                         width="50">
                                </a>
                                {{--@elseif(strpos($file->mime_type,'video') !== FALSE)

                                <video width="150" height="150"
                                       preload="none" controls>
                                    <source type="video/mp4"
                                            src="{{\Config::get( 'constants_activity.ATTACHMENT_VIDEO_URL_MOD').$file->storage_path}}">
                                </video>
                                @elseif(strpos($file->mime_type,'audio') !== FALSE)
                                <audio src="{{$msg['url']}}" controls>
                                    Your browser does not support the
                                    <code>audio</code>
                                    element.
                                </audio>
                                --}}
                                @endif
                                <span class="attachment-name">{{$file['name']}}</span>
                                <span class="attachment-url"><a
                                            href="{{$file['url']}}" download="">Download</a></span>
                            </div>

                            @endif
                    </div><!-- /.messenger-msg-txt -->

                    <ul class="messenger-msg-time">
                        {{getTimeByTZ($msg->getCreated(), 'M d | h:i a')}}
                    </ul><!-- /.messenger-msg-time -->
                </div>

            </div><!-- /.messenger-msg-content -->
        </div><!-- /.col-sm-7 -->
    </div><!-- /.row -->
</li>
