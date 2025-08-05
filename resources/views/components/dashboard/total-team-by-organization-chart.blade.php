<div class="card p-2">
    <h2 class="chart-title text-center">Distribusi Ide
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
    <canvas id="totalTeamChart"  style="width: 100%; height: 20rem;"></canvas>
    <div class="mt-3 text-end">
        <button class="btn btn-sm btn-success export-excel">Export to Excel</button>
        <button class="btn btn-sm btn-danger export-pdf">Export to PDF</button>
    </div>
</div>
@vite(['resources/js/totalTeamByOrganization.js']);

<script type="module">
    document.addEventListener("DOMContentLoaded", function () {
        const chartData = @json($chartData); // Kirim data ke JavaScript
        const company_name = @json($company_name);
        
        window.chartData = chartData; // Store chart data globally
        window.company_name = company_name; // Store company name globally

        // Kalau kamu ingin langsung render dari sini (optional):
        if (typeof window.initializeTotalTeamChart === 'function') {
            window.initializeTotalTeamChart(chartData);
        }
    });
</script>

<script type="module" src="{{ asset('build/assets/totalTeamByOrganizationChart-60b5b131.js') }}"></script>
<script type="module" src="{{ asset('build/assets/exportTotalTeamByOrganization-2b7c41f1.js') }}"></script>
