require('./bootstrap');

// Import modules...
import { createApp, h } from 'vue';
import { App as InertiaApp, plugin as InertiaPlugin } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';
// import { library } from '@fortawesome/fontawesome-svg-core'
// import { faUserSecret } from '@fortawesome/free-solid-svg-icons'
// import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'


const el = document.getElementById('app');

createApp({
    render: () =>
    h(InertiaApp, {
        initialPage: JSON.parse(el.dataset.page),
        resolveComponent: (name) => import(`./Pages/${name}`).then(module => module.default),
    }),
})
.mixin({ methods: { route } })
.use(InertiaPlugin)
.mount(el);

// library.add(faUserSecret)

// h.component('font-awesome-icon', FontAwesomeIcon)

h.Vue.config.productionTip = false
InertiaProgress.init({ color: '#4B5563' });
