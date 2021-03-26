
<template>
    <app-layout>
        <template #header>
            <h1>payments Managemnet</h1>
        </template>
        <div class="">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="overflow-hidden w-4/5 mx-auto rounded-lg">
                    <card title="Create New payments">
                        <form @submit.prevent="createpayments" action="{{route('payments.store')}}">
                            <div class="px-4 py-5 bg-white sm:p-6 w-full">
                            <input-error :message="errors.tuition" class=" mx-auto text-xl"></input-error>
                                    <div class="flex justify-around ">
                                        <div class=" my-3 flex flex-col w-full">
                                            <label for="nominal" class="block">Class</label>
                                               <multiselect
                                                    v-model="form.class"
                                                    :options="classes"
                                                    class="w-full"
                                                    @change="changeUser"
                                                    >
                                                    <template v-slot:singlelabel="{ value }">
                                                        <div class="multiselect-single-label">
                                                       <p> {{ value.name }} </p>
                                                        </div>
                                                    </template>
                                                      <template v-slot:option="{ option }">
                                                        <p> {{ option.name }} </p>
                                                    </template>
                                                    </multiselect>
                                            <!-- <select name="class" id="" @change="changeUser">
                                                <option v-for="student  in students " :key="student.id" value="{{ student.id }}">{{student.user.name}} - {{ student.class.level }} {{ student.class.major.label }} {{ student.class.label}}</option>
                                                <option v-for="classs  in classes " :key="classs.id" :value="classs.id" > {{ classs.level }} {{ classs.major.label }} {{ classs.label}}</option>
                                            </select> -->
                                       
                                            <input-error :message="errors.nominal">  </input-error>
                                        </div>
                                        <div class="my-3 w-full">
                                            <label for="nominal" class="block">Student</label>
                                                    <multiselect
                                                    v-model="form.student"
                                                    :options="students"
                                                    class="w-full"
                                                    ref="multiselect"

                                                    >
                                                    <template v-slot:singlelabel="{ value }">
                                                        <div class="multiselect-single-label">
                                                       <p> {{ value.name }} </p>
                                                        </div>
                                                    </template>
                                                      <template v-slot:option="{ option }">
                                                        <p> {{ option.name }} </p>
                                                    </template>
                                                    </multiselect>
                                                <!-- <select name="student" id="" v-model="form.student" class="w-full">
                                                <option v-for="student  in students " :key="student.id" :value="student.id" > {{student.user.name}}</option>
                                            </select> -->
                                        </div>
                                        <div class="my-3 w-full">
                                            <label for="nominal" class="block">Student</label>
                                                <!-- <select2 v-model="myValue" :options="myOptions" :settings="{ settingOption: value}" /> -->
                                                  <multiselect
                                                    v-model="form.month"
                                                    :options="months"
                                                    class="w-full"
                                                    mode="multiple"
                                                    >
                                                      <template v-slot:multiplelabel="{ values }">
                                                        <div class="multiselect-multiple-label flex flex-wrap">
                                                            <p v-for="value in values" :key="value" class="mr-2 bg-green-300 text-white shadow px-3 py-1 rounded-full text-sm">{{ value.label }}</p>
                                                        </div>
                                                    </template>
                                                </multiselect>
                                        </div>
                                    </div>
                                     <div class="col-span-6 sm:col-span-4 flex flex-col items-center " v-if="$page.props.jetstream.managesProfilePhotos">
                                        <!-- Profile Photo File Input -->
                                        <input type="file" class="hidden"
                                                    ref="photo"
                                                    @change="updatePhotoPreview">

                                        <jet-label for="photo" value="Photo" />

                                        <!-- Current Profile Photo -->
                                        <div class="mt-2" v-show="! photoPreview">
                                            <img src="https://ui-avatars.com/api/?name=Sp&color=7F9CF5&background=EBF4FF&size512" alt="user.name" class="rounded shadow-lg   w-96 ">
                                        </div>

                                        <!-- New Profile Photo Preview -->
                                        <div class="mt-2" v-show="photoPreview">
                                            <span class="block  w-52 h-52 shadow-lg "
                                                :style="'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' + photoPreview + '\');'">
                                            </span>
                                        </div>

                                        <jet-secondary-button class="mt-2 mr-2" type="button" @click.prevent="selectNewPhoto">
                                            Select A New Photo
                                        </jet-secondary-button>

                                        <jet-input-error :message="form.errors.photo" class="mt-2" />
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
import axios  from "axios";
    import AppLayout from '@/Layouts/AppLayout'
    import Card from '@/Jetstream/Card'
    import FormSection from '../../Jetstream/FormSection.vue'
    import InputComponent from '../../Jetstream/Input.vue'
    import JetSecondaryButton from '@/Jetstream/SecondaryButton'
    import ButtonComponent from '@/Jetstream/Button'
    import InputError from '../../Jetstream/InputError.vue'
    import ActionMessage from '@/Jetstream/ActionMessage'
  import Multiselect from '@vueform/multiselect'

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
                Multiselect,
        },
        props:['errors','officers','classes','months'],
        data() {
            return {
               form: this.$inertia.form({
                    _method: 'POST',
                    student: '',
                    photo: null,
                    month:[]
                }),
                photoPreview: null,
                students: [],
            }
        },
        methods: {
            createpayments() {
                      if (this.$refs.photo) {
                    this.form.photo = this.$refs.photo.files[0]
                }
                this.form.post(route('payments.store'), {
                    preserveScroll: true
                });
            },
        changeUser(id){
            axios.get(route('payments.getUser',id)).then(res=> {
            this.students = res.data

            } )
        },
        selectNewPhoto() {
                this.$refs.photo.click();
            },
            updatePhotoPreview() {
                const reader = new FileReader();
                reader.onload = (e) => {
                    this.photoPreview = e.target.result;
                };
                reader.readAsDataURL(this.$refs.photo.files[0]);
            },

        },
    }

</script>
<style src="@vueform/multiselect/themes/default.css"></style>

<style>

</style>
