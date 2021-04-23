{{--

    * Created by   :  Muhammad Yasir
    * Project Name : demedat
    * Product Name : PhpStorm
    * Date         : 21-Jul-16 3:03 PM
    * File Name    : 

--}}

{{$data['message']}} <br>

<label>Jobs list</label>

<ul>
    @foreach($data['jobs'] as $job)
        <li>
            <?php
            $id = Hashids::connection('favourite')->decode($job)[0];
            $jobDetail = \App\Order::find($id);

            ?>
            <a href="{{route('order-detail',[encodeId($jobDetail->id,'orders')])}}">{{$jobDetail->title}}</a><br>
        </li>
    @endforeach
</ul>
