<template>
    <div>
        <jet-banner />
        <div class="min-h-screen bg-gray-100 md:flex">
            <div class="md:flex flex-col md:flex-row w-full relative ">
                    <sidebar />
                <div class=" md:w-5/6 sm:w-full md:ml-auto  ">
                    <div class=" h-64   bg-green-500 ">
                        <div class="">
                            <div class="flex md:ml-10 justify-between px-5 pt-4 z-10">
                                <div class="mt-6">
                                <header class="  my-auto text-white text-2xl">
                                    <slot name="header"></slot>
                                </header>
                                </div>
                                <profile-button />
                            </div>
                        </div>
                    </div>
                    <main class="container w-full md:pt-0 -mt-32  sm:pt-20">
                        <div class="mx-auto ">
                            <slot />
                        </div>
                    </main>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import JetApplicationMark from '@/Jetstream/ApplicationMark'
    import JetBanner from '@/Jetstream/Banner'
    import JetDropdown from '@/Jetstream/Dropdown'
    import JetDropdownLink from '@/Jetstream/DropdownLink'
    import JetNavLink from '@/Jetstream/NavLink'
    import JetResponsiveNavLink from '@/Jetstream/ResponsiveNavLink'
    import ProfileButton from '@/component/ProfileButton'
    import Sidebar from '@/component/sidebar'

    export default {
        components: {
            JetApplicationMark,
            JetBanner,
            JetDropdown,
            JetDropdownLink,
            JetNavLink,
            JetResponsiveNavLink,
            ProfileButton,
            Sidebar
        },

        data() {
            return {
                showingNavigationDropdown: false,
            }
        },
    inject:['page'],
        methods: {
            switchToTeam(team) {
                this.$inertia.put(route('current-team.update'), {
                    'team_id': team.id
                }, {
                    preserveState: false
                })
            },


        }
    }

</script>
