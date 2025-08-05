<div class="card mt-3">
    <div class="card-header" style="background-color: #eb4a3a">
        <h5 class="text-white">Total Potensial Benefit per Perusahaan </h5>
    </div>
    <div class="card-body">
        <canvas id="total-potential-benefit-chart" style="height: 35rem;"></canvas>
    </div>
</div>


<script>
    const chartDataTotalPotentialBenefit = @json($chartDataTotalPotentialBenefit);
</script>

<script src="{{ asset('/build/assets/totalBenefitChart-5f117818.js') }}" type="module"></script>