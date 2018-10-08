<v-card class="transparent elevation-0">
    <v-card-text>
        <div class="mini-chart-container">
            <canvas id="perf-donut-1"></canvas>
        </div>
    </v-card-text>
</v-card>

@push('css')
    <style>
        .mini-chart-container {
            position: relative;
        }
    </style>
@endpush

@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.bundle.min.js"></script>
    <script>

        var ctx = document.getElementById('perf-donut-1').getContext('2d');
        var gradient = ctx.createLinearGradient(0, 0, 0, 170);
        gradient.addColorStop(0.25, 'rgba(156, 39, 176, 0.40)');
        gradient.addColorStop(0.5, 'rgba(156, 39, 176, 0.20)');
        gradient.addColorStop(1, 'rgba(156, 39, 176, 0)');

        Chart.defaults.global.defaultFontColor = '#000';
        var gradient = ctx.createLinearGradient(0, 0, 0, 100);
        gradient.addColorStop(0.25, 'rgba(48, 63, 159, 0.8)');
        gradient.addColorStop(0.5, 'rgba(48, 63, 159, 0.5)');
        gradient.addColorStop(1, 'rgba(48, 63, 159, 0)');

        Chart.defaults.global.defaultFontColor = '#000';
        Chart.defaults.global.legend.labels.usePointStyle = true;
        var chart  = new Chart(ctx, {
            type: 'doughnut',

            data: {
                labels: ["DPE SUP", "DPE OPS", "PSM SUP"],
                datasets: [{
                    backgroundColor: [
                        "rgba(41, 121, 255, .7)", //blue accent-3
                        "rgba(57, 73, 171, .7)", //blue accent-2
                        "rgba(130, 177, 255, .7)", //blue accent-1
                    ],
                    opacity: "0.1",
                    borderColor: 'rgba(6, 23, 68, .02)',
                    borderWidth: 0,
                    data: [20, 56, 39],

                }]
            },

            options: {
                cutoutPercentage: 70,
                responsive: true,
                maintainAspectRatio: false,
                animation: {
                    duration: 1000,
                    easing: 'easeOutCubic'
                },
                legend: {
                    position: 'bottom',
                    display: true,
                    labels: {
                        fontColor: '#000',
                    },
                },
                elements: {
                    arc: {
                        borderWidth: 18,
                    },
                },
            }
        });
    </script>
@endpush
