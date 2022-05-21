<template>
    <select
        @change="selectTimezone($event)"
        name="timezone"
        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
        required
    >
        <option v-for="timezone in timezones" :key="timezone" :value="timezone" :selected="timezone == tzGuess">
            {{ timezone }}
        </option>
    </select>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue'
import moment from 'moment'
require('moment-timezone')

const props = defineProps(['currentTz'])

const emit = defineEmits(['tz'])

const timezones = ref(null)

const tzGuess = computed(() => {
    return props.currentTz ?? moment.tz.guess(true)
})

function selectTimezone(event) {
    emit('tz', event.target.value)
}

onMounted(() => {
    timezones.value = moment.tz.names()
    emit('tz', props.currentTz ?? moment.tz.guess(true))
})
</script>
