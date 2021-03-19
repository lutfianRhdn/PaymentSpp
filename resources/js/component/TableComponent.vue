<template>
    <table class="min-w-max w-full table-auto z-0 datatable mb-5">
        <thead>
            <tr  class="bg-gray-200  text-gray-600 uppercase text-sm leading-normal">
                <slot name="header" />
            </tr>
        </thead>
        <tbody class="text-gray-600 text-sm font-light">
                <slot name="content" />
        </tbody>
    </table>
    <div class="flex justify-end align-center mx-5">
    <pagination :links="paginationLink" />
    </div>
</template>

<script>
import ButtonComponent from '@/Jetstream/Button'
import Pagination from './Pagination.vue'
    export default {
        computed:{
            paginationLink(){
                let links = [];
                links = this.paginationLinks
                links[0].label = 'Previous' 
                links[links.length -1].label = 'Next' 
                return links
            }
        },
        components:{
            ButtonComponent,
                Pagination,
        },
        props:['paginationLinks'],
       

    }

</script>

<style>

</style>
