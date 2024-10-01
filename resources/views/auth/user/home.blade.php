@extends('layouts.app')
@section('title', 'Dashboard')
@section('css')
@endsection

@push('css')
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@endpush
@section('content')
    <!-- Your content for the home page here -->
    <div class="bgBase1">
        <header class="marginForDashboard page-header page-header-dark bg-red opacity-75 pb-10">
            <div class="container-xl px-4">
                <div class="page-header-content pt-4">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-auto mt-4">
                            <div class="d-flex align-items-center">
                                <div class="page-header-icon me-2">
                                    <i data-feather="activity"></i>
                                </div>
                                <div>
                                    <h1 class="page-header-title mb-0">
                                        @if (Auth::user()->role == 'User')
                                            Dashboard Innovator
                                        @elseif(Auth::user()->role == 'Admin')
                                            Dashboard Pengelola Inovasi
                                        @elseif(Auth::user()->role == 'Superadmin')
                                            Dashboard Superadmin
                                        @elseif(Auth::user()->role == 'BOD')
                                            Dashboard BOD
                                        @elseif(Auth::user()->role == 'Juri')
                                            Dashboard Juri
                                        @endif
                                    </h1>
                                    @php
                                        $formattedDateTime = now()->isoFormat('dddd · D MMMM YYYY') . ' · ' . now()->format('H:i');
                                    @endphp
                                    <div class="page-header-subtitle mt-1 d-flex align-items-center">
                                        <i class="bi bi-calendar-date me-2"></i>
                                        <span>{{ $formattedDateTime }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-xl-auto mt-4 pe-15">
                            <div class="input-group input-group-joined border-0">
                                <a href="{{ route('paper.index') }}"
                                    class="btn btn-light btn-md rounded-50 shadow-sm px-4 py-3 text-uppercase fw-800 me-2 my-1 no-outline">Register
                                    Team</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Main page content-->
        <div class="container-xl px-4 mt-n10">
            <div class="row justify-content-center">
                <div class="col-xxl-12 col-xl-12 mb-4">
                    <div class="card h-100 text-center">
                        <div class="card-body h-100 p-5">
                            <div class="row align-items-center justify-content-center">
                                <div class="col-lg-8 col-xxl-8">
                                    <h1 class="text-danger">Welcome to SIG Innovation</h1>
                                    <p class="text-gray-700 mb-0">
                                        Laman ini adalah portal inovasi Unit Knowledge Management and Innovation. Anda bisa mencari jurnal inovasi, mendaftarkan tim anda, serta mengikuti kegiatan inovasi.
                                        <br>
                                        Selamat dan semangat inovasi!
                                    </p>
                                </div>
                                <div class="col-xl-4 col-xxl-12 text-center">
                                    {{-- <img class="img-fluid" src="{{ asset('template/dist/assets/img/illustrations/at-work.svg') }}" style="max-width: 26rem" /> --}}
                                    <img src="{{ asset('assets/sigialogo.png') }}" alt="" srcset="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Example Colored Cards for Dashboard Demo-->
            <div class="row mb-3">
                <div class="col-lg-6 col-xl-4 mb-4">
                    <div class="card bg-primary text-white h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="me-3">
                                    <div class="text-white-75 small">BREAKTHROUGH INNOVATION</div>
                                    <div class="text-lg fw-bold">
                                        {{ $breakthroughInnovation }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- modal --}}
                        <div class="modal fade" id="breakthroughInnovationModal">
                            <div class="modal-dialog modal-xl">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h2 class="modal-title">Detail: Breakthrough Innovation</h2>
                                    </div>
                                    <div class="modal-body text-black">
                                        Produk Dan Bahan Baku : {{ $detailBreakthroughInnovationPBB }} <br>
                                        Teknologi Dan Proses Produksi : {{ $detailBreakthroughInnovationTPP }} <br>
                                        Manajemen : {{ $detailBreakthroughInnovationManagement }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- end-modal --}}
                        <div class="card-footer d-flex align-items-center justify-content-between small">
                            <a class="text-white stretched-link" href="#" data-bs-toggle="modal"
                                data-bs-target="#breakthroughInnovationModal">View Details</a>
                            <div class="text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-xl-4 mb-4">
                    <div class="card bg-success text-white h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="me-3">
                                    <div class="text-white-75 small">INCREMENTAL INNOVATION</div>
                                    <div class="text-lg fw-bold">
                                        {{ $incrementalInnovation }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- modal --}}
                        <div class="modal fade" id="incrementalInnovationModal">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h2 class="modal-title">Detail: Incremental Innovation</h2>
                                    </div>
                                    <div class="modal-body text-black">

                                        GKM Plant : {{ $detailIncrementalInnovationGKMPlant }} <br>
                                        GKM Office : {{ $detailIncrementalInnovationGKMOffice }} <br>
                                        PKM Plant : {{ $detailIncrementalInnovationPKMPlant }} <br>
                                        PKM Office : {{ $detailIncrementalInnovationPKMOffice }} <br>
                                        SS Plant : {{ $detailIncrementalInnovationSSPlant }} <br>
                                        SS Office : {{ $detailIncrementalInnovationSSOffice }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- end-modal --}}
                        <div class="card-footer d-flex align-items-center justify-content-between small">

                            <a class="text-white stretched-link" href="#" data-bs-toggle="modal"
                                data-bs-target="#incrementalInnovationModal">View Details</a>
                            <div class="text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-xl-4 mb-4">
                    <div class="card bg-warning text-white h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="me-3">
                                    <div class="text-white-75 small">IDEABOX</div>
                                    <div class="text-lg fw-bold">
                                        {{ $ideaBox }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- modal --}}
                        <div class="modal fade" id="ideaBoxModal">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h2 class="modal-title">Detail: Idea Box</h2>
                                    </div>
                                    <div class="modal-body text-black">
                                        Idea Box : {{ $detailIdeaBoxIdea }} <br>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- end-modal --}}
                        <div class="card-footer d-flex align-items-center justify-content-between small">
                            <a class="text-white stretched-link" href="#" data-bs-toggle="modal"
                                data-bs-target="#ideaBoxModal">View Details</a>
                            <div class="text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-6 mb-4">
                    <div class="card card-header-actions h-100">
                        <div class="card-header">
                            Semen
                            <div class="dropdown no-caret">
                                <button class="btn btn-transparent-dark btn-icon dropdown-toggle" id="dropdownMenuButton" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="text-gray-500" data-feather="more-vertical"></i></button>
                                <div class="dropdown-menu dropdown-menu-end animated--fade-in-up" aria-labelledby="dropdownMenuButton">
                                    <h6 class="dropdown-header">Filter Activity:</h6>
                                    <a class="dropdown-item" href="#!"><span class="badge bg-green-soft text-green my-1">Commerce</span></a>
                                    <a class="dropdown-item" href="#!"><span class="badge bg-blue-soft text-blue my-1">Reporting</span></a>
                                    <a class="dropdown-item" href="#!"><span class="badge bg-yellow-soft text-yellow my-1">Server</span></a>
                                    <a class="dropdown-item" href="#!"><span class="badge bg-purple-soft text-purple my-1">Users</span></a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <canvas id="semenChart"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 mb-4">
                    <div class="card card-header-actions h-100">
                        <div class="card-header">
                            Non Semen
                            <div class="dropdown no-caret">
                                <button class="btn btn-transparent-dark btn-icon dropdown-toggle" id="dropdownMenuButton" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="text-gray-500" data-feather="more-vertical"></i></button>
                                <div class="dropdown-menu dropdown-menu-end animated--fade-in-up" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="#!">
                                        <div class="dropdown-item-icon"><i class="text-gray-500" data-feather="list"></i></div>
                                        Manage Tasks
                                    </a>
                                    <a class="dropdown-item" href="#!">
                                        <div class="dropdown-item-icon"><i class="text-gray-500" data-feather="plus-circle"></i></div>
                                        Add New Task
                                    </a>
                                    <a class="dropdown-item" href="#!">
                                        <div class="dropdown-item-icon"><i class="text-gray-500" data-feather="minus-circle"></i></div>
                                        Delete Tasks
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <canvas id="nonSemenChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-6 mb-4">
                    <div class="card card-header-actions h-100">
                        <div class="card-header">
                            Realisasi Jumlah Tim
                            <div class="dropdown no-caret">
                                <button class="btn btn-transparent-dark btn-icon dropdown-toggle" id="areaChartDropdownExample" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="text-gray-500" data-feather="more-vertical"></i></button>
                                <div class="dropdown-menu dropdown-menu-end animated--fade-in-up" aria-labelledby="areaChartDropdownExample">
                                    <a class="dropdown-item" href="#!">Last 4 Years</a>
                                    <a class="dropdown-item" href="#!">Last 12 Months</a>
                                    <a class="dropdown-item" href="#!">Last 30 Days</a>
                                    <a class="dropdown-item" href="#!">Last 7 Days</a>
                                    <a class="dropdown-item" href="#!">This Month</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#!">Custom Range</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="chart-area"><canvas id="realisasiTeamChart"></canvas></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 mb-4">
                    <div class="card card-header-actions h-100">
                        <div class="card-header">
                            Realisasi Jumlah Peserta (Karyawan)
                            <div class="dropdown no-caret">
                                <button class="btn btn-transparent-dark btn-icon dropdown-toggle" id="areaChartDropdownExample" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="text-gray-500" data-feather="more-vertical"></i></button>
                                <div class="dropdown-menu dropdown-menu-end animated--fade-in-up" aria-labelledby="areaChartDropdownExample">
                                    <a class="dropdown-item" href="#!">Last 4 Years</a>
                                    <a class="dropdown-item" href="#!">Last 12 Months</a>
                                    <a class="dropdown-item" href="#!">Last 30 Days</a>
                                    <a class="dropdown-item" href="#!">Last 7 Days</a>
                                    <a class="dropdown-item" href="#!">This Month</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#!">Custom Range</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="chart-bar"><canvas id="realisasiKaryawanChart"></canvas></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="">
                <div class="col-xl-12 mb-4">
                    <div class="card card-header-actions h-100">
                        <div class="card-header">
                           Benefit
                            <div class="dropdown no-caret">
                                <button class="btn btn-transparent-dark btn-icon dropdown-toggle" id="areaChartDropdownExample" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="text-gray-500" data-feather="more-vertical"></i></button>
                                <div class="dropdown-menu dropdown-menu-end animated--fade-in-up" aria-labelledby="areaChartDropdownExample">
                                    <a class="dropdown-item" href="#!">Last 4 Years</a>
                                    <a class="dropdown-item" href="#!">Last 12 Months</a>
                                    <a class="dropdown-item" href="#!">Last 30 Days</a>
                                    <a class="dropdown-item" href="#!">Last 7 Days</a>
                                    <a class="dropdown-item" href="#!">This Month</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#!">Custom Range</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                                <canvas id="horizontalBenefitChart"></canvas>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.0/dist/chart.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('js/horizontal-bar-chart.js') }}"></script>
    <script>
        $(document).ready(function() {
            $.ajax({
                url: `{{ route('chart.semenTeamChart') }}`,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    renderChartTeamPerCategory(data);
                },
                error: function(error) {
                    console.error('Error fetching chart data:', error);
                }
            });
            $.ajax({
                url: `{{ route('chart.NonSemenTeamChart') }}`,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    renderChartTeamPerCategoryNonSemen(data);
                },
                error: function(error) {
                    console.error('Error fetching chart data:', error);
                }
            });
            $.ajax({
                url: `{{ route('chart.realisasiTeamChart') }}`,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    renderChartRealisasiTeam(data);
                },
                error: function(error) {
                    console.error('Error fetching chart data:', error);
                }
            });
            $.ajax({
                url: `{{ route('chart.realisasiKaryawanChart') }}`,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    renderChartRealisasiKaryawan(data);
                },
                error: function(error) {
                    console.error('Error fetching chart data:', error);
                }
            });
            $.ajax({
                url: `{{ route('chart.benefitTeamChart') }}`,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    renderChartBenefit(data);
                },
                error: function(error) {
                    console.error('Error fetching chart data:', error);
                }
            });
        });

        function renderChartTeamPerCategory(data) {
    var ctx = document.getElementById('semenChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: data.map(item => item.cat_name),
            datasets: [{
                label: 'Team Count per Category',
                data: data.map(item => item.count),
                backgroundColor: ['#36A2EB', '#FF6384', '#4BC0C0', '#FF9F40', '#9966FF', '#FFCD56', '#C9CBCF', '#E0AED0', '#FFC004', '#FF9800'],
                borderColor: '#000000', // Border hitam
                borderWidth: 1
            }]
        },
        options: {
            responsive: true, // Menyesuaikan ukuran canvas dengan ukuran kontainer
            maintainAspectRatio: false, // Mengizinkan perubahan rasio aspek
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Category'
                    },
                    ticks: {
                        autoSkip: false, // Menampilkan semua label sumbu X
                        maxRotation: 45, // Menyesuaikan rotasi label sumbu X
                        minRotation: 45
                    }
                },
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Team Count'
                    }
                }
            }
        }
    });
}
        function renderChartTeamPerCategoryNonSemen(data) {
    var ctx = document.getElementById('nonSemenChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: data.map(item => item.cat_name),
            datasets: [{
                label: 'Team Count per Category',
                data: data.map(item => item.count),
                backgroundColor: ['#36A2EB', '#FF6384', '#4BC0C0', '#FF9F40', '#9966FF', '#FFCD56', '#C9CBCF', '#E0AED0', '#FFC004', '#FF9800'],
                borderColor: '#00000', // Border hitam
                borderWidth: 1
            }]
        },
        options: {
            responsive: true, // Menyesuaikan ukuran canvas dengan ukuran kontainer
            maintainAspectRatio: false, // Mengizinkan perubahan rasio aspek
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Category'
                    },
                    ticks: {
                        autoSkip: false, // Menampilkan semua label sumbu X
                        maxRotation: 45, // Menyesuaikan rotasi label sumbu X
                        minRotation: 45
                    }
                },
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Team Count'
                    }
                }
            }
        }
    });
}

