@extends('layouts.app')

@section('title', 'Detail ' . $company->company_name)

<link rel="stylesheet" href="{{ asset('build/assets/detailCompanyChart-22b7fdae.css') }}">

@push('css')
    <style>
        .benefit-card {
            background-color: #ffffff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .benefit-title, .innovator-title {
            font-size: 1rem;
            font-weight: bold;
            margin-bottom: 15px;
            color: #1D1616;
        }

        .benefit-stat {
            text-align: center;
        }

        .benefit-value, .innovator-value, .gender-value {
            font-size: 1.2rem;
            font-weight: bold;
        }

        .innovator-value, .gender-value {
            color: #8E1616;
        }

        .benefit-value {
            color: #28a745;
        }

        .btn-filter {
            background-color: #8E1616;
            color: #EEEEEE;
            text-transform: capitalize;
        }

        .btn-filter:hover {
            background-color: #EEEEEE;
            border: 2px solid #8E1616;
            color: #8E1616;
            font-weight: 600;
        }
    </style>
@endpush

@section('content')
    <div class="container mt-4">
        <h2 class="mb-4">Dashboard: <span class="company-name">{{ $company->company_name }}</span></h2>
        <div class="row justify-content-center">
            <div class="col-lg-7 col-md-6 col-sm-12">
                <x-detail-company-chart.paper-count :company-id="$company->id" />
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="row">
                    <div class="innovator-card">
                        <h3 class="innovator-title">Data Inovator</h3>
                        <div class="innovator-stat">
                            <span class="innovator-label">Total Inovator</span>
                            <span class="innovator-value">{{ $totalInnovators }}</span>
                        </div>
                        <div class="innovator-gender">
                            <div class="gender-stat">
                                <div class="gender-value">{{ $maleCount }}</div>
                                <div class="gender-label">Laki-laki</div>
                            </div>
                            <div class="gender-stat">
                                <div class="gender-value">{{ $femaleCount }}</div>
                                <div class="gender-label">Perempuan</div>
                            </div>
                            <div class="gender-stat">
                                <div class="gender-value">{{ $outsourceInnovatorData }}</div>
                                <div class="gender-label">Outsource</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="benefit-card">
                        <h3 class="benefit-title">Total Potential Benefit</h3>
                        <div class="benefit-stat">
                            <span class="benefit-value">Rp {{ $formattedTotalPotentialBenefit }}</span>
                        </div>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="benefit-card">
                        <h3 class="benefit-title">Total Real Financial Benefit</h3>
                        <div class="benefit-stat">
                            <span class="benefit-value">Rp {{ $formattedTotalFinancialBenefit }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-12">
                <x-dashboard.company.total-innovator-with-gender-chart :companyId="$company->company_code" />
            </div>
            <div class="col-md-4 col-sm-4 col-xs-6">
                <button type="button" class="btn btn-filter" data-bs-toggle="modal" data-bs-target="#filterModal">
                    Filter bedasarkan unit organisasi
                </button>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-6">
                <h4 class="text-center">Grafik pada tahun {{ $year }}</h4>
            </div>
        </div>
        <x-detail-company-chart.filter-by-organization-unit :organization-unit="$organizationUnit" :company-id="$company->company_code" :company-code="$company->code" :available-years="$availableYears" />
        <div class="row mt-4">
            <div class="col-lg-12 col-md-12">
                {{-- Blade component total team innovations by organization charts --}}
                <x-dashboard.total-team-by-organization-chart
                    :organizationUnit="$organizationUnit"
                    :companyId="$company->id"
                    :year="$year"
                />
            </div>
            <div class="col-lg-12 col-md-12">
                {{-- Blade component total innovator by organization charts --}}
                <x-dashboard.total-innovator-by-organization-charts
                    :organization-unit="$organizationUnit"
                    :company-id="$company->id"
                    :year="$year"
                />
            </div>
            <div class="col-lg-12 col-md-12 mt-5">
                {{-- Blade component total financial benefit by organization charts --}}
                <x-dashboard.total-financial-benefit-by-organization-chart
                    :organizationUnit="$organizationUnit"
                    :companyId="$company->id"
                    :year="$year"
                />

            </div>
            <div class="col-lg-12 col-md-12 mt-4">
                {{-- Blade component total potential benefit by organization charts --}}
                <x-dashboard.total-potential-benefit-by-organization-chart 
                    :organizationUnit="$organizationUnit" 
                    :companyId="$company->id" 
                    :year="$year"
                />
            </div>
        </div>

    </div>
    <script src="{{ asset('build/assets/companyDashboardChart-69e6f61b.js') }}" type="module"></script>
@endsection
