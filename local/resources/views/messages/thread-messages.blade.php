{{--

    * Created by   :  Muhammad Yasir
    * Project Name : demedat
    * Product Name : PhpStorm
    * Date         : 28-Jun-16 10:34 AM
    * File Name    : 

--}}
<?php
$userForChat = '';
if($conv_type == 'couple') {
    $userForChat = array_diff($users_id, [Auth::user()->id]);
    $userForChat = implode(',', $userForChat);
}
?>
@if(isset($messages))
    <?php $current_sender = 0;?>
    @foreach($messages as $row)
        <?php
        if($current_sender == 0 || $current_sender != $row->getSender()) {
            $current_sender = $row->getSender();
        }
        ?>
        @if($row->getContent() != '?-empty-?')
            @include('includes.messages-list',['msg' => $row])
        @endif

    @endforeach
@else
    There is no message

@endif

@if(empty($repeat))
    <script type="text/javascript">
        $(function () {
            $('.conv-id').val('{{Hashids::connection('message')->encode($conv_id)}}');
        });
    </script>
@endif
