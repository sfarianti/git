@extends('layouts.app')
@section('title', 'Kategori Event')

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

        .display {
            border-collapse: separate;
            /* Menggunakan border-collapse: separate untuk memberikan jarak antar border */
            border-spacing: 0;
            /* Jarak antar sel tabel */
            width: 100%;
            /* Mengatur lebar tabel */
        }

        .display thead th,
        .display tbody td {
            border: 1px solid #e0e0e0;
            /* Garis border yang lebih ringan */
            padding: 12px;
            /* Jarak dalam sel tabel */
            border-radius: 8px;
            /* Sudut border yang membulat */
        }

        .display thead th {
            background-color: #f9f9f9;
            /* Warna latar belakang header tabel */
            font-weight: bold;
            /* Menebalkan font pada header tabel */
        }

        .card {
            border-radius: 10px;
            /* Sudut border yang membulat pada kartu */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            /* Bayangan halus pada kartu */
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button {
            padding: 0.5em 1em;
            /* Jarak antara tombol pagination */
            margin: 0 0.2em;
            /* Jarak antara tombol pagination */
            border-radius: 4px;
            /* Sudut border yang membulat pada tombol pagination */
            background-color: #f0f0f0;
            /* Warna latar belakang tombol pagination */
            border: 1px solid #ddd;
            /* Garis border pada tombol pagination */
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background-color: #e0e0e0;
            /* Warna latar belakang tombol saat hover */
        }

        .dataTables_wrapper .dataTables_info {
            padding: 0.5em;
            /* Jarak padding untuk informasi tabel */
        }

        .dataTables_wrapper .dataTables_filter input {
            margin-left: 0.5em;
            /* Jarak antara label filter dan input */
            border-radius: 4px;
            /* Sudut border yang membulat pada input filter */
            border: 1px solid #ddd;
            /* Garis border pada input filter */
            padding: 0.5em;
            /* Jarak di dalam input filter */
        }

        .dataTables_wrapper .dataTables_length select {
            margin-left: 0.5em;
            /* Jarak antara label length dan dropdown */
            border-radius: 4px;
            /* Sudut border yang membulat pada dropdown */
            border: 1px solid #ddd;
            /* Garis border pada dropdown */
            padding: 0.5em;
            /* Jarak di dalam dropdown */
        }

        .dataTables_wrapper .dataTables_length,
        .dataTables_wrapper .dt-buttons {
            display: flex;
            align-items: center;
        }

        .dataTables_wrapper .dataTables_length select {
            margin-left: 0.5em;
            /* Jarak antara label length dan dropdown */
            border-radius: 4px;
            /* Sudut border yang membulat pada dropdown */
            border: 1px solid #ddd;
            /* Garis border pada dropdown */
            padding: 0.5em;
            /* Jarak di dalam dropdown */
            font-size: 0.875em;
            /* Ukuran font dropdown */
        }

        .dataTables_wrapper .dt-buttons {
            margin-left: auto;
            /* Menggeser tombol ekspor ke kanan */
            display: flex;
            gap: 0.5em;
            /* Jarak antara tombol ekspor */
        }

        .dt-buttons .btn {
            background-color: #ffffff;
            /* Warna putih cerah */
            color: #000;
            /* Warna teks tombol, hitam untuk kontras */
            border: 2px solid #d6d8db;
            /* Garis border yang lebih tebal */
            border-radius: 4px;
            /* Sudut border yang membulat pada tombol */
            padding: 0.6em 1.2em;
            /* Jarak dalam tombol, agak diperbesar */
            font-size: 0.875em;
            /* Ukuran font tombol */
            text-transform: uppercase;
            /* Mengubah teks menjadi huruf kapital */
            cursor: pointer;
            /* Mengubah kursor saat hover pada tombol */
            display: inline-block;
            /* Agar tombol berperilaku sebagai elemen inline-block */
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            /* Efek timbul pada tombol */
            transition: transform 0.2s ease-in-out, background-color 0.2s ease-in-out;
        }

        .dt-buttons .btn:hover {
            background-color: #f0f0f0;
            /* Warna abu-abu sangat cerah saat hover */
            transform: translateY(-2px);
            /* Sedikit mengangkat tombol saat hover */
            box-shadow: 0 6px 8px rgba(0, 0, 0, 0.15);
            /* Efek timbul lebih kuat saat hover */
            border-color: #c0c0c0;
            /* Warna border sedikit lebih gelap saat hover */
        }
    </style>
@endpush

@section('content')

    <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-2">
        <div class="container-xl px-4">
            <div class="page-header-content">
                <div class="row align-items-center justify-content-between pt-3">
                    <div class="col-auto mb-3">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i data-feather="book"></i></div>
                            Dokumentasi - CV
                        </h1>
                    </div>
                    <div class="col-12 col-xl-auto mb-3">
                        <a class="btn btn-sm btn-outline-primary" onclick="goBack()">
                            <i class="me-1" data-feather="arrow-left"></i>
                            Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="container-xl p-2">
        <div class="table-responsive min-vh-100">
            <table class="table table-borderless table-hover text-sm rounded bg-white">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Team</th>
                        <th scope="col">Judul</th>
                        <th scope="col">Tema</th>
                        <th scope="col">Event</th>
                        <th scope="col">Kategori</th>
                        <th scope="col">Replikasi</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($innovations->isEmpty())
                        <tr>
                            <td colspan="9" class="text-center">Tidak ada data</td>
                        </tr>
                    @else
                        @foreach ($innovations as $inovasi)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $inovasi->team_name }}</td>
                                <td>{{ $inovasi->innovation_title }}</td>
                                <td>{{ $inovasi->theme_name }}</td>
                                <td>{{ $inovasi->event_name }} Tahun {{ $inovasi->year }}</td>
                                <td>{{ $inovasi->category }}</td>
                                <td>{{ $inovasi->potensi_replikasi }}</td>
                                @php
                                    $rankData = $teamRanks->get($inovasi->team_id);
                                @endphp
                                
                                <td>
                                    @if ($inovasi->is_best_of_the_best)
                                        <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="tooltip" title="Best of The Best">
                                            <i class="fas fa-trophy"></i>
                                        </button>
                                    @elseif ($inovasi->is_honorable_winner)
                                        Juara Harapan
                                    @elseif ($rankData && $rankData->score > 0 && $rankData->rank <= 3)
                                        Juara {{ $rankData->rank }}
                                    @else
                                        Peserta
                                    @endif
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            <i data-feather="more-horizontal"></i>
                                        </button>

                                        <ul class="dropdown-menu ">
                                            <li>
                                                <a href="{{ route('cv.detail', $inovasi->team_id) }}"
                                                    class="dropdown-item btn btn-sm btn-primary">
                                                    <i class="fas fa-info-circle dropdown-item-icon"></i>Detail Inovasi
                                                </a>
                                            </li>
                                            {{-- Button Download Certificate Individual --}}
                                            <hr class="dropdown-divider">
                                            <li>
                                                <form action="{{ route('cv.generateCertificate') }}" method="POST">
                                                    @csrf

                                                    {{-- Input for Certificate Auto Create --}}
                                                    <input type="hidden" name="inovasi" value="{{ json_encode($inovasi) }}">
                                                    <input type="hidden" name="employee" value="{{ json_encode($employee) }}">
                                                    <input type="hidden" name="team_rank" value="{{ json_encode($rankData->rank) }}">
                                                    <input type="hidden" name="certificate_type" value="participant">

                                                    <button type="submit" class="btn btn-sm btn-warning dropdown-item">
                                                        <i class="dropdown-item-icon" data-feather="download"></i>
                                                        Sertifikat Peserta
                                                    </button>
                                                </form>
                                            </li>
                                            {{-- Button Downlod Certificate Team --}}
                                            @if($rankData->rank <= 3 && !$inovasi->is_honorable_winner)
                                            <hr class="dropdown-divider">
                                            <li>
                                                <form action="{{ route('cv.generateCertificate') }}" method="POST">
                                                    @csrf

                                                    {{-- Input for Certificate Auto Create --}}
                                                    <input type="hidden" name="inovasi" value="{{ json_encode($inovasi) }}">
                                                    <input type="hidden" name="employee" value="{{ json_encode($employee) }}">
                                                    <input type="hidden" name="team_rank" value="{{ json_encode($rankData->rank) }}">
                                                    <input type="hidden" name="certificate_type" value="team">

                                                    <button type="submit" class="btn btn-sm btn-warning dropdown-item">
                                                        <i class="dropdown-item-icon" data-feather="download"></i>
                                                        Sertifikat Tim
                                                    </button>
                                                </form>
                                            </li>
                                            @endif
                                            @if($inovasi->is_best_of_the_best)
                                            <hr class="dropdown-divider">
                                            <li>
                                                <form action="{{ route('cv.generateCertificate') }}" method="POST">
                                                    @csrf

                                                    {{-- Input for Certificate Auto Create --}}
                                                    <input type="hidden" name="inovasi" value="{{ json_encode($inovasi) }}">
                                                    <input type="hidden" name="employee" value="{{ json_encode($employee) }}">
                                                    <input type="hidden" name="certificate_type" value="best_of_the_best">

                                                    <button type="submit" class="btn btn-sm btn-warning dropdown-item">
                                                        <i class="dropdown-item-icon" data-feather="download"></i>
                                                        Sertifikat Best of The Best
                                                    </button>
                                                </form>
                                            </li>
                                            @elseif($inovasi->is_honorable_winner)
                                            <hr class="dropdown-divider">
                                            <li>
                                                <form action="{{ route('cv.generateCertificate') }}" method="POST">
                                                    @csrf

                                                    {{-- Input for Certificate Auto Create --}}
                                                    <input type="hidden" name="inovasi" value="{{ json_encode($inovasi) }}">
                                                    <input type="hidden" name="employee" value="{{ json_encode($employee) }}">
                                                    <input type="hidden" name="certificate_type" value="honorable_winner">

                                                    <button type="submit" class="btn btn-sm btn-warning dropdown-item">
                                                        <i class="dropdown-item-icon" data-feather="download"></i>
                                                        Sertifikat Juara Harapan
                                                    </button>
                                                </form>
                                            </li>
                                            @endif
                                        </ul>

                                    </div>

                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>


            {{-- Pagination Handler --}}
            @if ($innovations->hasPages())
                <div class="d-flex justify-content-end mt-2">
                    <ul class="pagination">
                        {{-- Tombol Previous --}}
                        <li class="page-item {{ $innovations->onFirstPage() ? 'disabled' : '' }}">
                            <a class="page-link" href="{{ $innovations->previousPageUrl() }}" rel="prev"
                                aria-label="@lang('pagination.previous')">&lsaquo;</a>
                        </li>

                        {{-- Nomor Halaman --}}
                        @foreach ($innovations->links()->elements[0] as $page => $url)
                            <li class="page-item {{ $page == $innovations->currentPage() ? 'active' : '' }}">
                                <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endforeach

                        {{-- Tombol Next --}}
                        <li class="page-item {{ $innovations->hasMorePages() ? '' : 'disabled' }}">
                            <a class="page-link" href="{{ $innovations->nextPageUrl() }}" rel="next"
                                aria-label="@lang('pagination.next')">&rsaquo;</a>
                        </li>
                    </ul>
                </div>
            @endif
        </div>



    </div>

@endsection
@push('js')
    <script>
        function goBack() {
            window.history.back();
        }
    </script>
@endpush
