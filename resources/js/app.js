window._ = require('lodash');
window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

import { createApp, h } from 'vue';
import { App as InertiaApp, plugin as InertiaPlugin } from '@inertiajs/inertia-vue3';
import VTooltip from 'v-tooltip';

// Mosha Vue Toastify
// https://szboynono.github.io/mosha-vue-toastify/
import moshaToast from 'mosha-vue-toastify';
import 'mosha-vue-toastify/dist/style.css';

const el = document.getElementById('app');

createApp({
    render: () =>
        h(InertiaApp, {
            initialPage: JSON.parse(el.dataset.page),
            resolveComponent: (name) => require(`./Pages/${name}`).default,
        }),
})
    .mixin({ methods: { route } })
    .use(InertiaPlugin)
    .use(VTooltip)
    .use(moshaToast)
    .mount(el);
