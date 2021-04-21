<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="">
            <div class="max-w-7xl mx-auto lg:my-10 md:my-9 sm:my-8 lg:px-8 md:px-7 sm:px-6">

                <div class="flex mx-auto lg:my-10 md:my-9 sm:my-8 lg:px-10 md:px-9 sm:px-8 gap-2">

                    <div
                        class="flex bg-white overflow-hidden shadow-xl lg:w-1/4 lg:h-1/2 md:w-1/4 md:h-1/2 sm:w-1/5 sm:h-2/5 mx-auto lg:p-5 md:p-3.5 sm:p-2.5 rounded-xl">
                        <div class="flex flex-row items-center">
                            <div class="flex px-1">
                                <div class="rounded-full lg:p-3 sm:p-0 bg-gray-200">
                                    <i class="fa fa-wallet fa-fw text-green-500"></i>
                                </div>
                            </div>
                            <div class="flex flex-col items-center">
                                <h3 class="font-bold lg:text-3xl sm:text-xl">{{ paymentOfTheMonth }}/{{ totalStudent }}
                                </h3>
                                <h5 class="font-bold text-gray-500 text-center lg:text-base sm:text-xs">Payment of The
                                    Month</h5>
                            </div>
                        </div>
                    </div>

                    <div
                        class="flex bg-white overflow-hidden shadow-xl lg:w-1/3 lg:h-1/2 sm:w-1/3 sm:h-1/2 mx-auto lg:p-8 sm:p-8 rounded-xl">
                        <div class="flex flex-row items-center">
                            <div class="flex-shrink pr-4">
                                <div class="rounded-full p-3 bg-gray-200">
                                    <i class="fa fa-dollar-sign fa-fw text-green-500"></i>
                                </div>
                            </div>
                            <div class="flex flex-col items-center">
                                <h3 class="font-bold lg:text-3xl sm:text-xl">Rp.{{ paymentOfTheYear }} <span
                                        class="text-green-500"><i class="fas fa-caret-up"></i></span></h3>
                                <h5 class="font-bold text-gray-500 text-center lg:text-base sm:text-xs">Payment of The
                                    Year</h5>
                            </div>
                        </div>
                    </div>

                    <div class="flex bg-white overflow-hidden shadow-xl lg:w-1/4 lg:h-1/2 mx-auto lg:p-8 rounded-xl">
                        <div class="flex flex-row items-center">
                            <div class="flex-shrink pr-4">
                                <div class="rounded-full p-3 bg-gray-200">
                                    <i class="fa fa-users fa-fw text-green-500"></i>
                                </div>
                            </div>
                            <div class="flex flex-col items-center mx-5">
                                <h3 class="font-bold text-3xl">{{ totalOfficer }}</h3>
                                <h5 class="font-bold text-gray-500 text-center lg:text-base">Officer</h5>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="flex mx-auto px-10 items-center ">
                    <div class="flex bg-white overflow-hidden w-screen shadow-xl w-5/12 h-1/2 mx-auto p-8 rounded-xl">
                        <div class="flex flex-row items-center w-full justify-between">

                            <apexchart width="500" type="area" :options="chartOptions" :series="series"></apexchart>
                            
                            <div class="flex flex-col items-center">
                                <div class="flex bg-white overflow-hidden shadow-xl w-full h-1/2 mx-auto p-8 rounded-xl">
                                    <table class="table-fixed">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Month</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="payment in payments " :key="payment.id">
                                                <td>{{payment.student.user.name}}</td>
                                                <div class="ml-6">
                                                    <td>{{payment.month}}</td>
                                                </div>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>

    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import Card from '@/Jetstream/Card'
    import ApexCharts from 'vue3-apexcharts'
    import numeral from 'numeral'

    export default {
        props: ['paymentOfTheMonth', 'paymentOfTheYear', 'totalStudent', 'totalOfficer', 'months', 'totalPayments',
            'payments'
        ],
        components: {
            AppLayout,
            Card,
            apexchart: ApexCharts,
        },
        data: function () {
            let result = this.months.map(month => {
                //  console.log()
                return this.getNominal(month)
            })
            return {
                chartOptions: {
                    chart: {
                        id: "vuechart-example",
                    },
                    xaxis: {
                        categories: this.months,
                    },
                    yaxis: {
                        labels: {
                            formatter: function (value) {
                                return numeral(value).format('0.0a');
                            },
                            formatter: function (val, opt) {
                                return numeral(val).format('0.0a')
                            },
                        },
                    },
                    colors:['#10B981', '#6EE7B7', '#1D4ED8']
                },
                sparkline: {
                    enabled: true
                },
                series: [{
                    name: "Total",
                    data: result,
                }, ],
            };
        },
        methods: {
            getNominal(month) {
                const data = this.totalPayments.filter(el => el.month == month)
                return data.length !== 0 ? data[0].nominal : 0
            },
            kFormatter(num) {
                return Math.abs(num) > 999 ? Math.sign(num) * ((Math.abs(num) / 1000).toFixed(1)) + 'k' : Math.sign(
                    num) * Math.abs(num)
            }

        }
    }

</script>
