require('./bootstrap');

// Import modules...
import { createApp, h } from 'vue';
import { App as InertiaApp, plugin as InertiaPlugin } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';
import VueNumerals from 'vue-numerals';


const el = document.getElementById('app');
InertiaProgress.init()

const app = createApp({
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
app.use(VueNumerals); // default locale is 'en'

// h.component('font-awesome-icon', FontAwesomeIcon)

h.Vue.config.productionTip = false

InertiaProgress.init({ color: '#4B5563' });
