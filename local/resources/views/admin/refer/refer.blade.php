@extends('admin.layout.default')

@section('styles')
{!! HTML::style('local/public/assets/admin/css/plugins/morris.css') !!}

        <!-- Custom Fonts -->

{!! HTML::style('local/public/assets/admin/font-awesome/css/font-awesome.min.css') !!}
        <!-- Post Div-->
{!! HTML::style('local/public/assets/admin/css/responsiveTable.css') !!}
{!! HTML::style('local/public/assets/admin/css/dataTable.css') !!}
@stop
@section('content')
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Reference
                    </h1>

                </div>
            </div>

            <div class="row" style="margin-left: 1px;margin-bottom: 10px">
                <div id="no-more-tables">
                    <table id="report" class="col-md-12 table-bordered table-striped table-condensed cf">
                        <thead class="cf">
                        <tr>
                            <th>Refer</th>
                            <th>Refer To</th>
                            <th>Date</th>
                        </tr>
                        </thead>
                        <tbody>

                       @foreach($getReference as $reference)
                        <tr>
                            <td data-title="Refer">{{$reference->referrerId->display_name}}</td>
                            <td data-title="Refer To">{{$reference->referrerToId->display_name}}</td>
                            <td data-title="Date">{{$reference->created_at}}</td>

                        </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
                {!!  $getReference->render() !!}
            </div>

        </div>
    </div>


    {!! csrf_field() !!}

@stop
@section('scripts')


@stop



