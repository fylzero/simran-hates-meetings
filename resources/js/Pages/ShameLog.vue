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
                        alt="Cartoon of kitten Sylvester putting a bag over his head"
                    />
                </div>

                <ShameTable :missedMeetings="missedMeetings" />
            </div>
        </div>
    </app-layout>
</template>

<script setup>
import AppLayout from '@/Layouts/AppLayout'
import ShameTable from '@/Components/ShameTable'

const props = defineProps(['missedMeetings'])
</script>
