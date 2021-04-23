{{--

    * Created by   :  Muhammad Yasir
    * Project Name : demedat
    * Product Name : PhpStorm
    * Date         : 01-Jul-16 4:30 PM
    * File Name    : 

--}}
You received a message from {{ $data['name'] }}:

<p>
    Name: {{ $data['name'] }}
</p>

<p>
   Email: {{ $data['from'] }}
</p>
<p>
    Phone: {{ $data['phone_number'] }}
</p>
<p>
    <b>Message: </b>{{ $data['message'] }}
</p>
