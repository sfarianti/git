@extends('layouts.app')
@section('title', 'Chart Total Tim | Dashboard')

@section('content')
    <div class="container mt-3">
        <div class="card">
            <div class="card-header" style="background-color: #eb4a3a">
                <h5 class="text-white">Chart Total Inovasi Di Tiap Perusahaan</h5>
            </div>
            <div class="card-body">
                <canvas id="total-team-chart"></canvas>
            </div>
        </div>

        <!-- Tambahkan variabel chartData ke JavaScript -->
        <script>
            const chartDataTotalTeam = @json($chartDataTotalTeam);
        </script>
        <x-dashboard.total-company-innovator-chart />

    </div>
@endsection

<script src="{{ asset('build/assets/totalTeamChart-825c7226.js') }}" type="module"></script>
