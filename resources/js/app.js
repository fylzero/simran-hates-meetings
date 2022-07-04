import _ from 'lodash'
window._ = _

import axios from 'axios'
window.axios = axios

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest'

import '../css/app.css'

import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/inertia-vue3'
import { InertiaProgress } from '@inertiajs/progress'
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers'
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m'
import FloatingVue from 'floating-vue'
import 'floating-vue/dist/style.css'

// Mosha Vue Toastify
// https://szboynono.github.io/mosha-vue-toastify/
import moshaToast from 'mosha-vue-toastify'
import 'mosha-vue-toastify/dist/style.css'

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel'

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, app, props, plugin }) {
        return createApp({ render: () => h(app, props) })
            .use(plugin)
            .use(ZiggyVue, Ziggy)
            .use(FloatingVue)
            .use(moshaToast)
            .mount(el)
    },
})

InertiaProgress.init({ color: '#4B5563' })
