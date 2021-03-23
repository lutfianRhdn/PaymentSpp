
<template>
    <app-layout>
        <template #header>
            <h1>class Managemnet</h1>
        </template>
        <div class="">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="overflow-hidden w-4/5 mx-auto rounded-lg">
                    <card title="Create New classes">
                        <form @submit.prevent="createclasses" action="{{route('classes.update')}}">
                            <div class="px-4 py-5 bg-white sm:p-6 ">
                                <div class="flex justify-around md:flex-row flex-col">
                                   <div class="flex justify-around ">
                                        <div class=" my-3 flex flex-col ">
                                            <label for="level" class="block"> level</label>
                                            <input-component  type="text" class="w-full" placeholder="x" v-model="form.level"/>
                                            <input-error :message="errors.level">  </input-error>
                                        </div>
                                       <div class="my-3 flex flex-col">
                                           <label for="">Major</label>
                                           <select name="major" id="major" v-model="form.major" placeholder="Rekayasa Perangkat Lunak">
                                               <option v-for="major in majors" :key="major.id" :value="major.id" >{{major.name}}</option>
                                           </select>
                                            <input-error :message="errors.major">  </input-error>

                                       </div>
                                        <div class=" my-3  ">
                                            <label for="lanbel" class="block">label</label>
                                            <input-component  type="text" class="w-full" v-model="form.label" placeholder="1"/>
                                            <input-error :message="errors.label">  </input-error>
                                        </div>
                                    </div>
                                     
                                </div>
                            </div>

                            <div class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6 shadow sm:rounded-bl-md sm:rounded-br-md"
                                >
                            <action-message :on="form.recentlySuccessful" class="mr-3">
                                Updated.
                            </action-message>           
                            <button-component type="submit" bg="bg-green-400 hover:bg-green-600">Update</button-component>
                            </div>
                        </form>
                    </card>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import Card from '@/Jetstream/Card'
    import FormSection from '../../Jetstream/FormSection.vue'
    import InputComponent from '../../Jetstream/Input.vue'
    import JetSecondaryButton from '@/Jetstream/SecondaryButton'
    import ButtonComponent from '@/Jetstream/Button'
import InputError from '../../Jetstream/InputError.vue'
import ActionMessage from '@/Jetstream/ActionMessage'

// import Select2 from 'v-select2-component';

    export default {
        components: {
            AppLayout,
            Card,
            FormSection,
            JetSecondaryButton,
            ButtonComponent,
                InputComponent,
                InputError,
                ActionMessage,
            // Select2
        },
        props:['errors','classes','majors'],
        data() {
            return {
               form: this.$inertia.form({
                    _method: 'POST',
                    major: this.classes.major_id,
                    label:this.classes.label,
                    level: this.classes.level,
                }),

            }
        },
        methods: {
            createclasses() {
                this.form.put(route('classes.update',this.classes.id), {
                    preserveScroll: true
                });
            },

            
        },
    }

</script>

<style>

</style>
