@extends('layouts.app')
@section('title', 'Total Benefit Chart | Dashboard')

@section('content')
    <div class="container mt-3">
        @if ($isSuperadmin)
            <div class="card">
                <div class="card-header" style="background-color: #eb4a3a">
                    <h5 class="text-white">Total Finansial Benefit per Perusahaan </h5>
                </div>
                <div class="card-body">
                    <canvas id="total-benefit-chart" style="height: 35rem;"></canvas>
                </div>
            </div>
            <x-dashboard.potential-benefit-total-chart />
            <x-dashboard.financial-benefit-chart-companies />
        @else
            <x-dashboard.financial-benefit-total-chart :is-superadmin="auth()->user()->role === 'Superadmin'" :user-company-code="auth()->user()->company_code" />
            <x-dashboard.potential-benefit-total :is-superadmin="auth()->user()->role === 'Superadmin'" :user-company-code="auth()->user()->company_code" />
        @endif

    </div>
@endsection


<script>
    const chartDataTotalBenefit = @json($chartDataTotalBenefit);
</script>

<script src="{{ asset('/build/assets/totalBenefitChart-5f117818.js') }}" type="module"></script>