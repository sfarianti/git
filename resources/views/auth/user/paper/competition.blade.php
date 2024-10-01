@extends('layouts.app')
@section('title', 'Data Paper')
@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
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

        .file-review {
            margin: 20px 10px;
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
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show mb-0" role="alert">
                    {{ session('success') }}
                    <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        </div>
        <div class="card mb-4">
            <div class="card-body">
                <div class="mb-3">
                    @if (Auth::user()->role == 'Admin' || Auth::user()->role == 'Juri' || Auth::user()->role == 'Superadmin')
                        <button class="btn btn-primary btn-sm" type="button" data-bs-toggle="modal"
                            data-bs-target="#filterModal">Filter</button>
                    @endif
                </div>
                <table id="datatable-competition">
                </table>
            </div>

        </div>
    </div>

    {{-- modal untuk detail team --}}
    <div class="modal fade" id="detailTeamMember" tabindex="-1" role="dialog" aria-labelledby="detailTeamMemberTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailTeamMemberTitle">Detail Team Member</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="modal-card-form">
                        <div class="mb-3">
                            <label class="mb-1" for="facilitator">Fasilitator</label>
                            <input class="form-control" id="facilitator" type="text" value="" readonly />
                        </div>
                        <div class="mb-3">
                            <label class="mb-1" for="leader">Leader</label>
                            <input class="form-control" id="leader" type="text" value="" readonly />
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    {{-- modal untuk filter khusus admin dan juri --}}
    <div class="modal fade" id="filterModal" role="dialog" aria-labelledby="detailTeamMemberTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailTeamMemberTitle">Filter</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="mb-1" for="filter-role">Role</label>
                        <select id="filter-role" name="filter-role" class="form-select">
                            @if (Auth::user()->role == 'Admin' || Auth::user()->role == 'Superadmin')
                                <option value="admin"> Admin </option>
                            @endif
                            @if (Auth::user()->role == 'Juri')
                                <option value="juri"> Juri </option>
                            @endif
                            <option value="innovator" selected> Innovator </option>
                        </select>
                    </div>
                    @if (Auth::user()->role == 'Admin')
                        <div class="mb-3">
                            <label class="mb-1" for="filter-event">Event</label>
                            <select id="filter-event" name="filter-event" class="form-select" disabled>
                                @foreach ($data_event as $event)
                                    <option value="{{ $event->id }}"
                                        {{ $event->company_code == Auth::user()->company_code ? 'selected' : '' }}>
                                        {{ $event->event_name }} </option>
                                @endforeach
                                <option value="" selected> - </option>
                            </select>
                        </div>
                    @endif
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    {{-- modal untuk execute --}}
    <div class="modal fade" id="getExecute" role="dialog" aria-labelledby="getExecuteTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="getExecuteTitle">Execute</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('paper.register.team') }}">
                    <div class="modal-body">
                        <input type="hidden" name="team_id" id="teamIdInput" value="">
                        <div class="mb-3">
                            <label class="mb-1" for="nextevent">Event</label>
                            <select id="nextevent" name="nextevent" class="form-select">
                                <option value="Group">SIG (Group)</option>
                                <option value="External">External</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" type="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- modal untuk rollback --}}
    <div class="modal fade" id="deletePoint" tabindex="-1" role="dialog" aria-labelledby="deletePointTitle"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form id="form_rollback" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deletePointTitle">Konfirmasi Rollback Data</h5>
                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Apakah yakin data ini akan dirollback ?
                        <div class="mb">
                            <label class="mb-1" for="commentadmin">Comment</label>
                            <textarea name="comment" class="form-control" id="commentadmin" cols="30" rows="3"></textarea>
                        </div>
                        <input type="text" name="evaluatedBy" value="innovation admin" hidden>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
                        <button class="btn btn-danger" type="button" data-bs-target="">Rollback</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection

@push('js')
    {{-- <script src="https://cdn.ckeditor.com/ckeditor5/39.0.2/classic/ckeditor.js"></script> --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script type="">
    $(document).ready(function() {
        var dataTable = $('#datatable-competition').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "{{ route('query.get_competition') }}",
                "type": "GET",
                "dataSrc": function (data) {
                    // console.log('Jumlah data total: ' + data.recordsTotal);
                    // console.log('Jumlah data setelah filter: ' + data.recordsFiltered);
                    // console.log('Jumlah data setelah filter: ' + data.data);
                    return data.data;
                },
                data: function (d) {
                    d.filterRole = $('#filter-role').val();
                    d.filterEvent = $('#filter-event').val();
                }

            },
            "columns": [
                {"data":"pvt_event_team_id", "title": "No"},
                {"data": "team_name", "title": "Team Name"},
                {"data": "team_id", "title": "ID tim"},
                {"data": "innovation_title", "title": "Innovation Title"},
                {"data": "event_name", "title": "Event Name"},
                {"data": "status", "title": "Status"},
                {"data": "action", "title": "Action"},
                // {"data": "financial", "title": "Financial"},
                // {"data": "potential_benefit", "title": "Potential Benefit"}
            ],
            "scrollY": true,
            "stateSave": true,
        });

        $('#filter-role').on('change', function () {
            dataTable.ajax.reload();

            if($('#filter-role').val() == 'admin'){
                $('#filter-event').removeAttr("disabled");
            }else{
                $("#filter-event").attr("disabled", "disabled");
            }

        });
        $('#filter-event').on('change', function () {
            dataTable.ajax.reload();
        });
    });

    function change_url(id, elementid) {
        //link untuk update
        var form = document.getElementById(elementid);
        var url = `{{ route('paper.rollback', ['id' => ':id']) }}`;
        url = url.replace(':id', id);
        form.action = url;

    }
    function setTeamId(teamId) {
        var teamIdInput = document.getElementById('teamIdInput');
        teamIdInput.value = teamId;
        // Jika perlu, Anda dapat juga menambahkan kode lain untuk mengirimkan formulir setelah mengatur nilainya.
    }
    // function redirectToPage(){
    //     var optionValue = document.getElementById('nextevent').value;
    //     if (optionValue === "Group") {
    //        window.location.href = '/paper/register-team'
    //     } else {
    //         window.location.href = '/event/externalEvent'
    //     }
    // }


</script>
@endpush
<!-- JavaScript untuk mengatur action formulir -->
