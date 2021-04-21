
<template>
    <app-layout>
        <template #header>
            <h1>tuitions Management</h1>
        </template>
        <div class="">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="overflow-hidden w-4/5 mx-auto rounded-lg">
                    <card title="Create New tuitions">
                        <form @submit.prevent="createtuitions" action="{{route('tuitions.store')}}">
                            <div class="px-4 py-5 bg-white sm:p-6 w-full">
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

                            <div class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6 shadow sm:rounded-bl-md sm:rounded-br-md"
                                >
                                <action-message :on="form.recentlySuccessful" class="mr-3">
                                    Saved.
                                </action-message>

                                <button-component type="submit" class="bg-blue-400 hover:bg-blue-600"
                                :class="{ 'opacity-25 rounded-md': form.processing }" :disabled="form.processing"
                                >Submit</button-component>

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
        props:['errors','year'],
        data() {
            return {
               form: this.$inertia.form({
                    _method: 'POST',
                    nominal: '',
                    year:this.year,
                }),
            }
        },
        methods: {
            createtuitions() {
                this.form.post(route('tuitions.store'), {
                    preserveScroll: true
                });
            },

        },
    }

</script>

<style>

</style>
