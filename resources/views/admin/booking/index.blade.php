@extends('admin.layouts.app')

@section('content')
    @if(Session::has('success'))
        <div class="alert alert-success">
            {{session('success')}}
        </div>
    @elseif(Session::has('error'))
        <div class="alert alert-danger">
            @foreach(session('error') as $val)
                <span>{{$val}}</span>
            @endforeach
        </div>
    @endif
	<div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                        <div class="table-responsive">
                            <table width="100%" class="display booking-applications-table">
                                <thead class=" text-primary">
                                    <tr>
                                        <th>дата заїзду, з</th>
                                        <th>дата виїзду, до</th>
                                        <th>статус</th>
                                        <th>прийняти/видалити бронювання</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                        </table>
                        </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        $(function () {
            var table = $('.booking-applications-table').DataTable({
                "fnInitComplete": function ( oSettings ) {
                    oSettings.oLanguage.sZeroRecords = "No matching records found"
                },
                columnDefs: [{
                    "defaultContent": "-",
                    "targets": "_all"
                }],
                processing: true,
                serverSide: true,
                order: [[ 1, "ASC" ]],
                ajax:{
                    url: "{{ route('admin.index') }}",
                    data: function (d){
                        d.search = $('input[type="search"]').val();
                    }
                },
                columns: [
                    {data: 'arrival_date', name: 'state_name_uk', orderable: true},
                    {data: 'departure_date', name: 'categories', orderable: true},
                    {data: 'status_name', name: 'description_ua', orderable: true},
                    {data: 'actions', name: 'actions', orderable: false, searchable: false},
                ]
            });
            $("#search").on("keydown", function(event) {
                if(event.which == 13)
                    table.draw();
            });
        });
    </script>
@endsection
