<template>
    <app-layout>
        <template #header>
            <h1>Tuition Management</h1>
        </template>
        <div class="">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl w-4/5 mx-auto rounded-lg mb-10">
                    <card title="Tuition Management" createLink="tuitions.create" createPermission="tuition.create">
                        <div class="flex align-center mx-5 my-2">
                            <label for="search" class="my-auto mr-2">Search</label>
                            <input class="border border-gray-300 focus:border-indigo-300 px-3 py-1 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" v-model="search" @keyup="submitSearch()" >
                        </div>
                        <table-component  :paginationLinks="newTuition.links">
                            <template #header>
                                <th class="py-3">#</th>
                                <th class="py-3">Year of Study</th>
                                <th class="py-3">Nominal</th>
                                <th class="py-3">Total Payment</th>
                                <th class="py-3">Action</th>
                            </template>
                            <template #content>
                                <tr class="border-b border-gray-200 hover:bg-gray-100"
                                    v-for="(tuition,index) in newTuition.data" :key="tuition.id">
                                    <td class="py-3 px-6 text-center whitespace-nowrap">
                                        <p class="font-medium text-center">{{ ++index }}</p>
                                    </td>
                                  
                                    <td class="py-3 px-6 text-center whitespace-nowrap">
                                        <p class="font-medium text-center">{{ tuition.year }}  </p>
                                    </td>
                                    <td class="py-3 px-6 text-center whitespace-nowrap">
                                        <p class="font-medium text-center">{{changeFormat(tuition.nominal) }}</p>
                                    </td>
                                    <td class="py-3 px-6 text-center whitespace-nowrap">
                                        <p class="font-medium text-center">{{ tuition.totalPayment}}</p>
                                    </td>
                                
                                    <td
                                        class="py-3 px-6 text-center whitespace-nowrap flex items-center justify-around">
                                      
                                        <inertia-link :href="route('tuitions.edit',tuition.id)">
                                        <button-component type="button"
                                            class="rounded-full " bg="bg-yellow-500 hover:bg-yellow-700">
                                                <i class="fas fa-edit"></i>
                                        </button-component>
                                        </inertia-link>
                                        <button-component type="button"
                                        @click="showModal(tuition)"

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
               <p>Delete Tuition - <b> {{modal.tuition.year}} </b></p> 
            </template>

           <template #content>
                    Are you sure you want to delete this data? Once data is deleted, all of its resources and data will be permanently deleted. on <b>{{ modal.tuition.year }} </b> amount <b> {{ modal.tuition.nominal }}</b>.
                </template>

            <template #footer>
                <button-component bg="bg-gray-400" @click="closeModal">
                    Cancel
                </button-component>

                <button-component bg="bg-red-500 " class="ml-2 rounded-md" @click="deleteTuition" 
                :class="{ 'opacity-25 rounded-md': form.processing }" :disabled="form.processing"
                
                >
                    Delete Tuition
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
import numeral from 'numeral'

    export default {
        props: ['tuitions','errors'],

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
                    tuition: [],
                }),
                isShow :false,
                search:'',
                newTuition: this.tuitions,
                modal:{
                    tuition : []
                },
                
               
            }
        },
        methods:{
            showModal(tuition){
                this.modal.tuition =  tuition
                this.form.tuition = tuition
                // console.log(this.form.tuition)
                this.isShow =true
            },
            closeModal() {
                this.isShow = false
            },
                deleteTuition() {
                    console.log(this.form.classs)
                this.form.delete(route('tuitions.destroy',this.modal.tuition), {
                    preserveScroll: true,
                    onSuccess: () => this.closeModal(),
                    onError: () => this.$refs.password.focus(),
                    onFinish: () => this.form.reset(),

                })
            },
            submitSearch:function(){
                console.log(this.search)    
                axios.get(route('tuition.where',{'search':this.search})).then(res=>{
                    console.log(res.data)
                     this.newTuition = res.data
                })
            },
            changeFormat: (num) => numeral(num).format('0a')

        }
        
    }

</script>

<style>

</style>
