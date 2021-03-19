<template>
    <div class="mb-5">
        <div class="flex justify-between items-center md:p-6 p-3 bg-white border-b border-gray-200 ">


            <div class="md:text-xl px-3 sm:text-base">
                {{title}} 
            </div>

            <button-component v-if="createLink !== undefined" @click="redirectToCreateLink" type="button">
                Create New {{ title.split(" ")[0] }}
            </button-component>
        </div>

        <div class="bg-grey-100  ">
            <slot/>
        </div>
    </div>
</template>

<script>
    import JetApplicationLogo from '@/Jetstream/ApplicationLogo'
    import TableComponent from '@/component/TableComponent'
    import ButtonComponent from './Button'
    export default {
        
        props: {
            createLink: String,
            title: String,
        },
        components: {
            JetApplicationLogo,
            TableComponent,
            ButtonComponent
        },
        methods:{
            redirectToCreateLink(){
                this.$inertia.visit(route(this.createLink))
            } 
        }
    }

</script>
