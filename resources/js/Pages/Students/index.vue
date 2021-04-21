<template>
    <app-layout>
        <template #header>
            <h1>Student Management</h1>
        </template>
        <div class="">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl w-4/5 mx-auto rounded-lg mb-10">
                    <card title="Student Management" createLink="students.create" createPermission="user.create">
                        
                        <div class="flex align-center mx-5 my-2">
                            <label for="search" class="my-auto">Search</label>
                            <input class="border border-gray-300 focus:border-indigo-300 px-3 py-1 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" v-model="search" @keyup="submitSearch()" >
                        </div>
                        <table-component :paginationLinks="newStudents.links">
                            <template #header>
                                <th class="py-3">#</th>
                                <th class="py-3">Nisn</th>
                                <th class="py-3">Name</th>
                                <th class="py-3">class</th>
                                <th class="py-3">Action</th>
                            </template>
                            <template #content>
                                <tr class="border-b border-gray-200 hover:bg-gray-100"
                                    v-for="(student,index) in newStudents.data" :key="student.id">
                                    <td class="py-3 px-6 text-center whitespace-nowrap">
                                        <p class="font-medium text-center">{{ ++index }}</p>
                                    </td>
                                    <td class="py-3 px-6 text-center whitespace-nowrap">
                                        <p class="font-medium text-center">{{ student.nis }}</p>
                                    </td>
                                    <td class="py-3 px-6 text-center whitespace-nowrap">
                                        <p class="font-medium text-center">{{ student.user.name }}</p>
                                    </td>
                                    <td class="py-3 px-6 text-center whitespace-nowrap">
                                        <p class="font-medium text-center">{{ student.class.level }}
                                            {{student.class.major.label}} {{ student.class.label }}</p>
                                    </td>
                                    <td
                                        class="py-3 px-6 text-center whitespace-nowrap flex items-center justify-around">
                                        <inertia-link :href="route('students.show',student.id)">
                                            <button-component type="button"
                                                class="rounded-full bg-blue-500 hover:bg-blue-700">
                                                <i class="fas fa-list-ul"></i>
                                            </button-component>
                                        </inertia-link>
                                        <inertia-link :href="route('students.edit',student.id)">
                                            <button-component type="button" class="rounded-full "
                                                bg="bg-yellow-500 hover:bg-yellow-700">
                                                <i class="fas fa-edit"></i>
                                            </button-component>
                                        </inertia-link>
                                        <button-component type="button" @click="showModal(student)"
                                            class="rounded-full " bg="bg-red-500 hover:bg-red-700">
                                            <i class="fas fa-trash-alt"></i>
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
                <p>Delete User - <b> {{modal.user.name}}</b></p>
            </template>

            <template #content>
                Are you sure you want to delete your account? Once your account is deleted, all of its resources and
                data will be permanently deleted. Please enter this Nisn ({{modal.student.nis}}) to confirm deleting
                <b>{{modal.user.name}}</b>.

                <div class="mt-4">
                    <input-component type="text" class="mt-1 block w-3/4" placeholder="nis..." ref="password"
                        v-model="form.nis" />

                    <input-error :message="form.errors.nis" class="mt-2" />
                </div>
            </template>

            <template #footer>
                <button-component bg="bg-gray-400" @click="closeModal">
                    Cancel
                </button-component>

                <button-component bg="bg-red-500 " class="ml-2 rounded-md" @click="deleteUser"
                    :class="{ 'opacity-25 rounded-md': form.processing }" :disabled="form.processing">
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
import axios from 'axios'

    export default {
        props: ['students', 'errors'],

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
        data() {
            return {
                form: this.$inertia.form({
                    _method: 'POST',
                    student: this.students,
                    nis: ''
                }),
                newStudents : this.students,
                search :'',
                isShow: false,
                modal: {
                    student: [],
                    user: []
                },


            }
        },
        methods: {
            showModal(student) {
                this.modal.student = student
                this.form.student = student
                this.isShow = true
                this.modal.user = student.user
            },
            closeModal() {
                this.nameModal = ''
                this.isShow = false
                this.form.name = ''
                this.form.id = ''
            },
            deleteUser() {
                this.form.delete(route('students.destroy', this.form.student), {
                    preserveScroll: true,
                    onSuccess: () => this.closeModal(),
                    onError: () => this.$refs.password.focus(),
                    onFinish: () => this.form.reset(),

                })
            },
            submitSearch:function(){
                console.log(this.search)    
                axios.get(route('studens.where',{'search':this.search})).then(res=>{
                     this.newStudents = res.data

})
            },
        }

    }

</script>

<style>

</style>
