@extends('layouts.app')
@section('title', 'Presentasi - Portal Inovasi')
@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <link
        href="https://cdn.datatables.net/v/bs5/jq-3.7.0/jszip-3.10.1/dt-2.1.8/b-3.1.2/b-colvis-3.1.2/b-html5-3.1.2/b-print-3.1.2/cr-2.0.4/date-1.5.4/fc-5.0.4/fh-4.0.1/kt-2.12.1/r-3.0.3/rg-1.5.0/rr-1.5.0/sc-2.4.3/sb-1.8.1/sp-2.3.3/sl-2.1.0/sr-1.4.1/datatables.min.css"
        rel="stylesheet">

    <style type="text/css">
        .filter-container {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        #filter-status-inovasi {
            width: 160px;
            height: 45px;
            border: 1px solid #d6d8db;
            border-radius: 4px;
            padding: 8px 12px;
            background-color: #ffffff;
            color: #000000;
            font-size: 14px;
            transition: border-color 0.3s;
        }

        #filter-status-inovasi:focus {
            outline: none;
            border-color: #d6d8db;
        }

        .btn-red {
            background-color: #ffffff;
            color: #000000;
            border: 1px solid #d6d8db;
            border-radius: 4px;
            padding: 8px 16px;
            font-size: 14px;
            cursor: pointer;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            transition: background-color 0.3s, border-color 0.3s, box-shadow 0.3s;
        }

        .btn-red:hover {
            background-color: #f0f0f0;
            border-color: #d6d8db;
            color: #000000;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);
            /* Efek timbul lebih dalam saat hover */
        }

        .btn-red:focus {
            outline: none;
            /* Menghilangkan outline default */
        }

        th {
            text-align: center !important;
            text-transform: capitalize;
        }
    </style>