function renderChartRealisasiTeam(data) {
    var ctx = document.getElementById('realisasiTeamChart').getContext('2d');
    var uniqueYears = Array.from(new Set(data.map(item => item.year)));
    var companies = Array.from(new Set(data.map(item => item.company_name)));
    var datasets = [];

    companies.forEach(company => {
        var companyData = data.filter(item => item.company_name === company);

        datasets.push({
            label: company,
            data: uniqueYears.map(year => {
                var dataPoint = companyData.find(item => item.year === year);
                return dataPoint ? dataPoint.count : 0;
            }),
            backgroundColor: '#FF6384', // Warna latar belakang
            borderColor: '#000000', // Warna border hitam
            borderWidth: 2, // Lebar border
            fill: false,
            tension: 0.1
        });
    });

    var realisasiTeamChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: uniqueYears,
            datasets: datasets
        },
        options: {
            scales: {
                x: {
                    ticks: {
                        autoSkip: true,
                        maxRotation: 45, // Memutar label sumbu X
                        minRotation: 45,
                        callback: function(value) {
                            // Format label untuk muat dalam area chart
                            return value.length > 10 ? value.slice(0, 10) + '...' : value;
                        }
                    },
                    title: {
                        display: true,
                        text: 'Year'
                    },
                    grid: {
                        offset: true
                    }
                },
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Count'
                    }
                }
            },
            layout: {
                padding: {
                    left: 20,
                    right: 20,
                    top: 20,
                    bottom: 40
                }
            }
        }
    });
}

