<template>
    <select
        @change="selectTimezone($event)"
        name="timezone"
        class="
            border-gray-300
            focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50
            rounded-md
            shadow-sm
            mt-1
            block
            w-full
        "
        required
    >
        <option v-for="timezone in timezones" :key="timezone" :value="timezone" :selected="timezone == tzGuess">
            {{ timezone }}
        </option>
    </select>
</template>

<script>
import moment from 'moment';
require('moment-timezone');

export default {
    props: ['currentTz'],
    data() {
        return {
            timezones: null,
        };
    },
    computed: {
        tzGuess() {
            return this.currentTz ?? moment.tz.guess(true);
        },
    },
    methods: {
        selectTimezone(event) {
            this.$emit('tz', event.target.value);
        },
    },
    mounted() {
        this.timezones = moment.tz.names();
        this.$emit('tz', this.currentTz ?? moment.tz.guess(true));
    },
};
</script>
