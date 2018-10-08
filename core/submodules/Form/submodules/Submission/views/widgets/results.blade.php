<v-card class="elevation-0">
    <v-toolbar class="elevation-0">
        <v-toolbar-title>{{ __('Statistics') }}</v-toolbar-title>
        <v-spacer></v-spacer>
        <v-btn flat primary v-tooltip:left="{html: 'Export Statistics Result'}">
            <v-icon left>fa fa-file-pdf-o</v-icon> {{ __('Export to PDF') }}
        </v-btn>
        {{-- <v-btn icon @click="p1 = !p1" v-tooltip:left="{ 'html':  p1 ? 'Show Analytics' : 'Hide Analytics' }">
            <v-icon>@{{ p1 ? 'add' : 'remove' }}</v-icon>
        </v-btn> --}}
    </v-toolbar>
    <v-card class="elevation-0 transparent" style="max-height: 70vh; overflow-y: auto;">
        <v-container fluid grid-list-lg>
            <v-layout row wrap justify-center align-center>
                <v-flex xs12>
                    <div class="chart-container mb-3">
                        {{-- <span v-for="(charts, i) in chartVariables.items" v-html="i"></span> --}}
                        <template v-for="(charts, i) in chartVariables.items">
                           <v-card-text class="px-0">
                                <ul>
                                    <li>
                                        <h1 class="subheading" v-html="charts.label"></h1>
                                        <canvas :id="`chart-${i}`"></canvas>
                                    </li>
                                </ul>
                           </v-card-text>
                       </template>
                    </div>
                </v-flex>
            </v-layout>
        </v-container>
    </v-card>
</v-card>

@push('css')
    <style>
        .chart-container {
            position: relative;
            height: 80vh;
        }
        #chartDiv,
        .chartjs-render-monitor {
            width: 100%;
            max-height: 250px !important;
        }
    </style>
@endpush

@push('pre-scripts')
    {{-- <script src="{{ assets('frontier/vendors/vue/resource/vue-resource.min.js') }}"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.bundle.min.js"></script>
    <script>
        // Vue.use(VueResource);
        mixins.push({
            data () {
                return {
                    chartVariables: [],
                }
            },
            methods: {
                getStatistic (query) {
                    let self = this;
                    query = query ? query : {};
                    self.api().post('{{ route('api.submissions.analytic') }}', query).then(data => {
                        self.chartVariables = data;
                        setTimeout(function () {
                            // body...
                        self.displayStatistic(self.chartVariables.items);
                        },100)
                    });
                },
                chartData (_data, _labels, label, id) {
                    var ctx = document.getElementById(id).getContext('2d');
                    var gradient = ctx.createLinearGradient(0, 0, 0, 100);
                    gradient.addColorStop(0.25, 'rgba(28, 160, 244, .8)');
                    gradient.addColorStop(0.5, 'rgba(28, 160, 244, .8)');
                    gradient.addColorStop(1, 'rgba(28, 160, 244, .8)');

                    Chart.defaults.global.defaultFontColor = '#333';
                    var chart = new Chart(ctx, {
                        type: 'bar',
                        scaleBeginAtZero : true,
                        data: {
                            labels: _labels,
                            datasets: [{
                                // label: null,
                                wrapText: true,
                                backgroundColor: gradient,
                                borderColor: "rgba(28, 160, 244, 1)", //blue
                                borderWidth: 3,
                                pointRadius: 5,
                                hoverBackgroundColor: "rgba(3, 169, 244, .8)",
                                hoverBorderColor: "rgba(3, 169, 244, .8)",
                                data: _data,
                            }]
                        },

                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            scales: {
                                yAxes: [{
                                    gridLines: {
                                        display: false,
                                        color: "rgba(255,99,132,0.2)"
                                    },
                                    ticks: {
                                        display: true,
                                        beginAtZero: true,
                                        padding: 10,
                                    }
                                }],
                                xAxes: [{
                                    gridLines: {
                                        display: false
                                    },
                                    ticks: {
                                        display: false,
                                    }
                                }]
                            },
                            animation: {
                                duration: 1000,
                                easing: 'easeOutCubic'
                            },
                            legend: {
                                display: false,
                                labels: {
                                    fontColor: '#333',
                                    fontSize: 18,
                                }
                            }
                        }
                    });
                },
                displayStatistic (dataset) {
                    let _dataset = [];
                    for (chart in dataset) {
                        let _labels = [];
                        let _data = [];

                        for (data in dataset[chart].data) {
                            _labels.push(data);
                            _data.push(dataset[chart].data[data]);
                        }

                        console.log(_data, _labels, dataset[chart].label);
                        this.chartData(_data, _labels, dataset[chart].label, "chart-"+chart);
                    }
                }
            },
            mounted () {
                this.getStatistic({form_id: '{{ $id }}'});
            }
        })
    </script>
@endpush
