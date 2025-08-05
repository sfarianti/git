<div class="card p-3">
    <h2 class="chart-title text-center">Total Potensial Benefit Per
        @php
            $labels = [
                'unit_name' => 'Unit',
                'directorate_name' => 'Direktorat',
                'group_function_name' => 'Group',
                'department_name' => 'Departemen',
                'section_name' => 'Seksi',
                'sub_section_of' => 'Sub Seksi',
            ];
        @endphp

        {{ $labels[$organizationUnit] ?? 'Unit Organisasi' }}
    </h2>
    <canvas id="totalPotentialChart" style="width: 100%;"></canvas>
    <div class="mt-3 text-end">
        <button class="btn btn-sm btn-success export-excel-totalPotentialBenefitByOrganizationChart">Export to Excel</button>
        <button class="btn btn-sm btn-danger export-pdf-totalPotentialBenefitByOrganizationChart">Export to PDF</button>
    </div>
</div>

@vite(['resources/js/totalPotentialBenefitByOrganizationChart.js'])

<script type="module">
    document.addEventListener("DOMContentLoaded", function () {
        const chartData = @json($chartData); // Kirim data ke JavaScript
        const company_name = @json($company_name);
        
        window.chartData = chartData; // Store chart data globally
        window.company_name = company_name; // Store company name globally

        // Kalau kamu ingin langsung render dari sini (optional):
        if (typeof window.initializeTotalPotentialChart === 'function') {
            window.initializeTotalPotentialChart(chartData);
        }
    });
</script>

<script type="module" src="{{ asset('build/assets/totalPotentialBenefitByOrganizationChart-0ac2bbcd.js') }}"></script>
<script type="module" src="{{ asset('build/assets/exportTotalPotentialBenefitByOrganizationChart-f7299526.js') }}"></script>
