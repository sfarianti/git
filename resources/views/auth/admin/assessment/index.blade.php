@extends('layouts.app')
@section('title', 'Data Assessment')
@push('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
<link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
@endpush
@section('content')
                    <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
                        <div class="container-xl px-4">
                            <div class="page-header-content">
                                <div class="row align-items-center justify-content-between pt-3">
                                    <div class="col-auto mb-3">
                                        <h1 class="page-header-title">
                                            <div class="page-header-icon"><i data-feather="book"></i></div>
                                             Data Aasessment
                                        </h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </header>
                    <!-- Main page content-->
                    <div class="container-xl px-4 mt-4">
                        <div class="p-2 border-bottom">
                            <a href="{{route('assessment.show.template')}}" class="btn btn-outline-danger btn-sm rounded shadow-sm px-4 py-3 text-uppercase fw-800 me-2 my-1 {{ Route::is('assessment.show.template') ? 'active-link' : '' }}">Template</a>
                            <a href="{{route('assessment.show.point')}}" class="btn btn-outline-danger btn-sm rounded shadow-sm px-4 py-3 text-uppercase fw-800 me-2 my-1 {{ Route::is('assessment.show.point') ? 'active-link' : '' }}">Assessment Point</a>
                        </div>
                        <div class="mb-3">
                            @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show mb-0" role="alert">
                                {{ session('success') }}
                                <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            @endif
                        </div>
                        <div class="card mb-4">
                             <div class="card-body">
                                ini nanti tabel summary yang sudah ada nilainya
                                <table id="datatablesSimple">

                                </table>
                            </div>
                        </div>
                    </div>
@endsection


@push('js')
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.2/classic/ckeditor.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>

@endpush
