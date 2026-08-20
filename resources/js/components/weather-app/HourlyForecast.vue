<template>
    <div class="mt-6 bg-white rounded-md border border-gray-200">
        <div class="p-6">
            <h2 class="text-xl font-semibold text-gray-900">Next 24 hours</h2>
            <p class="mt-1 text-sm text-gray-500">Temperature forecast</p>
            <div ref="chart" class="mt-6"></div>
        </div>
    </div>
</template>

<script>
    import ApexCharts from 'apexcharts';

    export default {
        props: {
            weather: {
                type: Object,
                required: true
            }
        },

        data: function()
        {
            return {
                chart: null
            }
        },

        mounted()
        {
            this.renderChart();
        },

        beforeUnmount()
        {
            if (this.chart) {
                this.chart.destroy();
            }
        },

        watch: {
            weather: {
                deep: true,

                handler: function()
                {
                    this.renderChart();
                }
            }
        },

        methods: {
            getHourlyData: function()
            {
                const currentIndex = this.weather.hourly.time.findIndex((time) => {
                    return time >= this.weather.current.time;
                });

                const startIndex = currentIndex === -1 ? 0 : currentIndex;

                const endIndex = startIndex + 24;

                return {
                    times: this.weather.hourly.time.slice(startIndex, endIndex),
                    temperatures: this.weather.hourly.temperature_2m.slice(startIndex, endIndex)
                };
            },

            formatTime: function(time)
            {
                return time.split('T')[1];
            },

            renderChart: function()
            {
                const hourly = this.getHourlyData();

                const options = {
                    chart: {
                        type: 'area',
                        height: 300,
                        toolbar: {
                            show: false
                        },
                        zoom: {
                            enabled: false
                        }
                    },

                    series: [
                        {
                            name: `Temperature (${this.weather.hourly_units.temperature_2m})`,
                            data: hourly.temperatures.map(function(temperature)
                            {
                                return Math.round(temperature);
                            })
                        }
                    ],

                    xaxis: {
                        categories: hourly.times.map((time) => {
                            return this.formatTime(time);
                        }),

                        labels: {
                            rotate: 0,
                            hideOverlappingLabels: true
                        }
                    },
                    
                    yaxis: {
                        labels: {
                            formatter: function(value)
                            {
                                return Math.round(value) + '°';
                            }
                        }
                    },

                    stroke: {
                        curve: 'smooth',
                        width: 3
                    },

                    dataLabels: {
                        enabled: false
                    },

                    fill: {
                        opacity: 0.15
                    },

                    grid: {
                        borderColor: '#e5e7eb'
                    },

                    tooltip: {
                        y: {
                            formatter: (value) => {
                                return value + ' ' + this.weather.hourly_units.temperature_2m;
                            }
                        }
                    }
                };

                if (this.chart) {
                    this.chart.destroy();
                }

                this.chart = new ApexCharts(
                    this.$refs.chart,
                    options
                );

                this.chart.render();
            }
        }
    }
</script>