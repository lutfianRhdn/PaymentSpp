<template>
  <app-layout>
        <template #header>
        <h1>Student Management</h1>
        </template>
            <div class="">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl w-4/5 mx-auto rounded-lg">
                    <card title="Show Student " > 
                        <div class="mx-10 flex mb-5">
                            <img v-bind:src="student.user.profile_photo_path == null ? student.user.profile_photo_url+'&size=512' : '' " class="w-1/4 shadow-lg" :alt=" student.user.name">
                            <div  class="mx-5">
                                <h1 class="text-3xl font-bold uppercase">{{student.user.name}}  <span class="font-normal"> | {{student.class.level}} {{student.class.major.label}} {{student.class.label}} </span></h1>
                                <h2 class="text-xl capitalize font-thin	">{{ student.user.email}}</h2>
                                <hr>
                                <div class="flex mt-5">
                                    <div>

                                        <p>Nis : {{student.nis}}</p>
                                        <p>Nisn : {{student.nisn}}</p>
                                    </div>
                                    <div class="ml-10">
                                        <p>Nomor Telephone : {{student.phone}}</p>
                                        <p>Address : {{student.address}}</p>
                                    </div>
                                </div>
                                Payments : <inertia-link :href="route('payments.show',student.id)" class=" bg-blue-500 hover:bg-blue-400 px-4 shadow-md rounded text-white ">
                                    {{student.payments.length}}
                                </inertia-link>
                            </div>
                        </div>
                        <hr>
                        <div class="w-full mt-3">
                            <div class="flex align-end mx-10  justify-center">
                            <p class="ml-auto">{{ setFormatDate }}</p>
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
    import moment from 'moment'

    export default {
        computed:{
            setFormatDate(date){
                date = this.student.user.created_at
                console.log('date',date);
                console.log(moment(date));
                return moment(date).format('D/M/Y ');
            }
        },
        props:['student'],
        components: {
            AppLayout,
            Card,
            moment
        },
    }
</script>

<style>

</style>