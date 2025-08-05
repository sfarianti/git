<div class="card p-3 mt-3">
    <h5 class="text-center">Total Team per Tahap Penilaian</h5>
    <canvas id="totalInnovatorStagesChart"></canvas>
    <div class="mt-3 text-center">
        <button class="btn btn-success export-excel-totalInnovatorStages">Export to Excel</button>
        <button class="btn btn-danger export-pdf-totalInnovatorStages">Export to PDF</button>
    </div>
</div>

<script type="module">
    document.addEventListener("DOMContentLoaded", function () {
        const chartData = @json($chartData);
        const event_name = @json($event_name);

        window.chartDataExportTotalInnovatorStages = chartData;
        window.event_name = event_name;

        if (typeof window.renderTotalInnovatorStagesChart === 'function') {
            window.renderTotalInnovatorStagesChart('totalInnovatorStagesChart', chartData);
        }
    });
</script>

<script type="module" src="{{ asset('build/assets/totalInnovatorStages-286ed23d.js') }}"></script>
<script type="module" src="{{ asset('build/assets/exportTotalInnovatorStages-152e8980.js') }}"></script>

