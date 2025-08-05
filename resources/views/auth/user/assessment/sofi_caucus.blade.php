@extends('layouts.app')
@section('title', 'Data Paper')
@push('css')
{{-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css"> --}}
<link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
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
    .file-review{
        margin:20px 10px;
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
                            <div class="page-header-icon"><i data-feather="file-text"></i></div>
                                HASIL PENILAIAN CAUCUS ASSESSMENT - {{ strtoupper($data['dataTeam']->event_name . ' Tahun ' . $data['dataTeam']->year) }}
                        </h1>
                    </div>
                    <div class="col-12 col-xl-auto mb-3">
                        <a class="btn btn-sm btn-light text-primary" href="{{route('assessment.caucus.data')}}">
                            <i class="me-1" data-feather="arrow-left"></i>
                            Kembali
                        </a>
                        <a class="btn btn-sm btn-primary text-white" href="{{route('assessment.download.sofi.pa', $data['dataTeam']->event_team_id)}}">
                            <i class="me-1" data-feather="download"></i>
                            Download SOFI
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Main page content-->
    <div class="container-xl px-4 mt-4">
        <div class="card mb-4">
            <div class="card-header">INFORMASI TIM</div>
            <div class="card-body d-flex justify-content-center" id="datatable-card">
                <div class="col-12 col-md-5">
                    <div class="ms-4">
                        <h6 class="mb-1">Nama Tim</h6>
                        <p>{{$data['dataTeam']->team_name}}</p>
                    </div>
                    <hr>
                    <div class="ms-4">
                        <h6 class="mb-1">Judul Inovasi</h6>
                        <p>{{$data['dataTeam']->innovation_title}}</p>
                    </div>
                    <hr>
                    <div class="ms-4">
                        <h6 class="mb-1">Lokasi Implementasi Inovasi</h6>
                        <p>{{$data['dataTeam']->inovasi_lokasi}}</p>
                    </div>
                </div>
                <div class="col-12 col-md-7">
                    <div class="ms-4 mb-4 d-flex justify-content-between align-items-center">
                        <div>
                            <img src="{{ route('query.getFile') }}?directory={{ urlencode($data['dataTeam']->proof_idea) }}"
                                 id="fotoTim" class="img-fluid rounded"
                                 style="max-width: 20rem;">
                            <p class="fw-bold text-center mt-2">Foto Tim</p>
                        </div>
                        <div>
                            <img src="{{ route('query.getFile') }}?directory={{ urlencode($data['dataTeam']->innovation_photo) }}"
                                 id="fotoTim" class="img-fluid rounded"
                                 style="max-width: 20rem;">
                            <p class="fw-bold text-center mt-2">Foto Inovasi</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mb-4">
            <div class="card-header">EXECUTIVE SUMMARY</div>
            <div class="card-body" id="datatable-card">
                <form id="formExecutiveSummary" method="POST" action="{{ route('assessment.summaryExecutive') }}">
                @csrf
                    <input type="hidden" name="pvt_event_teams_id" id="inputEventTeamID" value="{{ $data['dataTeam']->event_team_id }}">
                    <div class="ms-4 mb-3">
                        <h6 class="mb-1">Latar Belakang Masalah</h6>
                        <textarea name="problem_background" id="inputProblemBackground" class="form-control exe-input" style="height: 80px" disabled></textarea>
                    </div>
                    <div class="ms-4 mb-3">
                        <h6 class="mb-1">Ide Inovasi</h6>
                        <textarea name="innovation_idea" id="inputInnovationIdea" class="form-control exe-input" style="height: 80px" disabled></textarea>
                    </div>
                    <div class="ms-4 mb-3">
                        <h6 class="mb-1">Manfaat</h6>
                        <textarea name="benefit" id="inputBenefit" class="form-control exe-input" style="height: 80px" disabled></textarea>
                    </div>
                    <div class="text-end me-4 mb-3">
                        <button class="btn btn-danger btn-cancel-input d-none">Batal</button>
                        <button class="btn btn-primary btn-save-executive-summary" type="button">Input Executive Summary</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="card mb-4">
            <div class="card-header">HASIL PENILAIAN</div>
            <div class="card-body">
                <div class="table-responsive table-billing-history">
                    <table class="table mb-0">
                        <thead>
                            <tr>
                                <th class="border-gray-200" scope="col">No</th>
                                <th class="border-gray-200" scope="col">Item Penilaian</th>
                                <th class="border-gray-200" scope="col">Final Score</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $no=1;
                            ?>
                            @foreach ($data['individualResults'] as $item)
                                <tr>
                                    <td>{{$no++}}</td>
                                    <td>{{$item->point}}</td>
                                    <td>{{$item->average_score}}</td>
                                </tr>
                            @endforeach
                                <tr>
                                    <td colspan="2"><div class="fw-700 text-monospace">TOTAL</div></td>
                                    <td><div class="fw-700">{{ $data['overallTotal'] }}</div></td>
                                </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="card mb-4">
            <div class="card-header">STRENGTH POINT OPPORTUNITY FOR IMPROVEMENT (SOFI)</div>
            <div class="card-body">
                <div class="ms-4">
                    <h6 class="mb-1">SOFI : 1. Strength Point</h6>
                    <p>{!! nl2br(e($data['dataTeam']->strength)) !!}</p>
                </div>
                <hr>
                <div class="ms-4">
                    <h6 class="mb-1">SOFI : 2. Opportunity For Improvement</h6>
                    <p>{!! nl2br(e($data['dataTeam']->opportunity_for_improvement)) !!}</p>
                </div>
                <hr>
                <div class="ms-4">
                    <h6 class="mb-1">Real Benefit (Rp)</h6>
                    <p>Rp. {{ number_format($data['dataTeam']->financial, 2, ',', '.') }}</p>
                </div>
                <hr>
                <div class="ms-4">
                    <h6 class="mb-1">Potensi Benefit (Rp)</h6>
                    <p>Rp. {{ number_format($data['dataTeam']->potential_benefit, 2, ',', '.') }}</p>
                </div>
                <hr>
                <div class="ms-4">
                    <h6 class="mb-1">Potensi Replikasi</h6>
                    @if($data['dataTeam']->potensi_replikasi == 'Bisa Direplikasi')
                        <p>Bisa Direplikasi</p>
                    @elseif($data['dataTeam']->potensi_replikasi == 'Tidak Bisa Direplikasi')
                        <p>Tidak Bisa Direplikasi</p>
                    @else
                        <p>Nilai tidak valid</p>
                    @endif
                </div>
                <hr>
                <div class="ms-4">
                    <h6 class="mb-1">Detil Penghitungan Benefit (Real & Potensial)</h6>
                    <p>{!! nl2br(e($data['dataTeam']->suggestion_for_benefit)) !!}</p>
                </div>
                <hr>
                <div class="ms-4">
                    <h6 class="mb-1">Rekomendasi Juri Terhadap Kategori Makalah Inovasi</h6>
                    <p>{!! nl2br(e($data['dataTeam']->recommend_category)) !!}</p>
                </div>
            </div>
        </div>

    </div>
@endsection

@push('js')
{{-- <script src="https://cdn.ckeditor.com/ckeditor5/39.0.2/classic/ckeditor.js"></script> --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
{{-- <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script> --}}

<script>
    let teamId = {{ $data['dataTeam']->team_id }};
    let pvtEventTeamId = {{ $data['dataTeam']->event_team_id }};
    
    document.addEventListener("DOMContentLoaded", function() {
        setSummary(teamId, pvtEventTeamId);
    });
    
    document.querySelector('.btn-save-executive-summary').addEventListener('click', function () {
        let inputs = document.querySelectorAll('.exe-input');
        let sedangEdit = false;

        inputs.forEach(function (input) {
            if (input.disabled) {
                sedangEdit = true;
            }
        });

        if (sedangEdit) {
            // Aktifkan mode edit
            inputs.forEach(function (input) {
                input.disabled = false;
            });

            // Tampilkan semua tombol hapus yang tersembunyi
            document.querySelectorAll('.btn-cancel-input').forEach(function (btn) {
                btn.classList.remove('d-none');
            });

            this.textContent = 'Simpan';
        } else {
            // Submit form
            document.querySelector('#formExecutiveSummary').submit();
        }
    });
    
    document.querySelector('.btn-cancel-input').addEventListener('click', function (e) {
        e.preventDefault();
    
        document.querySelectorAll('.exe-input').forEach(function (input) {
            input.disabled = true;
        });
    
        // Sembunyikan tombol batal
        this.classList.add('d-none');
    
        // Ubah tombol utama kembali ke "Input Executive Summary"
        document.querySelector('.btn-save-executive-summary').textContent = 'Input Executive Summary';
    });

    function setSummary(team_id, pvt_event_teams_id){
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
