<template>
    <div class="min-h-screen bg-gray-100 md:flex sm:flex">
            <div class="md:flex flex-col md:flex-row w-full relative sm:flex flex-col sm:flex-row w-full relative">
                <div class=" md:w-full sm:w-full">
                    <div class="md:h-1/2 bg-green-500 sm:h-1/2 bg-green-500">
                        <div class="">
                            <div class="flex md:ml-10 justify-between px-5 pt-4 z-10">
                                <div class="mt-6">
                                <header class="my-auto text-white text-2xl">
                                    <slot name="header">Login</slot>
                                </header>
                                </div>
                            </div>
                        </div>
                    </div>
                    <main class="container w-full md:pt-0 -mt-32 sm:pt-20 -mt-32">
                        <div class="self-center">
                                <div class="max-w-3xl mx-auto sm:max-w-screen-sm">
                                    <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 flex flex-col">
                                        <div class="mb-4">
                                            <label class="block text-grey-darker text-sm font-bold mb-2" for="username">
                                                Username
                                            </label>
                                            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker" id="username" type="text" placeholder="Username">
                                        </div>
                                        <div class="mb-6">
                                            <label class="block text-grey-darker text-sm font-bold mb-2" for="password">
                                                Password
                                            </label>
                                            <input class="shadow appearance-none border border-red rounded w-full py-2 px-3 text-grey-darker mb-3" id="password" type="password" placeholder="******************">
                                            <p class="text-red text-xs italic">Please choose a password.</p>
                                        </div>
                                        <div class="flex items-center justify-between">
                                            <button class="bg-green-500 hover:bg-green-200 text-gray-800 font-bold py-2 px-4 rounded" type="button">
                                                Sign In
                                            </button>
                                            <a class="inline-block align-baseline font-bold text-sm text-blue hover:text-blue-darker" href="#">
                                                Forgot Password?
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </main>
                </div>
            </div>
        </div>
</template>