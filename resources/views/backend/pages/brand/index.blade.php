@extends('layouts.app')
@section('title', $title)
@push('styles')

    <style>




    </style>

@endpush



@section('action')
    @can('role-create', Auth::user())
        <a href="{{ route('app.brands.create') }}" class="btn btn-sm btn-primary"><i class="fa fa-plus pr-2"></i> Add New</a>
    @endcan
@endsection

@section('content')

    <div class="row">

        <div class="col-12">
            <div class="ibox">
                <span class="alert-message mb-3"></span>
                <div class="ibox-head">
                    <div class="ibox-title"> {{ $title }} </div>

                </div>
                <div class="ibox-body px-0">
                    <table class="table table-sm" id="brand-datatables">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Image</th>
                                <th> Brand Name </th>
                                <th>Permission</th>
                                <th>Date</th>
                                <th>Operation</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>




@endsection




@push('scripts')

    <script>
        table = $('#brand-datatables').DataTable({
            processing: true,
            serverSide: true,
            order: [], //Initial no order
            bInfo: true, //TO show the total number of data
            bFilter: false, //For datatable default search box show/hide
            responsive: true,
            ordering: false,
            lengthMenu: [
                [5, 10, 15, 25, 50, 100, 1000, 10000, -1],
                [5, 10, 15, 25, 50, 100, 1000, 10000, "All"]
            ],
            pageLength: 25, //number of data show per page
            ajax: {
                url: "{{ route('app.brands.get-data') }}",
                type: "POST",
                dataType: "JSON",
                data: function(d) {
                    d._token = _token
                }
            },
            columns: [
                {data: 'id'},
                {data: 'image'},
                {data: 'name'},
                {data: 'status'},
                {data: 'created_at'},
                {data: 'operation'},
            ],
            language: {
                processing: '<img src="{{ asset("table-loading.svg") }}">',
                emptyTable: '<strong class="text-danger">No Data Found</strong>',
                infoEmpty: '',
                zeroRecords: '<strong class="text-danger">No Data Found</strong>',
                oPaginate: {
                    sPrevious: "Previous", // This is the link to the previous page
                    sNext: "Next", // This is the link to the next page
                },
                lengthMenu: "_MENU_"
            },
            dom: "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6' <'float-right pr-15'B>>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'<'float-right pr-15'p>>>",
            buttons: {
                buttons: [
                    {
                        text: '<i class="fa fa-refresh" aria-hidden="true"></i> Reload',
                        className: 'btn btn-sm btn-primary',
                        action: function (e, dt, node, config) {
                            dt.ajax.reload(null, false);
                        }
                    },
                    {
                        extend: 'pdf',
                        title: 'Role List',
                        filename: 'roles_{{ date("d-m-Y") }}',
                        text: '<i class="fa fa-file-pdf-o" aria-hidden="true"></i> PDF',
                        className: 'pdfButton btn btn-sm btn-primary',
                        orientation: "landscape",
                        pageSize: "A3",
                        exportOptions: {
                            columns: '0,1,2,3,4'
                        },
                        customize: function(doc) {
                            doc.defaultStyle.alignment = 'center';
                        }
                    },
                    {
                        extend: 'excel',
                        title: 'Role List',
                        filename: 'roles_{{ date("d-m-Y") }}',
                        text: '<i class="fa fa-file-excel-o" aria-hidden="true"></i> Excel',
                        className: 'excelButton btn btn-sm btn-primary',
                        exportOptions: {
                            columns: '0,1,2,3,4'
                        },
                    },
                    {
                        extend: 'print',
                        text: '<i class="fa fa-print" aria-hidden="true"></i> Print',
                        className: 'printButton btn btn-sm btn-primary',
                        orientation: "landscape",
                        pageSize: "A3",
                        exportOptions: {
                            columns: '0,1,2,3,4'
                        }
                    }
                ]
            }
        });

        $(document).on('click', '.deleteBtn', function(){
            let row_id = $(this).data('id');
            let url = "{{ route('app.brands.destroy') }}";
            datetable(row_id,url);
        });


        // status
        $(document).on('click','input.input-status',function(){
            var row_id = $(this).data('id');
            var url = "{{ route('app.brands.status') }}"
            if (this.checked) {
                var checked = 1;
            } else {
                var checked = 0;
            }

        $.ajax({
                type:"post",
                url:url,
                data:{_token:_token,row_id:row_id,status_id:checked},
                dataType:'json',
                success:function(response){
                if (response.status =='success') {
                    table.ajax.reload();
                        $('.alert-message').append('<div class="alert alert-success py-2">'+response.message+'</div>')
                    }

                }
            });
        });
    </script>

@endpush
