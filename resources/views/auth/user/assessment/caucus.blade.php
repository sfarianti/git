@extends('layouts.app')
@section('title', 'Data Paper')
@push('css')
    <link
        href="https://cdn.datatables.net/v/bs5/jq-3.7.0/jszip-3.10.1/dt-2.1.8/b-3.1.2/b-colvis-3.1.2/b-html5-3.1.2/b-print-3.1.2/cr-2.0.4/date-1.5.4/fc-5.0.4/fh-4.0.1/kt-2.12.1/r-3.0.3/rg-1.5.0/rr-1.5.0/sc-2.4.3/sb-1.8.1/sp-2.3.3/sl-2.1.0/sr-1.4.1/datatables.min.css"
        rel="stylesheet">
    <style type="text/css">
        .step-one h1 {
            text-align: center;
        }

        .step-one img {
            width: 75%;
            height: 75%;
        }

        .step-one p {
            text-align: justify;
        }

        .active-link {
            color: #ffc004;
            background-color: #e81500;
        }

        #datatable-caucus {
            border-collapse: collapse;
            width: 100%;
        }

        #datatable-caucus th,
        #datatable-caucus td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }

        #datatable-caucus th {
            background-color: #f2f2f2;
        }

        #datatable-caucus {
            border: 1px solid #ddd;
        }

        th {
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
                            Caucus - Penilaian Inovasi
                        </h1>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main page content-->
    <div class="container-xl px-4 mt-4">
        {{-- Component Navigation Bar Assessment --}}
        @include('components.assessment.navbar')

        <div class="mb-3">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show mb-0" role="alert">
                    {{ session('success') }}

                    <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show mb-0" role="alert">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach

                    <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        </div>
        @include('auth.user.assessment.bar')
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-4 col-sm-8 col-xs-12">
                                Tabel Penilaian Caucus
                            </div>
                            <div class="col-md-8 col-sm-8 col-xs-12">
                                <div id="event-title">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        @if($data_event->isNotEmpty() && $data_event->first()?->id)
                            <div class="mb-3">
                                @livewire('assessment.caucus-team-total', ['eventId' => $data_event->first()->id])
                            </div>
                        @endif
                        <div class="mb-3">
                            <div class="row">
                                <div class="col-md-4 col-sm-4 col-xs-12">
                                    @if (Auth::user()->role == 'Superadmin' || Auth::user()->role == 'Admin' || Auth::user()->role == 'Juri' || $is_judge)
                                        <button class="btn btn-primary btn-sm" type="button" data-bs-toggle="modal"
                                            data-bs-target="#filterModal">Filter</button>
                                        {{-- <button class="btn btn-primary btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#filterCategoryModal">Filter Category</button> --}}
                                    @endif
                                </div>
                            </div>
                        </div>
                        <form id="datatable-card" action="{{ route('assessment.addBODvalue') }}" method="post">
                            @csrf
                            <div>
                                <table id="datatable-caucus" class="display"></table>
                                {{-- <button class="btn btn-primary" type="submit">submit</button> --}}
                            </div>
                            <input type="text" class="form-control" name="category" id="category-pa" hidden>
                            @if (Auth::user()->role == 'Admin' || Auth::user()->role == 'Superadmin')
                            <div class="d-flex mt-3 border-top pt-3">
                                <button type="submit" class="btn btn-primary next shadow-sm me-4">Kirim</button>
                                <button type="button" class="btn btn-outline-primary next shadow-sm"
                                    data-bs-toggle="modal" data-bs-target="#fixModalPA">Kirim Semua</button>
                            </div>
                            @endif
                        </form>
                    </div>
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
                                <option value="">Semua Kategori</option>
                                @foreach ($data_category as $category)
                                    <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                @endforeach
                            </select>
                            <label for="filter-category">Katgeori</label>
                        </div>

                        <!-- Filter Event -->
                        <div class="form-floating mb-4">
                            <select id="filter-event" name="filter-event" class="form-select" {{ Auth::user()->role == 'Superadmin' || Auth::user()->role == 'Admin' || Auth::user()->role === 'Juri' ? '' : 'disabled' }}>
                                @foreach ($data_event as $event)
                                    <option name="event_id" value="{{ $event->id }}"
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

        {{-- modal untuk executive summary --}}
        <div class="modal fade" id="executiveSummary" tabindex="-1" role="dialog"
            aria-labelledby="executiveSummaryTitle" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header border-0">
                        <h5 class="modal-title fw-bold" id="executiveSummaryTitle">Form Ringkasan Eksekutif</h5>
                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Tutup"></button>
                    </div>
                    <form id="formExecutiveSummary" method="POST" action="{{ route('assessment.summaryExecutive') }}">
                        @csrf
                        <input type="hidden" name="pvt_event_teams_id" id="inputEventTeamID" value="">
                        <div class="modal-body">
                            <!-- Nama Tim -->
                            <div class="form-floating mb-4">
                                <input type="text" name="" id="TeamName" class="form-control" value=""
                                    readonly>
                                <label for="TeamName">Tim</label>
                            </div>
                            <!-- Judul Inovasi -->
                            <div class="form-floating mb-4">
                                <textarea class="form-control" id="InnovationTitle" style="height: 80px" readonly></textarea>
                                <label for="InnovationTitle">Judul Inovasi</label>
                            </div>
                            <!-- Perusahaan -->
                            <div class="form-floating mb-4">
                                <input type="text" name="" id="Company" class="form-control" readonly>
                                <label for="Company">Perusahaan</label>
                            </div>
                            <!-- Latar Belakang Masalah -->
                            <div class="form-floating mb-4">
                                <textarea name="problem_background" id="inputProblemBackground" class="form-control" style="height: 80px"></textarea>
                                <label for="inputProblemBackground">Latar Belakang Masalah</label>
                            </div>
                            <!-- Ide Inovasi -->
                            <div class="form-floating mb-4">
                                <textarea name="innovation_idea" id="inputInnovationIdea" class="form-control" style="height: 80px"></textarea>
                                <label for="inputInnovationIdea">Ide Inovasi</label>
                            </div>
                            <!-- Manfaat -->
                            <div class="form-floating mb-4">
                                <textarea name="benefit" id="inputBenefit" class="form-control" style="height: 80px"></textarea>
                                <label for="inputBenefit">Manfaat</label>
                            </div>
                        </div>
                        <div class="modal-footer border-0">
                            <button class="btn btn-danger" type="button" data-bs-dismiss="modal">Tutup</button>
                            <button class="btn btn-primary" type="submit">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal Fix All Caucus -->
        <div class="modal fade" id="fixModalPA" tabindex="-1" role="dialog" aria-labelledby="rolbackTitle"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="title">Fiksasi Nilai Peserta Caucus</h5>
                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="form-fixall-pa" action="{{ route('assessment.fixSubmitAllCaucus') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="modal-body">
                            <div class="mb-3">
                                <input id="fix-all-caucus" name="event_id" type="text" hidden value="">
                                <p>Apakah anda yakin ingin memfiksasi semua penilaian peserta Caucus?</p>
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

        var dataTable = $('#datatable-caucus').DataTable({
            "processing": true,
            "serverSide": true,
            "responsive": true,
            "dom": 'lBfrtip',
            "buttons": [
                'excel', 'csv'
            ],
            "ajax": {
                "url": "{{ route('query.get_caucus') }}",
                "type": "GET",
                "async": false,
                "dataSrc": function (data) {
                    return data.data;
                },
                "data": function (d) {
                    d.filterEvent = $('#filter-event').val();
                    // d.filterYear = $('#filter-year').val();
                    d.filterCategory = $('#filter-category').val();
                }

            },
           "columns": columns.map(column => {
                    return {
                        ...column,
                        className: 'text-center' // Menambahkan kelas CSS
                    };
                }),
            "scrollY": true,
            "scrollX": true,
            "stateSave": true,
            "destroy": true
        });
        return dataTable;
    }

    function updateColumnDataTable() {
        const selectElement = document.getElementById('filter-event');
        const selectedOption = selectElement.options[selectElement.selectedIndex];
        const eventName = selectedOption.text;
        const eventId = selectedOption.value;
        document.getElementById('event-title').innerHTML = eventName;
        document.getElementById('fix-all-caucus').value = eventId;
        newColumn = []
        $.ajax({
            url: "{{ route('query.get_caucus') }}", // Misalnya, URL untuk mengambil kolom yang dinamis
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
        console.log("ini yang di fungsi update");
        console.log(newColumn);
        return newColumn
    }

    $(document).ready(function() {

        let column = updateColumnDataTable();

        let dataTable = initializeDataTable(column);

        $('#filter-event').on('change', function () {
            const selectedEventId = $(this).val();
            console.log("ðŸ”„ Emit eventChanged ke Livewire dengan ID:", selectedEventId);
            
            // Emit ke Livewire
            Livewire.emit('eventChanged', selectedEventId);
            
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

            document.getElementById('datatable-card').insertAdjacentHTML('afterbegin', `<table id="datatable-caucus"></table>`);

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
    function setSummary(team_id, pvt_event_teams_id){
        // console.log(team_id);
        var pvtEventTeamId;

        document.getElementById("TeamName").value = "";
        document.getElementById("InnovationTitle").value = "";
        document.getElementById("Company").value = "";
        document.getElementById("inputEventTeamID").value = "";
        document.getElementById("inputProblemBackground").value = "";
        document.getElementById("inputInnovationIdea").value = "";
        document.getElementById("inputBenefit").value = "";

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'GET',
            url: '{{ route('assessment.getSummary', ['team_id' => 'TEAM_ID', 'pvt_event_teams_id' => 'PVT_EVENT_TEAMS_ID']) }}'.replace('TEAM_ID', team_id).replace('PVT_EVENT_TEAMS_ID', pvt_event_teams_id),
            dataType: 'json',
            async: false,
            success: function(response) {
                document.getElementById("TeamName").value = response.team_name;
                document.getElementById("InnovationTitle").value = response.innovation_title;
                document.getElementById("Company").value = response.company_name;
                document.getElementById("inputEventTeamID").value = response.pvt_event_teams_id;
                document.getElementById("inputProblemBackground").value = response.problem_background;
                document.getElementById("inputInnovationIdea").value = response.innovation_idea;
                document.getElementById("inputBenefit").value = response.benefit;
                pvtEventTeamId = response.pvt_event_teams_id;
            },
            error: function(xhr, status, error) {
                console.error("Error fetching summary:", error);
            }
        });
    }

</script>
    @endpush
