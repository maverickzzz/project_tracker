import { createApp, h } from 'vue'
import { Link, createInertiaApp } from '@inertiajs/vue3'
import Icon from "@/Shared/Components/Icon.vue";

import PerfectScrollbar from 'vue3-perfect-scrollbar';
import 'vue3-perfect-scrollbar/dist/vue3-perfect-scrollbar.css';

// pinia store
import { createPinia } from 'pinia';
const pinia = createPinia();

createInertiaApp({
    resolve: name => {
        const pages = import.meta.glob('./Pages/**/*.vue', { eager: true })
        return pages[`./Pages/${name}.vue`]
    },
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(PerfectScrollbar)
            .use(pinia)
            .component("Link", Link)
            .component("Icon", Icon)
            .mount(el)
    },
})
