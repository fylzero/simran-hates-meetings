<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Shame Log</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="mb-12">
                    <img
                        src="/img/shame.gif"
                        class="rounded-lg mx-auto"
                        alt="Cartoon of kitten Sylvester putting a bag over his head"
                    />
                </div>

                <ShameTable :missedMeetings="missedMeetings" />
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout';
import ShameTable from '@/Components/ShameTable';

export default {
    props: ['missedMeetings'],
    components: {
        AppLayout,
        ShameTable,
    },
};
</script>