@endpush
@section('content')
    <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
        <div class="container-xl px-4">
            <div class="page-header-content">
                <div class="row align-items-center justify-content-between pt-3">
                    <div class="col-auto mb-3">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i data-feather="book"></i></div>
                            Presentation - Penilaian Inovasi
                        </h1>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Main page content-->
    <div class="container-xl px-4 mt-4">
        {{-- Component Navigation Bar Assessment --}}
        @include('auth.user.paper.navbar')

        <div class="mb-3">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show mb-0" role="alert">
                    {{ session('success') }}

                    <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if (session('errors'))
                <div class="alert alert-danger alert-dismissible fade show mb-0" role="alert">
                    {{ session('errors') }}

                    <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        </div>
        @include('auth.user.assessment.bar')
        <div class="card mb-4">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-4 col-sm-8 col-xs-12">
                        Tabel Penilaian Presentasi
                    </div>
                    <div class="col-md-8 col-sm-8 col-xs-12">
                        <div id="event-title">
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                @if($data_event->isNotEmpty())
                    <div class="mb-3">
                        @livewire('assessment.presentation-team-total', ['eventId' => $data_event->first()->id])
                    </div>
                @endif
                <div class="mb-3">
                    <div class="row">
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            @if (Auth::user()->role == 'Superadmin' || Auth::user()->role == 'Admin' || Auth::user()->role == 'Juri')
                                <button class="btn btn-primary btn-sm" type="button" data-bs-toggle="modal"
                                    data-bs-target="#filterModal">Filter</button>
                            @endif
                        </div>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                            <div id="event-title" class="h5 text-primary"></div>
                        </div>
                    </div>
                </div>
                <form id="datatable-card" action="{{ route('assessment.fix.pa') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <table id="datatable-competition" class="display"></table>
                    <hr>

                    <input type="text" class="form-control" name="category" id="category-pa" hidden>
                    @if (Auth::user()->role == 'Admin' || Auth::user()->role == 'Superadmin')
                        <div class="d-flex mt-2">
                            <button type="submit" class="btn btn-primary next shadow-sm me-4">Kirim</button>
                            <button type="button" class="btn btn-outline-primary next shadow-sm" data-bs-toggle="modal"
                                data-bs-target="#fixModalPA">Kirim Semua</button>
                        </div>
                    @endif
                </form>
            </div>
        </div>
    </div>

    {{-- modal untuk filter khusus admin dan juri --}}
    <div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="filterModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header border-0">
                    <h5 class="modal-title fw-bold" id="filterModalLabel">Pengaturan Filter</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <!-- Modal Body -->
                <div class="modal-body">
                    <!-- Filter Category -->
                    <div class="form-floating mb-4">
                        <select id="filter-category" name="filter-category" class="form-select">
                            <option value="" selected>Semua Kategori</option>
                            @foreach ($data_category as $category)
                                <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                            @endforeach
                        </select>
                        <label for="filter-category">Katgeori</label>
                    </div>

                    <!-- Filter Event -->
                    <div class="form-floating mb-4">
                        <select id="filter-event" name="filter-event" class="form-select">
                            @foreach ($data_event as $event)
                                <option value="{{ $event->id }}"
                                    {{ $event->company_code == Auth::user()->company_code ? 'selected' : '' }}>
                                    {{ $event->event_name }} - {{ $event->year }}
                                </option>
                            @endforeach
                        </select>
                        <label for="filter-event">Event</label>
                    </div>
                </div>
                <!-- Modal Footer -->
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>


    {{-- modal untuk fix all PA --}}
    <div class="modal fade" id="fixModalPA" tabindex="-1" role="dialog" aria-labelledby="rolbackTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="title">Fiksasi Nilai Peserta Penilaian Presentasi</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="form-fixall-pa" action="{{ route('assessment.fix.pa') }}" method="POSt">
                    @csrf
                    @method('PUT')

                    <div class="modal-body">
                        <div class="mb-3">
                            <input id="fix-all-pa" name="event_id" type="text" hidden>
                            <p>Apakah anda yakin ingin memfiksasi semua penilaian peserta Presentasi?</p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Tutup</button>
                        <button class="btn btn-primary" type="submit" data-bs-dismiss="modal">Fiksasi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@push('js')
    <script
        src="https://cdn.datatables.net/v/bs5/jq-3.7.0/jszip-3.10.1/dt-2.1.8/b-3.1.2/b-colvis-3.1.2/b-html5-3.1.2/b-print-3.1.2/cr-2.0.4/date-1.5.4/fc-5.0.4/fh-4.0.1/kt-2.12.1/r-3.0.3/rg-1.5.0/rr-1.5.0/sc-2.4.3/sb-1.8.1/sp-2.3.3/sl-2.1.0/sr-1.4.1/datatables.min.js">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>

    <script type="">

        function initializeDataTable(columns) {
            var dataTable = $('#datatable-competition').DataTable({
                "processing": true,
                "serverSide": true,
                "dom": 'lBfrtip',
                "buttons": [
                    'excel', 'csv'
                ],
                "ajax": {
                    "url": "{{ route('query.get_pa_assessment') }}",
                    "type": "GET",
                    "async": false,
                    "dataSrc": function (data) {
                        // console.log(columns);
                        // console.log(data.data);
                        return data.data;
                    },
                    "data": function (d) {
                        d.filterEvent = $('#filter-event').val();
                        // d.filterYear = $('#filter-year').val();
                        d.filterCategory = $('#filter-category').val();
                    }
                },
                "columns": columns,
                "scrollY": true,
                "scrollX": true,
                "stateSave": true,
                "destroy": true,
                "createdRow": function(row, data, dataIndex) {
                    $('thead th').each(function(index) {
                        if ($(this).text().trim() === 'Urutan') {
                            $(row).find('td:nth-child(' + (index + 1) + ')').addClass('text-center'); // Set text center untuk <td>
                        }
                    });
                }
            });
            return dataTable;
        }

        function updateColumnDataTable() {
        const selectElement = document.getElementById('filter-event');
        const selectedOption = selectElement.options[selectElement.selectedIndex];
        const eventName = selectedOption.text;
        document.getElementById('event-title').innerHTML = eventName;
            newColumn = []
            $.ajax({
                url: "{{ route('query.get_pa_assessment') }}", // Misalnya, URL untuk mengambil kolom yang dinamis
                method: 'GET',
                // dataType: 'json',
                data:{
                    filterEvent: $('#filter-event').val(),
                    // filterYear: $('#filter-year').val(),
                    filterCategory: $('#filter-category').val()
                },
                async: false,
                success: function (data) {
                    if(data.data.length){
                        let row_column = {};
                        row_column['data'] = "DT_RowIndex"
                        row_column['title'] = "No"
                        row_column['mData'] = "DT_RowIndex"
                        row_column['sTitle'] = "No"
                        newColumn.push(row_column)
                        for( var key in data.data[0]){
                            if(key != "DT_RowIndex"){
                                let row_column = {};
                                row_column['data'] = key
                                row_column['title'] = key
                                row_column['mData'] = key
                                row_column['sTitle'] = key
                                newColumn.push(row_column)
                            }
                        }
                    }else{
                        let row_column = {};
                        row_column['data'] = ''
                        row_column['title'] = ''
                        row_column['mData'] = ''
                        row_column['sTitle'] = ''
                        newColumn.push(row_column)
                    }
                },
                error: function (xhr, status, error) {
                    console.error('Gagal mengambil kolom: ' + error);
                }
            });
            return newColumn
        }

        $(document).ready(function() {

            let column = updateColumnDataTable();

            let dataTable = initializeDataTable(column);

            $("#category-pa").val($(`#filter-category`).val())
            $('#fix-all-pa').val($(`#filter-event`).val())

            $('#filter-event').on('change', function () {
                const selectedEventId = $(this).val();
                console.log("ðŸ”„ Emit eventChanged ke Livewire dengan ID:", selectedEventId);
            
                // Emit ke Livewire
                Livewire.emit('eventChanged', selectedEventId);
            
                // Update hidden input dan datatable
                $('#fix-all-pa').val(selectedEventId);
            
                // Reset DataTable
                if (dataTable) {
                    dataTable.destroy();
                }
            
                $('#datatable-competition').remove(); // hapus tabel lama
                $('#datatable-card').prepend('<table id="datatable-competition"></table>');
            
                column = updateColumnDataTable();
                dataTable = initializeDataTable(column);
            });
            
            $('#filter-category').on('change', function () {
                dataTable.destroy();
                dataTable.destroy();

                document.getElementById('datatable-card').insertAdjacentHTML('afterbegin', `<table id="datatable-competition"></table>`);
                $("#category-pa").val($(`#filter-category`).val())

                column = updateColumnDataTable();
                dataTable = initializeDataTable(column);
            });
        });

        function change_url(id, elementid) {
            //link untuk update
            var form = document.getElementById(elementid);
            var url = `{{ route('paper.rollback', ['id' => ':id']) }}`;
            url = url.replace(':id', id);
            form.action = url;

        }
    </script>
@endpush
