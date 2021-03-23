
<template>
    <app-layout>
        <template #header>
            <h1>class Managemnet</h1>
        </template>
        <div class="">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="overflow-hidden w-4/5 mx-auto rounded-lg">
                    <card title="Create New tuition">
                        <form @submit.prevent="createtuition" action="{{route('tuition.update')}}">
                            <div class="px-4 py-5 bg-white sm:p-6 ">
                                <div class="flex justify-around w-full md:flex-row flex-col">
                                   <div class="flex justify-around ">
                                        <div class=" my-3 flex flex-col ">
                                            <label for="nominal" class="block"> Nominal</label>
                                            <input-component  type="text" class="w-full" placeholder="x" v-model="form.nominal"/>
                                            <input-error :message="errors.nominal">  </input-error>
                                        </div>
                                        <div class=" my-3  ">
                                            <label for="year" class="block">year</label>
                                            <input-component  type="text" class="w-full" readonly v-model="form.year" placeholder="1"/>
                                            <input-error :message="errors.yar">  </input-error>
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
        props:['errors','tuition'],
        data() {
            return {
               form: this.$inertia.form({
                    _method: 'POST',
                    year:this.tuition.year,
                    nominal:this.tuition.nominal
                }),

            }
        },
        methods: {
            createtuition() {
                this.form.put(route('tuitions.update',this.tuition.id), {
                    preserveScroll: true
                });
            },

            
        },
    }

</script>

<style>

</style>
