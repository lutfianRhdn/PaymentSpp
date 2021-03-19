<template>
    <button :type="type" :class="this.bg,this.class" class="  shadow-lg inline-flex items-center px-4 py-2  border border-transparent  font-semibold text-xs text-white uppercase tracking-widest  active:bg-blue-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray transition ease-in-out duration-150">
        <slot></slot>
    </button>
</template>

<script>
    export default {
        props: {
            class:{
                type:String,
                default:'rounded-md'
            },
            bg:{
                type:String,
                default : 'bg-blue-600 hover:bg-blue-700'
            },
            type: {
                type: String,
                default: 'submit',
            },
        }
    }
</script>
