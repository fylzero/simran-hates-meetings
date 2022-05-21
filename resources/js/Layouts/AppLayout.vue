<template>
    <div>
        <Head :title="title" />

        <jet-banner />

        <div class="min-h-screen">
            <!-- Primary Navigation -->
            <nav-primary></nav-primary>

            <!-- Page Heading -->
            <header class="bg-gradient-to-r from-gray-100 to-indigo-200 shadow">
                <div class="mx-auto max-w-7xl py-3 px-4 sm:px-6 lg:px-8">
                    <slot name="header"></slot>
                </div>
            </header>

            <!-- Page Content -->
            <main>
                <slot></slot>
            </main>
        </div>
    </div>
</template>

<script>
import { defineComponent } from 'vue'
import NavPrimary from '@/Layouts/NavPrimary.vue'
import JetBanner from '@/Jetstream/Banner.vue'
import { Head } from '@inertiajs/inertia-vue3'

export default defineComponent({
    props: {
        title: String,
    },

    components: {
        Head,
        NavPrimary,
        JetBanner,
    },
})
</script>