function renderChartRealisasiKaryawan(data) {
    var ctx = document.getElementById('realisasiKaryawanChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: data.map(item => item.company_name),
            datasets: [{
                label: 'Realisasi Jumlah Peserta',
                data: data.map(item => item.employee_count),
                backgroundColor: ['#36A2EB', '#FF6384', '#4BC0C0', '#FF9F40', '#9966FF', '#FFCD56', '#C9CBCF', '#E0AED0', '#FFC004', 'FF9800'],
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                x: {
                    ticks: {
                        autoSkip: true,
                        maxRotation: 45, // Rotate x-axis labels
                        minRotation: 45,
                        callback: function(value) {
                            // Format label to fit within the chart area
                            return value.length > 10 ? value.slice(0, 10) + '...' : value;
                        }
                    },
                    title: {
                        display: true,
                        text: 'Company'
                    }
                },
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Count'
                    }
                }
            },
            layout: {
                padding: {
                    left: 20,
                    right: 20,
                    top: 20,
                    bottom: 40 // Add padding to bottom to fit x-axis labels
                }
            }
        }
    });
}
        function renderChartBenefit(data) {
            var ctx = document.getElementById('horizontalBenefitChart').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: data.map(item => item.co_name),
                    datasets: [{
                        label: 'Total',
                        data: data.map(item => item.total ? parseFloat(item.total) : 0),
                        backgroundColor: ['#36A2EB', '#FF6384', '#4BC0C0', '#FF9F40', '#9966FF', '#FFCD56', '#C9CBCF', '#E0AED0', '#FFC004', '#FF9800'],
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    indexAxis: 'y',
                    scales: {
                        x: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Total' /*Keterangan sumbu X*/
                            }
                        },
                        y: {
                            title: {
                                display: true,
                                text: 'Company' /*Keterangan sumbu Y*/
                            }
                        }
                    }
                }
            });
        }

        function getRandomColor() {
            var letters = '0123456789ABCDEF';
            var color = '#';
            for (var i = 0; i < 6; i++) {
                color += letters[Math.floor(Math.random() * 16)];
            }
            return color;
        }</script>
@endpush
