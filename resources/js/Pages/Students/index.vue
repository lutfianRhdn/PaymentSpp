<template>
    <app-layout>
        <template #header>
            <h1>Student Managemnet</h1>
        </template>
        <div class="">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl w-4/5 mx-auto rounded-lg mb-10">
                    <card title="Student Management" createLink="students.create">
                        <action-message> <h1>ok</h1> </action-message>
                        <table-component  :paginationLinks="students.links">
                            <template #header>
                                <th class="py-3">#</th>
                                <th class="py-3">Nisn</th>
                                <th class="py-3">Name</th>
                                <th class="py-3">class</th>
                                <th class="py-3">Action</th>
                            </template>
                            <template #content>
                                <tr class="border-b border-gray-200 hover:bg-gray-100"
                                    v-for="(student,index) in students.data" :key="student.id">
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
                                                <i class="lni lni-list"></i>
                                            </button-component>
                                        </inertia-link>
                                        <inertia-link :href="route('students.edit',student.id)">
                                        <button-component type="button"
                                            class="rounded-full bg-yellow-500 hover:bg-yellow-700">
                                            <i class="lni lni-pencil"></i>
                                        </button-component>
                                        </inertia-link>
                                        <button-component type="button"
                                            class="rounded-full bg-red-500 hover:bg-red-700">
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
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
    import Card from '@/Jetstream/Card'
    import TableComponent from '@/component/TableComponent'
    import ButtonComponent from '@/Jetstream/Button'
import ActionMessage from '@/Jetstream/ActionMessage.vue'


    export default {
        props: ['students'],

        components: {
            AppLayout,
            Card,
            TableComponent,
            ButtonComponent,
                ActionMessage,
        },
    }

</script>

<style>

</style>
