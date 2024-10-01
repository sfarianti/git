@extends('layouts.app')
@section('title', 'Dokumentasi | Berita Acara')
@push('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
<style type="text/css">
    .active-link {
        color: #ffc004;
        background-color: #e81500;
    }
    #stickyNav .nav-item {
        margin-bottom: 10px;
        font-size: 16px;
    }
    .btn-group .btn{
        margin-right: 5px;
    }
    .active-link-nav{
        background-color: rgb(232, 21, 0, 0.5);
    }
    .active-link-nav a{
        color : white;
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
                            DOKUMENTASI - BERITA ACARA
                        </h1>
                    </div>
                    <div class="col-12 col-xl-auto mb-3">
                        <a class="btn btn-sm btn-outline-primary" href="{{ route('dokumentasi.index') }}">
                            <i class="me-1" data-feather="arrow-left"></i>
                            Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>
     
    <!-- Main page content-->
    <div class="container-xl px-4 mt-4">
        <div class="mb-3">
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show mb-0" role="alert">
                {{ session('success') }}
                <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            @if(session('errors'))
            <div class="alert alert-danger alert-dismissible fade show mb-0" role="alert">
                {{ session('errors') }}
                <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
        </div>  
        <div class="row">
            <div class="col-lg-12">
                <div class="card mb-4">
                    <div class="card-header">Berita Acara</div>
                    <div class="card-body">
                        {{-- <table id="datatablesSimple">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Event</th>
                                    <th>Tahun</th>
                                    <th>No. Surat</th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $no = 1;
                                ?>
                                @foreach ($data as $d)
                                <tr>
                                    <td>{{$no++}}</td>
                                    <td>{{$d->event_name}}</td>
                                    <td>{{$d->year}}</td>
                                    <td>{{$d->no_surat}}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{route('berita-acara.showPDF', ['id' => $d->id])}}" class="btn btn-info btn-sm" target="_blank"><i class="fa fa-eye"></i></a>
                                            <button class="btn btn-indigo btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#upload"><i class="fa fa-upload"></i></button>
                                        </div>
                                </tr>
                                @endforeach
                            </tbody>
                        </table> --}}
                        <table id="datatable-beritaacara"></table>
                    </div>
                </div>
                <!-- Modal-->
                <div class="modal fade" id="upload" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Form Berita Acara</h5>
                                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form id="formUpdateBeritaacara" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="modal-body">
                                
                                <div class="mb-3">
                                    <label for="uploadPDF">No Surat</label>
                                    <input type="file" name="signed_file" id="uploadPDF" class="form-control" required>
                                </div>
                                
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
                                <button class="btn btn-primary" type="submit">Save changes</button>
                            </div>
                            </form>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script type="">
        $(document).ready(function() {
        var dataTable = $('#datatable-beritaacara').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "{{ route('query.get.berita_acara') }}",
                "type": "GET",
                "dataSrc": function (data) {
                    // console.log('Jumlah data total: ' + data.recordsTotal);
                    // console.log('Jumlah data setelah filter: ' + data.recordsFiltered);
                    // console.log('Jumlah data setelah filter: ' + data.data);
                    return data.data;
                },
            },
            "columns": [
                {"data": "DT_RowIndex", "title": "No"},
                {"data": "no_surat", "title": "Nomor Surat"},
                {"data": "jenis_event", "title": "Jenis Event"},
                {"data": "penetapan_juara", "title": "Penetapan Juara"},
                {"data": "upload", "title": "Upload"},
            ],
            "scrollY": true,
            "paging": false,
            "searching" : false,
            "ordering" : false,
        });
    });

    function modal_update_beritaacara(idEventTeam){
        var form = document.getElementById('formUpdateBeritaacara');
    
        var url = `{{ route('dokumentasi.berita-acara.upload', ['id' => ':idEventTeam']) }}`;
        url = url.replace(':idEventTeam', idEventTeam);
        form.action = url;
    }

    </script>
@endpush
