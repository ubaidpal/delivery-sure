<div class="row" style="margin-left: 1px;margin-bottom: 10px">
    <div id="no-more-tables">
        <table id="report" class="col-md-12 table-bordered table-striped table-condensed cf">
            <thead class="cf">
            <tr>
                <th>Action</th>
                <th>Name</th>
                <th>Email</th>
                <th>Address</th>
                <th>User</th>
                <th>Gender</th>
                <th>Date</th>
            </tr>
            </thead>
            <tbody>

            @foreach($getDelivery as $delivery)
                <tr>
                    <td data-title="Action"><input type="checkbox" value=""></td>
                    <td data-title="Refer">{{$delivery->display_name}}</td>
                    <td data-title="Email">{{$delivery->email}}</td>
                    <td data-title="Address">{{$delivery->address}}</td>
                    <td data-title="User">{{$delivery->user_type == 101 ? 'Driver' : ''}}</td>
                    <td data-title="Gender">{{$delivery->gender == 1 ? 'Male' : 'Female'}}</td>
                    <td data-title="Date">{{$delivery->created_at}}</td>

                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    {!! $getDelivery->render() !!}
</div>
