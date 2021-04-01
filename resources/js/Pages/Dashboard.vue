<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl w-4/5 mx-auto rounded-lg">
                    <card title="test" class="px-5" >
                        Payment of The Month : {{ paymentOfTheMonth }}/{{ totalStudent }}
                        <br>
                        Payment of The Year : {{ paymentOfTheYear }}
                        <br>

                        officer : {{ totalStudent }}
                        <hr>
                        <ul>
                            <li v-for="month in months" :key="month">
                                {{month}} : {{this.getNominal(month)}}

                            </li>
                        </ul>
                    </card>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import Card from '@/Jetstream/Card'

    export default {
        props:['paymentOfTheMonth','paymentOfTheYear','totalStudent','totalOfficer','months','totalPayments'],
        components: {
            AppLayout,
            Card,
        },
        methods:{
            getNominal(month){
                const data = this.totalPayments.filter(el =>el.month == month)
                 return data.length !== 0  ? data[0].nominal :0
            }
        }
    }
</script>
