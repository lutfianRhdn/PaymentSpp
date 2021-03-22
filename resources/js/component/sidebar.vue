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
            <div ref="content" class="transition-all duration-700 bg-white rounded-lg  shadow-lg   overflow-hidden flex  justify-center "
                :class="[open ? 'md:max-w-lg' : 'max-w-0']">

                <div class="w-64   py-3">
                    <div class="  w-full h-20 flex items-center">
                        <h1 class="text-2xl mx-auto">Spp Payment</h1>
                    </div>
                    <div>
                        <div class=" mb-5 ">
                            <dropdown-component widthClass="w-full" > 
                                <template #trigger>
                                    <div class="px-4 py-2  hover:bg-gray-200 hover:shadow" :class="{'booder-l border-green-500 border-l-4 ' : activeTab == 'students'|| 'officers'}">
                                        <h1 class="text-xl"> <i class="lni lni-users"></i> User  Management</h1>
                                    </div>
                                </template>
                                <template #content >
                                    <div class="ml-5">
                                        <inertia-link :href="route('students.index')" class="block text-lg" @click="updateMenu" >Student Management </inertia-link>
                                        <inertia-link :href="route('guards.index')" class=" line-through"  >Officer Management </inertia-link>
                                    </div>
                                </template>
                            </dropdown-component>
                            <!-- <hr> -->
                           <div class="px-4 py-2 hover:bg-gray-200 hover:shadow">
                                        <h1 class="text-xl"> <span class="font-bold"> User </span> Management</h1>
                                    </div>
                          
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
