<template>
    <!--Sidebar with Dimmer -->
    <div class="fixed  flex z-40 ">
        <!-- Sidebar -->
        <div class=" flex  top-0 h-screen z-20" :class="[right ? 'right-0 flex-row' : 'left-0 flex-row-reverse']">
            <!--Drawer -->
            <button @click.prevent="toggle()"
                class="w-7 md:hidden h-10 p-1 mt-auto mb-10 rounded text-white bg-green-600 text-center focus:outline-none hover:bg-gray-500 transition-color duration-300">
                <span :class="[right ? '-rotate-90' : 'rotate-90']" class="block transform origin-center font-bold">
                </span>
            </button>

            <!-- Sidebar Content -->
            <div ref="content" class="transition-all duration-700 bg-white  shadow-lg   overflow-hidden flex  justify-center "
                :class="[open ? 'md:max-w-lg' : 'max-w-0']">

                <div class="w-64   py-3">
                    <div class="  w-full h-20 flex items-center">
                        <h1 class="text-2xl mx-auto">Spp Payment</h1>
                    </div>
                    <div>
                        <div class=" mb-5 ">
                            <inertia-link :href="route('dashboard')" >
                                <div class="rounded-lg px-4 py-2 my-3 hover:bg-gray-200 hover:shadow" :class="{'border-l border-green-500 border-l-4 ' : activeTab == 'class'}">
                                    <h1 class="text-lg"><i class="fas fa-tachometer-alt text-2xl mr-5"></i> Dashboard</h1>
                                </div>
                            </inertia-link>
                            <dropdown-component widthClass="w-full" v-if="$page.props.auth.can['user.index']"> 
                                <template #trigger>
                                    <div class="rounded-lg px-4 py-2 my-3  hover:bg-gray-200 hover:shadow"     :class="{'active': $inertia.page.url.startsWith(href)}">
                                        <h1 class="text-lg"><i class="fas fa-users-cog text-2xl mr-5"></i> User Management</h1>
                                    </div>
                                </template>
                                <template #content >
                                    <div class="ml-5">
                                        <div class="rounded-lg px-4 py-2 my-1  hover:bg-gray-200 hover:shadow">
                                            <h1 class="text-sm"><i class="fas fa-users text-lg mr-2"></i> 
                                                <inertia-link :href="route('students.index')" class="text-md" @click="updateMenu" >Student Management </inertia-link>
                                            </h1>
                                        </div>
                                        <div class="rounded-lg px-4 py-2 my-3  hover:bg-gray-200 hover:shadow">
                                            <h1 class="text-sm"><i class="fas fa-user-tie text-lg mr-3.5"></i> 
                                                <inertia-link :href="route('guards.index')" class="text-md"  >Officer Management </inertia-link>
                                            </h1>
                                        </div>
                                        
                                        
                                    </div>
                                </template>
                            </dropdown-component>
                            <!-- <hr> -->
                            <inertia-link :href="route('classes.index')" v-if="$page.props.auth.can['class.index']">
                                <div class="rounded-lg px-4 py-2  my-3 hover:bg-gray-200 hover:shadow" :class="{'booder-l border-green-500 border-l-4 ' : activeTab == 'class'}">
                                    <h1 class="text-lg"> <i class="fas fa-chalkboard-teacher text-2xl mr-5"></i> Class Management</h1>
                                </div>
                            </inertia-link>
                            <inertia-link :href="route('tuitions.index')" v-if="$page.props.auth.can['tuition.index']">
                                <div class="rounded-lg px-4 py-2  my-3 hover:bg-gray-200 hover:shadow" :class="{'booder-l border-green-500 border-l-4 ' : activeTab == 'class'}">
                                    <h1 class="text-lg"> <i class="fas fa-money-bill-wave-alt text-2xl mr-5"></i> Tuition Management</h1>
                                </div>
                            </inertia-link>
                            <inertia-link :href="route('payments.index')" v-if="$page.props.auth.can['payment.index']">
                                <div class="rounded-lg px-4 py-2  my-3 hover:bg-gray-200 hover:shadow" :class="{'booder-l border-green-500 border-l-4 ' : activeTab == 'class'}">
                                    <h1 class="text-lg"> <i class="fas fa-file-invoice-dollar text-2xl ml-2 mr-8"></i>Payments </h1>
                                </div>
                            </inertia-link>
                        
                        </div>
                
                    </div>
                </div>
            </div>
        </div>

        <transition name="fade">
            <!-- Dimmer -->
            <div v-if="dimmer && open" @click="toggle()"
                class="flex-1 bg-gray-400 bg-opacity-75 active:outline-none z-10" />
        </transition>
    </div>

    <a class="block px-4 py-2 mt-2 text-sm font-semibold text-gray-900 
    bg-gray-200 rounded-lg dark-mode:bg-gray-700 dark-mode:hover:bg-gray-600 
    dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white 
    dark-mode:text-gray-200 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 
    focus:outline-none focus:shadow-outline" href="#">Blog</a>

</template>

<script>

import DropdownComponent from '@/component/dropdownComponent'
    export default {
        components:{
            DropdownComponent
        },
        created(){
            if (screen.width <= 760 ) {
                this.open = false;
                
            }else{
                this.open =true
            }
        },
        computed: {
            active() {
                alert(this.href)
                return window.location.href.startsWith(this.href)
            }
        },
        data() {
            return {
                open: true,
                dimmer: false,
                right: false,
                activeTab:'dashboardasd'
            };
        },
        methods: {
            toggle() {
                this.open = !this.open;
            },
            updateMenu (event) {
                var str = event.target.toString();
                this.activeTab = str.substr(str.lastIndexOf('/') + 1);
                
}
        }
    };

</script>

<style>

</style>
