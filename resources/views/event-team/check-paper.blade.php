@extends('layouts.app')
@section('title', 'Periksa Malakah Inovasi | Event Group')
@push('css')
    <style>
        #loadingOverlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            /* Background gelap dengan transparansi */
            z-index: 9999;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            /* Warna teks putih untuk kontras */
            font-size: 1.5rem;
            /* Ukuran font lebih besar untuk visibilitas */
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
                            <div class="page-header-icon"><i data-feather="edit"></i></div>
                            Preview Makalah Inovasi
                        </h1>
                    </div>
                    <div class="col-12 col-xl-auto mb-3">
                        <a class="btn btn-sm btn-light text-primary" href="{{ route('event-team.show', $eventId) }}">
                            <i class="me-1" data-feather="arrow-left"></i>
                            Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div class="container-fluid py-4">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-header text-white" style="background-color: #e94838;">
                        <h3 class="card-title mb-0 text-white">Ringkasan Makalah Inovasi</h3>
                    </div>
                    <div class="card-body">
                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="mb-3 border-bottom pb-2">
                                    <label class="form-label fw-600 capitalize mb-0">Nama Tim</label>
                                    <p class="form-control-plaintext mt-0">{{ $paper->team->team_name }}</p>
                                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#detailTeamMember">
                                        Detail Anggota Tim
                                    </button>
                                </div>
                                <div class="mb-3 border-bottom">
                                    <label class="form-label fw-600 mb-0">Judul Inovasi</label>
                                    <p class="form-control-plaintext mt-0">{{ $paper->innovation_title }}</p>
                                </div>

                                <div class="mb-3 border-bottom">
                                    <label class="form-label fw-600 fw-600 mb-0">Lokasi Inovasi</label>
                                    <p class="form-control-plaintext mt-0">{{ $paper->inovasi_lokasi }}</p>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-600 fw-600 mb-0">Abstrak</label>
                                    <div class="border rounded p-3">
                                        {!! nl2br(e($paper->abstract)) !!}
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-600">Masalah</label>
                                    <div class="border rounded p-3">
                                        {!! nl2br(e($paper->problem)) !!}
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-600">Penyebab Utama</label>
                                    <div class="border rounded p-3">
                                        {!! nl2br(e($paper->main_cause)) !!}
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-600">Solusi</label>
                                    <div class="border rounded p-3">
                                        {!! nl2br(e($paper->solution)) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label fw-600">Benefit Finansial</label>
                                    <p class="form-control-plaintext">Rp {{ $paper->financial_formatted }}</p>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-600">Benefit Potensial</label>
                                    <p class="form-control-plaintext">Rp {{ $paper->potential_benefit_formatted }}</p>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-600">Benefit Non-Finansial</label>
                                    <div class="border rounded p-3">
                                        {!! nl2br(e($paper->non_financial)) !!}
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-600">Potensi Replikasi</label>
                                    <div class="border rounded p-3">
                                        {{ $paper->potensi_replikasi }}}
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-600">Full Paper</label>
                                    @if ($paper->full_paper)
                                        <div>
                                            <a href="{{ route('paper.watermarks', $paper->id) }}"
                                                class="btn btn-sm btn-primary" target="_blank">
                                                <i class="fas fa-file-pdf me-1"></i> Lihat Full Paper
                                            </a>
                                        </div>
                                    @else
                                        <p class="text-muted">Paper belum diupload</p>
                                    @endif
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-600">Berita Acara Benefit</label>
                                    @if ($paper->file_review)
                                        <div>
                                            <a href="{{ route('assessment.benefitView', ['paperId' => $paper->id]) }}"
                                                class="btn btn-sm btn-primary" target="_blank">
                                                <i class="fas fa-file-pdf me-1"></i> Lihat Berita Acara
                                            </a>
                                        </div>
                                    @else
                                        <p class="text-muted">File belum diupload</p>
                                    @endif
                                </div>

                                <div class="mb-3 text-center">
                                    <label class="form-label fw-600">Foto Inovasi</label>
                                    @if ($paper->innovation_photo)
                                        <div>
                                            <img src="{{ route('query.getFile') }}?directory={{ urlencode($paper->innovation_photo) }}"
                                                class="img-fluid rounded" alt="Innovation Photo">
                                        </div>
                                    @else
                                        <p class="text-muted">Foto inovasi belum diupload</p>
                                    @endif
                                </div>

                                <div class="mb-3 text-center">
                                    <label class="form-label fw-600">Proof of Idea</label>
                                    @if ($paper->proof_idea)
                                        <div>
                                            <img src="{{ route('query.getFile') }}?directory={{ urlencode($paper->proof_idea) }}"
                                                class="img-fluid rounded" alt="Proof of Idea">
                                        </div>
                                    @else
                                        <p class="text-muted">Proof of Idea belum di unggah</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @if ($eventType !== 'AP' && $eventType !== 'internal')
                            <div class="row mt-4">
                                <div class="col-12">
                                    <form id="updateStatusForm"
                                        action="{{ route('event-team.updatePaperStatus', ['id' => $paper->id, 'eventId' => $eventId]) }}"
                                        method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="mb-3">
                                            <label class="form-label fw-600">Perbarui Status</label>
                                            <select name="status_event" id="statusSelect" class="form-select">
                                                <option value="accept_group"
                                                    {{ $paper->status_event == 'accept_group' ? 'selected' : '' }}>Accept
                                                    Group
                                                </option>
                                                <option value="reject_group"
                                                    {{ $paper->status_event == 'reject_group' ? 'selected' : '' }}>Reject
                                                    Group
                                                </option>
                                                <option value="accept_national"
                                                    {{ $paper->status_event == 'accept_national' ? 'selected' : '' }}>
                                                    Accept
                                                    National</option>
                                                <option value="reject_national"
                                                    {{ $paper->status_event == 'reject_national' ? 'selected' : '' }}>
                                                    Reject
                                                    National</option>
                                                <option value="accept_international"
                                                    {{ $paper->status_event == 'accept_international' ? 'selected' : '' }}>
                                                    Accept International</option>
                                                <option value="reject_international"
                                                    {{ $paper->status_event == 'reject_international' ? 'selected' : '' }}>
                                                    Reject International</option>
                                            </select>
                                        </div>
                                        <button type="submit" id="updateStatusBtn" class="btn btn-primary">Perberui
                                            Status</button>
                                        <div class="spinner-border text-primary" id="loadingSpinner"
                                            style="display: none;" role="status">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Detail team --}}
    <div class="modal fade" id="detailTeamMember" tabindex="-1" role="dialog" aria-labelledby="detailTeamMemberTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    {{-- <h5 class="modal-title" id="detailTeamMemberTitle">Detail Team Member</h5> --}}
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-md-4 mb-3">
                            <!-- Detail Team -->
                            <div class="card shadow-sm mb-3">
                                <div class="card-header bg-light d-flex justify-content-between align-items-center">
                                    <h5 class="m-0">Detail Tim</h5>
                                </div>
                                <div class="card-body">
                                    <form id="modal-card-form">
                                        <div class="mb-3">
                                            <label class="form-label fw-600" for="facilitator">Fasilitator</label>
                                            <input class="form-control form-control-lg" id="facilitator" type="text"
                                                value="{{ $facilitator->user->name ?? 'Tidak ada' }}" readonly />
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label fw-600" for="leader">Leader</label>
                                            <input class="form-control form-control-lg" id="leader" type="text"
                                                value="{{ $leader->user->name ?? 'Tidak ada' }}" readonly />
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <!-- Foto Tim -->
                            <div class="card shadow-sm mb-3">
                                <div class="card-header bg-light d-flex justify-content-between align-items-center">
                                    <h5 class="m-0">Foto Tim</h5>
                                </div>
                                <div class="card-body text-center">
                                    <img src="{{ asset('storage/' . $paper->proof_idea) ?? '' }}" id="idFotoTim"
                                        alt="Foto Tim" class="img-fluid rounded-3 shadow-sm" />
                                </div>
                            </div>
                        </div>

                        <div class="col-md-8">
                            <div class="card shadow-sm mb-3">
                                <div class="card-header bg-light d-flex justify-content-between align-items-center">
                                    <h5 class="m-0">Anggota Tim</h5>
                                </div>
                                <div class="card-body">
                                    <ul class="list-group">
                                        @foreach ($members as $member)
                                            <li class="list-group-item">
                                                {{ $member->user->name ?? 'Tidak diketahui' }}
                                                <span class="badge bg-secondary">{{ $member->status }}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-danger" type="button" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Rejection Comments --}}
    <div class="modal fade" id="rejectModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Komentar Penolakan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="rejectForm"
                    action="{{ route('event-team.updatePaperStatus', ['id' => $paper->id, 'eventId' => $eventId]) }}"
                    method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <input type="hidden" name="status_event" id="reject_status_event">
                        <div class="mb-3">
                            <label class="form-label">Comments</label>
                            <textarea name="comments" class="form-control" rows="4" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div id="loadingOverlay" style="display: none;">
        <div class="d-flex justify-content-center">
            <div class="spinner-border" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            <p class="text-white">Loading...</p>
        </div>
    </div>
    @push('js')
        <script>
            $(document).ready(function() {
                function checkStatus() {
                    const status = $('#statusSelect').val();
                    return status.includes('reject');
                }

                function toggleRejectModal(show) {
                    if (show) {
                        var myModal = new bootstrap.Modal(document.getElementById('rejectModal'));
                        myModal.show();
                    } else {
                        $('#rejectModal').modal('hide');
                    }
                }

                // Ubah teks tombol saat status dipilih
                $('#statusSelect').on('change', function() {
                    if (checkStatus()) {
                        $('#updateStatusBtn').text('Reject (Requires Comment)');
                    } else {
                        $('#updateStatusBtn').text('Update Status');
                    }
                });

                $('#updateStatusForm').on('submit', function(e) {
                    if (checkStatus()) {
                        e.preventDefault(); // Mencegah form utama terkirim
                        $('#reject_status_event').val($('#statusSelect').val());
                        toggleRejectModal(true);
                    }
                });

                $('#rejectForm').on('submit', function(e) {
                    e.preventDefault(); // Mencegah reload form rejection

                    $.ajax({
                        url: $(this).attr('action'),
                        method: 'POST',
                        data: $(this).serialize(),
                        beforeSend: function() {
                            $('#loadingSpinner').show();
                        },
                        success: function(response) {
                            window.location.reload();
                        },
                        error: function(xhr) {
                            alert('Error updating status');
                        },
                        complete: function() {
                            $('#loadingSpinner').hide();
                        }
                    });
                });

                // Reset modal saat ditutup
                $('#rejectModal').on('hidden.bs.modal', function() {
                    $('#rejectForm')[0].reset();
                });
            });

        </script>
    @endpush
@endsection
