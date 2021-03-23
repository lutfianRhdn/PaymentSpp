<template>
  <app-layout>
        <template #header>
        <h1>class Managemnet</h1>
        </template>
            <div class="">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl w-4/5 mx-auto rounded-lg">
                    <card title="Show Student " > 
                        <div class="mx-10 flex mb-5 my-5">
                            <!-- <img v-bind:src="class.user.profile_photo_path == null ? class.user.profile_photo_url+'&size=512' : '' " class="w-1/4 shadow-lg" :alt=" class.user.name"> -->
                            <div  class="mx-5">
                                <h1 class="text-3xl font-bold uppercase">{{classes.level}} {{classes.major.label}} {{classes.label}}  <span class="font-normal"> {{ classes.major.name}} </span></h1>
                                <h2 class="text-xl capitalize font-thin	"> Students Total{{ classes.major.name}}</h2>
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
                date = this.classes.created_at
                console.log('date',date);
                console.log(moment(date));
                return moment(date).format('D/M/Y ');
            }
        },
        props:['classes'],
        components: {
            AppLayout,
            Card,
            moment
        },
    }
</script>

<style>

</style>