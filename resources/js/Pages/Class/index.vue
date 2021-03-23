<template>
    <app-layout>
        <template #header>
            <h1>Class Managemnet</h1>
        </template>
        <div class="">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl w-4/5 mx-auto rounded-lg mb-10">
                    <card title="Class Management" createLink="classes.create">
                        <action-message> <h1>ok</h1> </action-message>
                        <table-component  :paginationLinks="classes.links">
                            <template #header>
                                <th class="py-3">#</th>
                                <th class="py-3">Name</th>
                                <th class="py-3">Students Count</th>
                                <th class="py-3">Action</th>
                            </template>
                            <template #content>
                                <tr class="border-b border-gray-200 hover:bg-gray-100"
                                    v-for="(classs,index) in classes.data" :key="classs.id">
                                    <td class="py-3 px-6 text-center whitespace-nowrap">
                                        <p class="font-medium text-center">{{ ++index }}</p>
                                    </td>
                                  
                                    <td class="py-3 px-6 text-center whitespace-nowrap">
                                        <p class="font-medium text-center">{{ classs.level }} {{ classs.major.label }} {{ classs.label }} </p>
                                    </td>
                                    <td class="py-3 px-6 text-center whitespace-nowrap">
                                        <p class="font-medium text-center">{{ classs.studentsTotal }}</p>
                                    </td>
                                
                                    <td
                                        class="py-3 px-6 text-center whitespace-nowrap flex items-center justify-around">
                                        <inertia-link :href="route('classes.show',classs.id)">
                                            <button-component type="button"
                                                class="rounded-full bg-blue-500 hover:bg-blue-700">
                                                <i class="lni lni-list"></i>
                                            </button-component>
                                        </inertia-link>
                                        <inertia-link :href="route('classes.edit',classs.id)">
                                        <button-component type="button"
                                            class="rounded-full " bg="bg-yellow-500 hover:bg-yellow-700">
                                            <i class="lni lni-pencil"></i>
                                        </button-component>
                                        </inertia-link>
                                        <button-component type="button"
                                        @click="showModal(classs)"

                                            class="rounded-full " bg="bg-red-500 hover:bg-red-700">
                                            <i class="lni lni-trash"></i>
                                        </button-component>
                                    </td>
                                </tr>
                            </template>
                        </table-component>
                    </card>
                </div>
            </div>
        </div>
        <dialog-modal :show="isShow" @close="closeModal">
            <template #title>
               <p>Delete Class - <b> {{ modal.classs.level }} {{ modal.major.label }} {{ modal.classs.label }} </b></p> 
            </template>

           <template #content>
                    Are you sure you want to delete this class? Once class is deleted, all of its resources and data will be permanently deleted. Please enter this Class Name ({{ modal.classs.level }} {{ modal.major.label }} {{ modal.classs.label }}) to confirm deleting <b>{{ modal.classs.level }} {{ modal.major.label }} {{ modal.classs.label }}</b>.

                    <div class="mt-4">
                        <input-component type="text" class="mt-1 block w-3/4" placeholder="xii Rpl 2..."
                                    ref="password"
                                    v-model="form.className"
                                     />

                        <input-error :message="form.errors.className" class="mt-2" />
                    </div>
                </template>

            <template #footer>
                <button-component bg="bg-gray-400" @click="closeModal">
                    Cancel
                </button-component>

                <button-component bg="bg-red-500 " class="ml-2 rounded-md" @click="deleteUser" 
                :class="{ 'opacity-25 rounded-md': form.processing }" :disabled="form.processing"
                
                >
                    Delete Student
                </button-component>
            </template>
        </dialog-modal>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import Card from '@/Jetstream/Card'
    import TableComponent from '@/component/TableComponent'
    import ButtonComponent from '@/Jetstream/Button'
import ActionMessage from '@/Jetstream/ActionMessage.vue'
import DialogModal from '@/Jetstream/DialogModal'
import InputComponent from '../../Jetstream/Input.vue'
import InputError from '@/Jetstream/InputError'

    export default {
        props: ['classes','errors'],

        components: {
            AppLayout,
            Card,
            TableComponent,
            ButtonComponent,
                ActionMessage,
                DialogModal,
                InputComponent,
                InputError
        },
        data(){
            return{
                 form:this.$inertia.form( {
                    _method: 'POST',
                    classs :[],
                    className:''
                }),
                isShow :false,
                modal:{
                    classs: [],
                    major : []
                },
                
               
            }
        },
        methods:{
            showModal(classs){
                this.modal.classs =  classs
                // alert(this.modal.classs.user.email)
                this.form.classs = classs
                this.isShow =true
                this.modal.major = classs.major
            },
            closeModal() {
                this.isShow = false
            },
                deleteUser() {
                    console.log(this.form.classs)
                this.form.delete(route('classes.destroy',this.form.classs,this.form.className), {
                    preserveScroll: true,
                    onSuccess: () => this.closeModal(),
                    onError: () => this.$refs.password.focus(),
                    onFinish: () => this.form.reset(),

                })
            }
        }
        
    }

</script>

<style>

</style>
