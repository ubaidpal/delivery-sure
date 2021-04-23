{{--

    * Created by   :  Muhammad Yasir
    * Project Name : demedat
    * Product Name : PhpStorm
    * Date         : 21-Jul-16 3:03 PM
    * File Name    : 

--}}
<?php //echo '<tt><pre>'; print_r($data); die;?>
{{$data['message']}} <br>

<label>Jobs list</label>

<ul>

    <li>
        <?php

        $jobDetail = \App\Order::find($data['job_id']);

        ?>
        <a href="{{route('order-detail',[encodeId($jobDetail->id,'orders')])}}">{{$jobDetail->title}}</a><br>
    </li>

</ul>
