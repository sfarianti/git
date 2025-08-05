@extends('layouts.app')

@section('title', 'Daftar Event | Dashboard')

@push('css')
    <link
        href="https://cdn.datatables.net/v/bs5/jq-3.7.0/jszip-3.10.1/dt-2.1.8/b-3.1.2/b-colvis-3.1.2/b-html5-3.1.2/b-print-3.1.2/cr-2.0.4/date-1.5.4/fc-5.0.4/fh-4.0.1/kt-2.12.1/r-3.0.3/rg-1.5.0/rr-1.5.0/sc-2.4.3/sb-1.8.1/sp-2.3.3/sl-2.1.0/sr-1.4.1/datatables.min.css"
        rel="stylesheet">
@endpush

@section('content')
<x-header-content title="Daftar Event"></x-header-content>
    <div class="container mt-4">
        <div class="card">
            <div class="card-body">
                <table id="eventsTable" class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Event</th>
                            <th>Status</th>
                            <th>Tanggal Mulai</th>
                            <th>Tanggal Berakhir</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($events as $event)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $event->event_name . ' Tahun ' . $event->year }}</td>
                                <td>
                                @if ($event->status === 'active')
                                    <span class="badge bg-success">Aktif</span>
                                @elseif ($event->status === 'finish')
                                    <span class="badge bg-primary">Finish</span>
                                @else
                                    <span class="badge bg-secondary">Tidak Aktif</span>
                                @endif
                                </td>
                                <td>{{ \Carbon\Carbon::parse($event->date_start)->format('d M Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($event->date_end)->format('d M Y') }}</td>
                                <td class="d-flex flex-row gap-2">
                                    <a href="{{ route('dashboard-event.show', $event->id) }}"
                                        class="btn btn-sm btn-primary">
                                        <i class="bi bi-eye"></i> Lihat Deskripsi
                                    </a>
                                    <a href="{{ route('dashboard-event.statistics', $event->id) }}"
                                        class="btn btn-sm btn-info">
                                        <i class="bi bi-bar-chart"></i> Statistik
                                    </a>
                                    <a href="{{ route('event-team.show', $event->id) }}"
                                        class="btn btn-sm text-white" style="background-color: #eb4a3a">
                                        <i class="bi bi-bar-chart"></i> List Team
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
@endsection

@push('js')
    <script
        src="https://cdn.datatables.net/v/bs5/jq-3.7.0/jszip-3.10.1/dt-2.1.8/b-3.1.2/b-colvis-3.1.2/b-html5-3.1.2/b-print-3.1.2/cr-2.0.4/date-1.5.4/fc-5.0.4/fh-4.0.1/kt-2.12.1/r-3.0.3/rg-1.5.0/rr-1.5.0/sc-2.4.3/sb-1.8.1/sp-2.3.3/sl-2.1.0/sr-1.4.1/datatables.min.js">
    </script>

    <script>
        $(document).ready(function() {
            $('#eventsTable').DataTable({
                responsive: true,
                columnDefs: [{
                        orderable: false,
                        targets: [5]
                    } // Kolom Action tidak bisa diurutkan
                ]
            });
        });
    </script>
@endpush
