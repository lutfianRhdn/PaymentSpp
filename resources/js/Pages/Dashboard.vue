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
                    <card title="Dashboard" class="px-5" >
                        
                        <div class="flex grid-rows-3 gap-3">
                            <div class="bg-white overflow-hidden shadow-xl w-1/4 h-2/4 mx-auto rounded-xl">
                                <card title="Payment of The Month : " > 
                                    {{ paymentOfTheMonth }}/{{ totalStudent }}
                                </card>
                            </div>

                            <div class="bg-white overflow-hidden shadow-xl w-1/4 h-2/4 mx-auto rounded-xl">
                                <card title="Payment of The Year : " > 
                                    {{ paymentOfTheYear }}
                                </card>
                            </div>

                            <div class="bg-white overflow-hidden shadow-xl w-1/4 h-2/4 mx-auto rounded-xl">
                                <card title="Officer : " > 
                                    {{ totalOfficer }}
                                </card>
                            </div>

                            <div class="bg-white overflow-hidden shadow-xl w-1/4 mx-auto rounded-xl">
                                <card title="Monthly : " > 
                                    <ul>
                                        <li v-for="month in months" :key="month">
                                            {{month}} : {{this.getNominal(month)}}
                                        </li>
                                    </ul>
                                </card>
                            </div>

                        </div>

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
