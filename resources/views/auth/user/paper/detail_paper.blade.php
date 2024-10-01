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
        <div class="p-2 border-bottom">
            <a href="{{route('paper.index')}}" class="btn btn-outline-danger btn-sm rounded shadow-sm px-4 py-3 text-uppercase fw-800 me-2 my-1 {{ Route::is('paper.index') ? 'active-link' : '' }}">Paper</a>
            <a href="{{route('paper.register.team')}}" class="btn btn-outline-danger btn-sm rounded shadow-sm px-4 py-3 text-uppercase fw-800 me-2 my-1 {{ Route::is('paper.register.team') ? 'active-link' : '' }}">Register</a>
            @if (Auth::user()->role == 'Admin' || Auth::user()->role == 'Superadmin')
            <a href="{{route('assessment.recap')}}" class="btn btn-outline-danger btn-sm rounded shadow-sm px-4 py-3 text-uppercase fw-800 me-2 my-1 {{ Route::is('assessment.recap') ? 'active-link' : '' }}">Assessment</a>
            <!-- <a href="" class="btn btn-outline-danger btn-sm rounded shadow-sm px-4 py-3 text-uppercase fw-800 me-2 my-1">Event</a> -->
            <a href="{{route('paper.event')}}" class="btn btn-outline-danger btn-sm rounded shadow-sm px-4 py-3 text-uppercase fw-800 me-2 my-1 {{ Route::is('paper.event') ? 'active-link' : '' }}">Event</a>
            <a href="{{route('evidence.index')}}" class="btn btn-outline-danger btn-sm rounded shadow-sm px-4 py-3 text-uppercase fw-800 me-2 my-1 {{ Route::is('evidence.index') ? 'active-link' : '' }}">Evidence</a>
            @elseif(Auth::user()->role == 'Juri')
            <a href="{{route('assessment.index.juri')}}" class="btn btn-outline-danger btn-sm rounded shadow-sm px-4 py-3 text-uppercase fw-800 me-2 my-1 {{ Route::is('assessment.index.juri') ? 'active-link' : '' }}">Assesment</a>
            @endif
        
        </div>
        <div class="card mb-4">
            <div class="card-body">
                <div class="row mb-2">
                    <h6 class="small mb-1">Abstrak</h6>
                    <textarea class="form-control" id="pesan" name="pesan" rows="4" cols="100" readonly>{{ $data_paper['abstract'] }}</textarea>
                </div>
                <div class="row mb-2">
                    <h6 class="small mb-1">Masalah</h6>
                    <textarea class="form-control" id="pesan" name="pesan" rows="4" cols="100" readonly>{{ $data_paper['problem'] }}</textarea>
                </div>
                {{-- <div class="row mb-2">
                    <h6 class="small mb-1">Dampak Masalah</h6>
                    <textarea class="form-control" id="pesan" name="pesan" rows="4" cols="100" readonly>{{ $data_paper['problem_impact'] }}</textarea>
                </div> --}}
                <div class="row mb-2">
                    <h6 class="small mb-1">Penyebab Utama</h6>
                    <textarea class="form-control" id="pesan" name="pesan" rows="4" cols="100" readonly>{{ $data_paper['main_cause'] }}</textarea>
                </div>
                <div class="row mb-2">
                    <h6 class="small mb-1">Solusi</h6>
                    <textarea class="form-control" id="pesan" name="pesan" rows="4" cols="100" readonly>{{ $data_paper['solution'] }}</textarea>
                </div>
                <div class="row mb-2">
                    <h6 class="small mb-1">Hasil Solusi</h6>
                    <textarea class="form-control" id="pesan" name="pesan" rows="4" cols="100" readonly>{{ $data_paper['outcome'] }}</textarea>
                </div>
                {{-- <div class="row mb-2">
                    <h6 class="small mb-1">Dampak Positif</h6>
                    <textarea class="form-control" id="pesan" name="pesan" rows="4" cols="100" readonly>{{ $data_paper['performance'] }}</textarea>
                </div> --}}
                <div class="row mb-2">
                    <h6 class="small mb-1">Gambar Bukti Ide</h6>
                    <div>
                        <img src="data:image/jpeg;base64,{{ base64_encode($data_paper['proof_idea']) }}" width="300" height="200">
                    </div>
                </div>
                <div class="row mb-2">
                    <h6 class="small mb-1">Gambar Foto Inovasi</h6>
                    <div>
                        <img src="data:image/jpeg;base64,{{ base64_encode($data_paper['innovation_photo']) }}" width="300" height="200">
                    </div>
                </div>
            </div>
            
        </div>
    </div>
@endsection

@push('js')
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.2/classic/ckeditor.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>

@endpush
