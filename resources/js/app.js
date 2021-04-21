require('./bootstrap');

// Import modules...
import { createApp, h } from 'vue';
import { App as InertiaApp, plugin as InertiaPlugin } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';


const el = document.getElementById('app');
InertiaProgress.init()

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

// h.Vue.config.productionTip = false

InertiaProgress.init({ color: '#4B5563' });
