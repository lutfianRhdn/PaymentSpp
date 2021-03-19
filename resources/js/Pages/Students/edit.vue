
<template>
    <app-layout>
        <template #header>
            <h1>Student Managemnet</h1>
        </template>
        <div class="">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="overflow-hidden w-4/5 mx-auto rounded-lg">
                    <card title="Create New Student">
                        <form @submit.prevent="createStudent" action="{{route('student.store')}}">
                            <div class="px-4 py-5 bg-white sm:p-6 ">
                                <div class="flex justify-around md:flex-row flex-col">
                                    <div class="">
                                        <div class="flex md:flex-row flex-col justify-between">
                                            <div class="mr-5 ">
                                                <label for="Nisn" class="block"> Nisn</label>
                                                <input-component type="text" class="w-full" v-model="form.nisn" />
                                                <input-error :message="errors.nisn">  </input-error>

                                            </div>
                                            <div class="ml-5">
                                                <label for="Nis" class="block"> Nis</label>
                                                <input-component  type="text" class="w-full" v-model="form.nis"/>
                                                <input-error :message="errors.nis">  </input-error>

                                            </div>
                                        </div>
                                        <div class=" my-3  ">
                                            <label for="Name" class="block"> Name</label>
                                            <input-component  type="text" class="w-full" v-model="form.name"/>
                                            <input-error :message="errors.name">  </input-error>
                                        </div>
                                        <div class=" my-3  ">
                                            <label for="Name" class="block"> Class : </label>
                                            <!-- <input-component  type="text" class="w-full" v-model="form.name"/> -->
                                            <!-- <select2 :options="['select1','select2']" /> -->
                                            <select name="class" id="class" v-model="form.class">
                                                <option  v-for="clas in classes" :value="clas.id"  :key="clas.id">
                                                     {{ clas.level }} {{clas.major.label}} {{clas.label}}
                                                </option>
                                            </select>
                                            <input-error :message="errors.class">  </input-error>
                                        </div>

                                        <div class=" my-3  ">
                                            <label for="email" class="block">Email</label>
                                            <input-component  type="text" class="w-full" v-model="form.email"/>
                                            <input-error :message="errors.email">  </input-error>
                                        </div>
                                        <div class=" my-3  ">
                                            <label for="Phone" class="block">Phone </label>
                                            <input-component  type="text" class="w-full" v-model="form.phone"/>
                                            <input-error :message="errors.phone">  </input-error>
                                        </div>
                                        <div class=" my-3  ">
                                            <label for="address" class="block">Address </label>
                                            <textarea type="text" 
                                                class="shadow w-full rounded border border-gray-500 " v-model="form.address"/>
                                            <input-error :message="errors.address">  </input-error>

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
                                            <img src="https://ui-avatars.com/api/?name=Sp&color=7F9CF5&background=EBF4FF&size512" alt="user.name" class="rounded shadow-lg   w-52 ">
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

                                        <jet-secondary-button type="button" class="mt-2" @click.prevent="deletePhoto" >
                                            Remove Photo
                                        </jet-secondary-button>

                                        <!-- <jet-input-error :message="form.errors.photo" class="mt-2" /> -->
                                    </div>
                                </div>
                            </div>

                            <div class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6 shadow sm:rounded-bl-md sm:rounded-br-md"
                                >
                                            
                            <button-component type="submit" class="bg-blue-400 hover:bg-blue-600">Submit</button-component>

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
            // Select2
        },
        props:['errors','classes','student'],
        data() {
            return {
               form: this.$inertia.form({
                    _method: 'POST',
                    name: this.student.user.name,
                    nis:this.student.nis,
                    nisn:this.student.nisn,
                    email:this.student.user.email,
                    phone:this.student.phone,
                    address: this.student.address,
                    photo: this.student.user.profile_photo_path,
                    class:this.student.class.id
                }),

                photoPreview: null,
            }
        },
        methods: {
            createStudent() {
                if (this.$refs.photo) {
                    this.form.photo = this.$refs.photo.files[0]
                }

                    // alert(this.form.class)
                this.form.put(route('students.update',this.student), {
                    preserveScroll: true
                });
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

            deletePhoto() {
                this.$inertia.delete(route('current-user-photo.destroy'), {
                    preserveScroll: true,
                    onSuccess: () => (this.photoPreview = null),
                });
            },
        },
    }

</script>

<style>

</style>
