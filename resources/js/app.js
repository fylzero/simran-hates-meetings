window._ = require('lodash')
window.axios = require('axios')
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest'

import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/inertia-vue3'
import { InertiaProgress } from '@inertiajs/progress'
import VTooltip from 'v-tooltip'

// Mosha Vue Toastify
// https://szboynono.github.io/mosha-vue-toastify/
import moshaToast from 'mosha-vue-toastify'
import 'mosha-vue-toastify/dist/style.css'

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel'

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => require(`./Pages/${name}.vue`),
    setup({ el, app, props, plugin }) {
        return createApp({ render: () => h(app, props) })
            .use(plugin)
            .use(VTooltip)
            .use(moshaToast)
            .mixin({ methods: { route } })
            .mount(el)
    },
})

InertiaProgress.init({ color: '#4B5563' })
