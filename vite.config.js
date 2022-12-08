import { defineConfig } from 'vite'
import laravel from 'laravel-vite-plugin'
import vue from '@vitejs/plugin-vue'

const domain = 'simran-hates-meetings.test'
const homedir = require('os').homedir()

export default defineConfig({
    plugins: [
        laravel({
            input: 'resources/js/app.js',
            refresh: true,
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
    ],
    server: {
        https: {
            key: `${homedir}/.config/valet/Certificates/${domain}.key`,
            cert: `${homedir}/.config/valet/Certificates/${domain}.crt`,
        },
        host: domain,
        hmr: {
            host: domain,
        },
    },
})
