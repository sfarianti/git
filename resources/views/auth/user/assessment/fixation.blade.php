@extends('layouts.app')
@section('title', 'Data Paper')
@push('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
<style type="text/css">
    .step-one h1 {
        text-align: center;
    }
    .step-one img{
        width: 75%;
        height: 75%;
    }
    .step-one p{
        text-align: justify;
    }
    .active-link {
        color: #ffc004;
        background-color: #e81500;
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
                        Data Paper - Innovation Paper
                    </h1>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Main page content-->
<div class="container-xl px-4 mt-4">
@include('auth.user.paper.navbar')
<div class="mb-3">
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show mb-0" role="alert">
        {{ session('success') }}

        <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
</div>
@include('auth.user.assessment.bar')
<div class="sbp-preview-code">
    
    <ul class="nav nav-tabs" id="navBordersVerticalTabs" role="tablist">
        @if (Auth::user()->role == 'Superadmin' || Auth::user()->role == 'Admin')
        <li class="nav-item bg-white">
            <a class="nav-link active me-1" id="ODA_tab" data-bs-toggle="tab" href="#nav_ODA_tab" role="tab" aria-controls="navBordersVerticalHtml" aria-selected="true">
                <i class="me-1"></i>
                On Desk Assessment
            </a>
        </li>
        @endif
        @if (Auth::user()->role == 'Superadmin' || Auth::user()->role == 'Admin')
        <li class="nav-item bg-white">
            <a class="nav-link" id="PA_tab" data-bs-toggle="tab" href="#nav_PA_tab" role="tab" aria-controls="navBordersVerticalPug" aria-selected="false">
                <img class=" me-1"/>
                Presentation Assessment
            </a>
        </li>
        @endif
        {{-- @if (Auth::user()->role == 'Superadmin' || Auth::user()->role == 'Admin')
        <li class="nav-item bg-white">
            <a class="nav-link" id="eligible_tab" data-bs-toggle="tab" href="#nav_eligible_tab" role="tab" aria-controls="navBordersVerticalPug" aria-selected="false">
                <img class=" me-1"/>
                Eligible
            </a>
        </li>
        @endif --}}
       
    </ul>
    <div class="card mb-4 mt-2">
        <div class="card-body">
            <div class="mb-3">
                <!-- Code sample-->
                <div class="tab-content">
                    <div class="tab-pane active" id="nav_ODA_tab" role="tabpanel" aria-labelledby="nav_ODA_tab">
                        <div class="mb-3">
                            <button class="btn btn-primary btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#filterModalODA">Filter On Desk</button>
                        </div>
                        <div class="mb-3">
                            <form id="div-datatable-oda" action="{{ route('assessment.fix.oda') }}" method="POST">
                                @csrf
                                @method('PUT')
                                <table id="datatable-oda"></table>
                                <input type="text" class="form-control" name="category" id="category-oda" hidden>
                                <!-- <button type="submit" class="btn btn-primary">submit</button> -->
                            </form>
                        </div>
                        <div class="mb-3">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#fixModalODA">fix all</button>
                        </div> 
                    </div>
                    <div class="tab-pane" id="nav_PA_tab" role="tabpanel" aria-labelledby="nav_PA_tab">
                        <div class="mb-3">
                            <button class="btn btn-primary btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#filterModalPA">Filter Presentation</button>
                        </div>
                        <div class="mb-3">
                            <form id="div-datatable-pa" action="{{ route('assessment.fix.pa') }}" method="POST">
                                @csrf
                                @method('PUT')
                                <table id="datatable-pa"></table>
                                <input type="text" class="form-control" name="category" id="category-pa" hidden>
                                <!-- <button type="submit" class="btn btn-primary">submit</button> -->
                            </form>
                        </div>
                        <div class="mb-3">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#fixModalPA">fix all</button>
                        </div>    
                    </div>
                    {{-- <div class="tab-pane" id="nav_eligible_tab" role="tabpanel" aria-labelledby="nav_eligible_tab">
                        <div class="mb-3">
                            <button class="btn btn-primary btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#filterModalEligible">Filter Eligible</button>
                        </div>
                        <form id="div-datatable-eligible" action="{{ route('assessment.fix.eligible') }}" method="POST">
                            @csrf
                            @method('PUT')
                            <table id="datatable-eligible"></table>
                            <input type="text" class="form-control" name="category" id="category-eligible" hidden>
                            <button type="submit" class="btn btn-primary">submit</button>
                        </form>
                    </div>
                    <div class="tab-pane" id="nav_Caucus_tab" role="tabpanel" aria-labelledby="nav_Caucus_tab">
                        <div class="mb-3">
                            <button class="btn btn-primary btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#filterModalCaucus">Filter Caucus</button>
                        </div>
                        <form id="div-datatable-caucus" action="{{ route('assessment.caucus') }}" method="POST">
                            @csrf
                            @method('PUT')
                            <table id="datatable-caucus"></table>
                            <input type="text" class="form-control" name="category" id="category-caucus" hidden>
                            <button class="btn btn-primary" type="submit">submit</button>
                        </form>
                    </div> --}}
                    
                </div>
            </div> 
        </div>
    </div>
</div>
</div>

{{-- modal untuk filter On Desk --}}
<div class="modal fade" id="filterModalODA" role="dialog" aria-labelledby="detailTeamMemberTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailTeamMemberTitle">Filter</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="mb-1" for="filter-category-oda">Category</label>
                    <select id="filter-category-oda" name="filter-category" class="form-select">
                        @foreach($data_category as $category)
                        <option value="{{ $category->id }}" > {{ $category->category_name }} </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label class="mb-1" for="filter-event-oda">Event</label>
                    <select id="filter-event-oda" name="filter-event" class="form-select" {{ Auth::user()->role == 'Superadmin' ? '' : 'disabled'}}>
                        @foreach($data_event as $event)
                        <option value="{{ $event->id }}" {{ $event->company_code == Auth::user()->company_code ? 'selected' : '' }}> {{ $event->event_name }} - {{ $event->year}} </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

{{-- modal untuk filter Presentation --}}
<div class="modal fade" id="filterModalPA" role="dialog" aria-labelledby="detailTeamMemberTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailTeamMemberTitle">Filter</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="mb-1" for="filter-category-pa">Category</label>
                    <select id="filter-category-pa" name="filter-category" class="form-select">
                        @foreach($data_category as $category)
                        <option value="{{ $category->id }}" > {{ $category->category_name }} </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label class="mb-1" for="filter-event-pa">Event</label>
                    <select id="filter-event-pa" name="filter-event" class="form-select" {{ Auth::user()->role == 'Superadmin' ? '' : 'disabled'}}>
                        @foreach($data_event as $event)
                        <option value="{{ $event->id }}" {{ $event->company_code == Auth::user()->company_code ? 'selected' : '' }}> {{ $event->event_name }} - {{ $event->year}} </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

{{-- modal untuk filter Eligible --}}
{{-- <div class="modal fade" id="filterModalEligible" role="dialog" aria-labelledby="detailTeamMemberTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailTeamMemberTitle">Filter</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="mb-1" for="filter-category-eligible">Category</label>
                    <select id="filter-category-eligible" name="filter-category" class="form-select">
                        @foreach($data_category as $category)
                        <option value="{{ $category->id }}" > {{ $category->category_name }} </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label class="mb-1" for="filter-event-eligible">Event</label>
                    <select id="filter-event-eligible" name="filter-event" class="form-select" {{ Auth::user()->role == 'Superadmin' ? '' : 'disabled'}}>
                        @foreach($data_event as $event)
                        <option value="{{ $event->id }}" {{ $event->company_code == Auth::user()->company_code ? 'selected' : '' }}> {{ $event->event_name }} - {{ $event->year}} </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div> --}}

{{-- modal untuk fix all ODA --}}
<div class="modal fade" id="fixModalODA" tabindex="-1" role="dialog" aria-labelledby="rolbackTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="title">Fix all On Desk Participant</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="form-fixall-oda" action="{{ route('assessment.fix.oda') }}" method="POSt">
                @csrf
                @method('PUT')
                            
                <div class="modal-body">
                    <div class="mb-3">
                        <input id="fix-all-oda" name="event_id" type="text" hidden>
                        <p>Apakah anda yakin ingin memfiksasi semua penilaian peserta On Desk?</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-primary" type="submit" data-bs-dismiss="modal">Submit</button>
                </div>
            </form> 
        </div>
    </div>
</div>

{{-- modal untuk fix all PA --}}
<div class="modal fade" id="fixModalPA" tabindex="-1" role="dialog" aria-labelledby="rolbackTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="title">Fix all Presentation Participant</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="form-fixall-pa" action="{{ route('assessment.fix.pa') }}" method="POSt">
                @csrf
                @method('PUT')
                            
                <div class="modal-body">
                    <div class="mb-3">
                        <input id="fix-all-pa" name="event_id" type="text" hidden>
                        <p>Apakah anda yakin ingin memfiksasi semua penilaian peserta Presentasi?</p>

                        <p>masukkan jumlah tim yang akan masuk ke tahap Caucus</p>
                        <input type="number" name="total_team" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-primary" type="submit" data-bs-dismiss="modal">Submit</button>
                </div>
            </form> 
        </div>
    </div>
</div>

@endsection

@push('js')
{{-- <script src="https://cdn.ckeditor.com/ckeditor5/39.0.2/classic/ckeditor.js"></script> --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script type="">

    function initializeDataTable(columns, status, id) {
        var dataTable = $(`#datatable-${id}`).DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "{{ route('query.get_fix_assessment') }}",
                "type": "GET",
                "async": false,
                "dataSrc": function (data) {
                    // console.log(columns);
                    // console.log(data.data);
                    return data.data;
                },
                "data": function (d) {
                    d.filterEvent = $(`#filter-event-${id}`).val();
                    d.filterStatus = status;
                    d.filterCategory = $(`#filter-category-${id}`).val();
                }
            },
            "columns": columns,
            "scrollY": true,
            "scrollX": false,
            "stateSave": true,
            "destroy": true
        });
        return dataTable;
    }

    function updateColumnDataTable(status, id) {
        newColumn = []
        $.ajax({
            url: "{{ route('query.get_fix_assessment') }}", // Misalnya, URL untuk mengambil kolom yang dinamis
            method: 'GET',
            // dataType: 'json',
            data:{
                filterEvent: $(`#filter-event-${id}`).val(),
                filterStatus: status,
                filterCategory: $(`#filter-category-${id}`).val()
            },
            async: false,
            success: function (data) {
                // newColumn = []
                console.log(data.data)
                // console.log(count(data.data));
                if(data.data.length){
                    for( var key in data.data[0]){
                        let row_column = {};
                        row_column['data'] = key
                        row_column['title'] = key
                        row_column['mData'] = key
                        row_column['sTitle'] = key
                        newColumn.push(row_column)
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
        // console.log("ini yang di fungsi update");
        // console.log(newColumn);
        return newColumn
    }
    let arr_datatable = [];

    function make_table(status, id){
        document.getElementById(`div-datatable-${id}`).insertAdjacentHTML('afterbegin', `<table id="datatable-${id}"></table>`);
        let column = updateColumnDataTable(status, id);
        arr_datatable[id] = initializeDataTable(column, status, id);
    }

    function destroy_table(id){
        arr_datatable[id].destroy();
        arr_datatable[id].destroy();
    }

    $(document).ready(function() {
        make_table(['On Desk'], 'oda')
        make_table(['Presentation'], 'pa')
        // make_table(['Lolos Presentation'], 'eligible')
        // make_table(['Caucus'], 'caucus')
        // make_table(['tidak lolos On Desk', 'tidak lolos Presentation'], 'result')

        $("#category-oda").val($(`#filter-category-oda`).val())
        $('#fix-all-oda').val($(`#filter-event-oda`).val())
        $("#category-pa").val($(`#filter-category-pa`).val())
        $('#fix-all-pa').val($(`#filter-event-pa`).val())
        
        $('#filter-event-oda').on('change', function () {
            destroy_table('oda')

            make_table(['On Desk'], 'oda')

            $('#fix-all-oda').val($(`#filter-event-oda`).val())
        });
        $('#filter-category-oda').on('change', function () {
            destroy_table('oda')

            make_table(['On Desk'], 'oda')

            $("#category-oda").val($(`#filter-category-oda`).val())
        });

        $('#filter-event-pa').on('change', function () {
            destroy_table('pa')

            make_table(['Presentation'], 'pa')

            $('#fix-all-pa').val($(`#filter-event-pa`).val())
        });
        $('#filter-category-pa').on('change', function () {
            destroy_table('pa')

            make_table(['Presentation'], 'pa')

            $("#category-oda").val($(`#filter-category-pa`).val())
        });

        // $('#filter-event-eligible').on('change', function () {
        //     destroy_table('eligible')

        //     make_table(['Lolos Presentation'], 'eligible')
        // });
        // $('#filter-category-eligible').on('change', function () {
        //     destroy_table('eligible')

        //     make_table(['Lolos Presentation'], 'eligible')
        //     $("#category-oda").val($(`#filter-category-eligible`).val())
        // });

        // $('#filter-event-caucus').on('change', function () {
        //     destroy_table('caucus')

        //     make_table(['Caucus'], 'caucus')
        // });
        // $('#filter-category-caucus').on('change', function () {
        //     destroy_table('caucus')

        //     make_table(['Caucus'], 'caucus')
        //     $("#category-oda").val($(`#filter-category-caucus`).val())
        // });

        // $('#filter-event-result').on('change', function () {
        //     destroy_table('result')

        //     make_table(['tidak lolos On Desk', 'tidak lolos Presentation'], 'result')
        // });
        // $('#filter-category-result').on('change', function () {
        //     destroy_table('result')

        //     make_table(['tidak lolos On Desk', 'tidak lolos Presentation'], 'result')
        // });
    });

    function change_url(id, elementid) {
        //link untuk update
        var form = document.getElementById(elementid);
        var url = `{{ route('paper.rollback', ['id' => ':id']) }}`;
        url = url.replace(':id', id);
        form.action = url;

    }
    function setSummary(team_id){
        console.log(team_id);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'GET',
            url: '{{ route('query.custom') }}',
            dataType: 'json',
            data: {
                table: "teams",
                where: {
                    "teams.id": team_id
                },
                limit: 1,
                join: {
                        'papers':{
                            'papers.team_id': 'teams.id'
                        },
                        'categories':{
                            'categories.id': 'teams.category_id'
                        },
                        'themes':{
                            'themes.id': 'teams.theme_id'
                        },
                        'companies':{
                            'companies.company_code' : 'teams.company_code'
                        },
                        'pvt_event_teams':{
                            'pvt_event_teams.team_id' : 'teams.id'
                        }
                    },
                select:[
                        'teams.id as team_id',
                        'innovation_title',
                        'team_name',
                        'company_name',
                        'pvt_event_teams.id as pvt_event_teams_id'
                    ]
            },
            // dataType: 'json',
            success: function(response) {
                console.log(response)
                document.getElementById("TeamName").value = response[0].team_name;
                document.getElementById("InnovationTitle").value = response[0].innovation_title;
                document.getElementById("Company").value = response[0].company_name;
                document.getElementById("inputEventTeamID").value = response[0].pvt_event_teams_id;              
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }
</script>
@endpush
