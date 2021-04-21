<template>
    <app-layout>
        <template #header>
            <h1>payment Managemnet</h1>
        </template>
        <div class="">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl w-4/5 mx-auto rounded-lg mb-10">
                    <card title="payment Management" createLink="payments.create" createPermission="payment.create">
                        <div class="flex justify-between  py-3 px-6">

                          <div class="flex align-center">
                            <label for="search" class="my-auto">Search</label>
                            <input class="border border-gray-300 focus:border-indigo-300 px-3 py-1 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" v-model="search" @keyup="submitSearch()" >
                        </div>
                <button-component bg="bg-gray-400" @click="downloadExcel" v-if="$page.props.auth.role == 'admin'">
                    Export To excel
                </button-component>
                        </div>
                        <table-component  :paginationLinks="newPayment.links" >
                            <template #header>
                                <th class="py-3">#</th>
                                <th class="py-3">Month  - Year</th>
                                <th class="py-3">Student</th>
                                <th class="py-3">Officer</th>
                                <th class="py-3">Nominal</th>
                                <th class="py-3">Action</th>
                            </template>
                            <template #content>
                                <tr class="border-b border-gray-200 hover:bg-gray-100"
                                    v-for="(payment,index) in newPayment.data" :key="payment.id">
                                    <td class="py-3 px-6 text-center whitespace-nowrap">
                                        <p class="font-medium text-center">{{ ++index }}</p>
                                    </td>
                                  
                                    <td class="py-3 px-6 text-center whitespace-nowrap">
                                        <p class="font-medium text-center">{{ payment.month }} - {{payment.year}}  </p>
                                    </td>
                                    <td class="py-3 px-6 text-center whitespace-nowrap">
                                        <p class="font-medium text-center">{{ payment.student.user.name }}</p>
                                    </td>
                                    <td class="py-3 px-6 text-center whitespace-nowrap">
                                        <p class="font-medium text-center">{{ payment.officer.user.name}}</p>
                                    </td>
                                   
                                    <td class="py-3 px-6 text-center whitespace-nowrap">
                                        <p class="font-medium text-center">{{ payment.tuition.nominal }}</p>
                                    </td>
                                
                                    <td
                                        class="py-3 px-6 text-center whitespace-nowrap flex items-center justify-around">
                                      
                                        
                                        <button-component type="button"
                                        @click="showModal(payment)"

                                            class="rounded-full " bg="bg-blue-500 hover:bg-blue-700">
                                            <i class="fas fa-image"></i>
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
               <p>Show Proof Of Payment  </p> 
            </template>
           <template #content>
            <img :src="'storage/'+modal.payment.photo_path" alt="">

                </template>

            <template #footer>
                <button-component bg="bg-gray-400" @click="closeModal">
                    Closes
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
        props: ['payments','errors'],

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
                    payment: [],
                }),
                isShow :false,
                search:'',
                newPayment: this.payments,
                modal:{
                    payment : []
                },
                
               
            }
        },
        methods:{
            downloadExcel(){
                window.open(route('payments.export'),'_blank')
            },
            showModal(payment){
                this.modal.payment =  payment
                // console.log(this.form.payment)
                this.isShow =true
            },
            closeModal() {
                this.isShow = false
            },
                deletepayment() {
                    console.log(this.form.classs)
                this.form.delete(route('payments.destroy',this.modal.payment), {
                    preserveScroll: true,
                    onSuccess: () => this.closeModal(),
                    onError: () => this.$refs.password.focus(),
                    onFinish: () => this.form.reset(),

                })
            },
            submitSearch:function(){
                console.log(this.search)    
                axios.get(route('payment.where',{'search':this.search})).then(res=>{
                    console.log(res.data)
                     this.newPayment = res.data
                })
            },
        }
        
    }

</script>

<style>

</style>
