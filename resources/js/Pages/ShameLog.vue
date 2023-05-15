<template>
    <app-layout title="Shame Log">
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">Shame Log</h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="mb-12">
                    <img
                        src="/img/shame.gif"
                        class="mx-auto rounded-lg"
                        alt="Cartoon of kitten Sylvester putting a bag over his head" />
                </div>

                <ShameTable :missedMeetings="missedMeetings" :pageProps="pageProps" />
            </div>
        </div>
    </app-layout>
</template>

<script setup>
import { usePage } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue'
import ShameTable from '@/Components/ShameTable.vue'

const props = defineProps(['missedMeetings'])

const pageProps = usePage().props
</script>
