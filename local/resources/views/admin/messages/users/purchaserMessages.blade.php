<div class="row" style="margin-left: 1px;margin-bottom: 10px">
    <div id="no-more-tables">
        <table id="report" class="col-md-12 table-bordered table-striped table-condensed cf">
            <thead class="cf">
            <tr>
                <th>Action</th>
                <th>Name</th>
                <th>Email</th>
                <th>Address</th>
                {{--<th>User</th>--}}
                <th>Gender</th>
                <th>Date</th>
            </tr>
            </thead>
            <tbody>

            @foreach($getPurchaser as $purchaser)
                <tr>
                    <td data-title="Action"><input type="checkbox" value="{{$purchaser->id}}" name="users[]"></td>
                    <td data-title="Refer">{{$purchaser->display_name}}</td>
                    <td data-title="Email">{{$purchaser->email}}</td>
                    <td data-title="Address">{{$purchaser->address}}</td>
                    {{--<td data-title="User">{{$purchaser->user_type == 100 ? 'Purchaser' : ''}}</td>--}}
                    <td data-title="Gender">{{$purchaser->gender == 1 ? 'Male' : 'Female'}}</td>
                    <td data-title="Date">{{$purchaser->created_at}}</td>

                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    {!! $getPurchaser->render() !!}
</div>
