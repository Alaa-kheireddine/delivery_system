<div class="row g-3 mb-4 mt-4">

    @if (auth()->user()->hasRole('admin'))
        <div class="col-12 col-lg-8">
            <div class="card-box p-3">
                <h6 class="fw-bold mb-3">Shipments Per Branch</h6>

                <div class="chart-box">
                    <canvas id="shipmentsPerBranchChart" ></canvas>
                </div>
            </div>
        </div>
    @endif

    <div class="col-12 {{ auth()->user()->hasRole('admin') ? 'col-lg-4' : 'col-lg-12' }}">
        <div class="card-box p-3">
            <h6 class="fw-bold mb-3">Shipment Status Distribution</h6>

            <div class="chart-box small">
                <canvas id="shipmentStatusChart"></canvas>
            </div>
        </div>
    </div>

</div>

<style>
    .chart-box {
        position: relative;
        height: 500px;
        width: 100%;
    }

    .chart-box.small {
        height: 500px;
    }
</style>

<script src="{{ asset('assets/js/chart.js') }}"></script>

<script>
    const chartData = @json($chartData);

    const staticData = {
        branch_names: ['Beirut Branch', 'Tripoli Branch', 'Saida Branch'],
        branch_shipments: [12, 7, 4],

        statuses: ['pending', 'in_stock', 'delivered', 'cancelled'],
        status_values: [5, 8, 7, 3]
    };

    new Chart(document.getElementById('shipmentsPerBranchChart'), {
        type: 'bar',
        data: {
            labels: chartData.branch_names,
            datasets: [{
                label: 'Shipments',
                data: chartData.branch_shipments,
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
        }
    });

    new Chart(document.getElementById('shipmentStatusChart'), {
        type: 'doughnut',
        data: {
            labels: chartData.statuses,
            datasets: [{
                data: chartData.status_values
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
        }
    });
</script>
