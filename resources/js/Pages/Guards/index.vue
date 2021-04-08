<template>
    <app-layout>
        <template #header>
            <h1>Officer Managemnet</h1>
        </template>
        <div class="">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl w-4/5 mx-auto rounded-lg mb-10">
                    <card title="Officer Management" createLink="guards.create" createPermission="user.create">
                        <action-message> <h1>ok</h1> </action-message>
                        <table-component  :paginationLinks="guards.links">
                            <template #header>
                                <th class="py-3">#</th>
                                <th class="py-3">Name</th>
                                <th class="py-3">Email</th>
                                <th class="py-3">Action</th>
                            </template>
                            <template #content>
                                <tr class="border-b border-gray-200 hover:bg-gray-100"
                                    v-for="(guard,index) in guards.data" :key="guard.id">
                                    <td class="py-3 px-6 text-center whitespace-nowrap">
                                        <p class="font-medium text-center">{{ ++index }}</p>
                                    </td>
                                  
                                    <td class="py-3 px-6 text-center whitespace-nowrap">
                                        <p class="font-medium text-center">{{ guard.user.name }}</p>
                                    </td>
                                    <td class="py-3 px-6 text-center whitespace-nowrap">
                                        <p class="font-medium text-center">{{ guard.user.email }}</p>
                                    </td>
                                
                                    <td
                                        class="py-3 px-6 text-center whitespace-nowrap flex items-center justify-around">
                                        <inertia-link :href="route('guards.show',guard.id)">
                                            <button-component type="button"
                                                class="rounded-full bg-blue-500 hover:bg-blue-700">
                                                <i class="fas fa-list-ul"></i>
                                            </button-component>
                                        </inertia-link>
                                        <inertia-link :href="route('guards.edit',guard.id)">
                                        <button-component type="button"
                                            class="rounded-full " bg="bg-yellow-500 hover:bg-yellow-700">
                                                <i class="fas fa-edit"></i>
                                        </button-component>
                                        </inertia-link>
                                        <button-component type="button"
                                        @click="showModal(guard)"

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
                    Are you sure you want to delete your account? Once your account is deleted, all of its resources and data will be permanently deleted. Please enter this email ({{modal.user.email}}) to confirm deleting <b>{{modal.user.name}}</b>.

                    <div class="mt-4">
                        <input-component type="text" class="mt-1 block w-3/4" placeholder="email..."
                                    ref="password"
                                    v-model="form.email"
                                     />

                        <input-error :message="form.errors.email" class="mt-2" />
                    </div>
                </template>

            <template #footer>
                <button-component bg="bg-gray-400" @click="closeModal">
                    Cancel
                </button-component>

                <button-component bg="bg-red-500 " class="ml-2 rounded-md" @click="deleteUser" 
                :class="{ 'opacity-25 rounded-md': form.processing }" :disabled="form.processing"
                
                >
                    Delete Officer
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
        props: ['guards','errors'],

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
                    guard :[],
                    email:''
                }),
                isShow :false,
                modal:{
                    guard: [],
                    user : []
                },
                
               
            }
        },
        methods:{
            showModal(guard){
                this.modal.guard =  guard
                // alert(this.modal.guard.user.email)
                this.form.guard = guard
                this.isShow =true
                this.modal.user = guard.user
            },
            closeModal() {
                this.nameModal = ''
                this.isShow = false
                this.form.name =''
                this.form.id =''
            },
                deleteUser() {
                this.form.delete(route('guards.destroy',this.form.guard), {
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
