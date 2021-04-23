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

            @foreach($getBusiness as $business)
                <tr>
                    <td data-title="Action"><input type="checkbox" value=""></td>
                    <td data-title="Refer">{{$business->display_name}}</td>
                    <td data-title="Email">{{$business->email}}</td>
                    <td data-title="Address">{{$business->address}}</td>
                    <td data-title="User">{{$business->user_type == 102 ? 'Retailer' : ''}}</td>
                    <td data-title="Gender">{{$business->gender == 1 ? 'Male' : 'Female'}}</td>
                    <td data-title="Date">{{$business->created_at}}</td>

                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    {!! $getBusiness->render() !!}
</div>
