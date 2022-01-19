<template>
    <app-layout>
        <template #header>
            <h2 v-if="$page.props.user" class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
            <h2 v-else class="font-semibold text-xl text-gray-800 leading-tight">Welcome</h2>
        </template>

        <div class="max-w-3xl mt-12 mx-auto sm:px-6 lg:px-8">
            <card>
                <div class="my-5 flex justify-center">
                    <div>
                        <img
                            src="/img/right_cage.png"
                            class="mx-auto hidden lg:block"
                            style="width: 160px; height: 160px"
                            alt="Nicholas Cage face"
                        />
                    </div>
                    <div class="box">
                        <!-- This div just keeps flex from messing with the content layout -->
                        <div class="text-center">
                            It has been
                            <span class="text-red-600 block" style="font-size: 6rem; line-height: 6rem">
                                {{ missed.daysSince }}
                            </span>
                            day{{ missed.daysSince > 1 || missed.daysSince == 0 ? 's' : '' }}
                            since last incident
                        </div>
                    </div>
                    <div>
                        <img
                            src="/img/left_cage.png"
                            class="mx-auto hidden lg:block"
                            style="width: 160px; height: 160px"
                            alt="Nicholas Cage face"
                        />
                    </div>
                </div>
                <div class="flex pt-6 pb-3">
                    <div class="flex-grow text-center">
                        Total
                        <h1 class="text-4xl">
                            {{ missed.all }}
                        </h1>
                    </div>
                    <div class="flex-grow text-center">
                        Today
                        <h1 class="text-4xl">
                            {{ missed.today }}
                        </h1>
                    </div>
                    <div class="flex-grow text-center">
                        This Week
                        <h1 class="text-4xl">
                            {{ missed.thisWeek }}
                        </h1>
                    </div>
                    <div class="flex-grow text-center">
                        This Month
                        <h1 class="text-4xl">
                            {{ missed.thisMonth }}
                        </h1>
                    </div>
                </div>
            </card>

            <div class="mt-6 text-center" v-if="$page.props.user">
                <!-- Simran's Reverse-Shame Form -->
                <div v-if="$page.props.user.is_simran">
                    <button
                        class="
                            mt-3
                            leading-snug
                            font-sans
                            inline-flex
                            items-center
                            px-4
                            py-2
                            bg-green-600
                            border border-transparent
                            rounded-md
                            text-lg text-white
                            tracking-widest
                            hover:bg-green-700
                            active:bg-green-900
                            focus:outline-none focus:border-green-900 focus:shadow-outline-green
                            transition
                            ease-in-out
                            duration-150
                        "
                    >
                        (Coming soon)
                        <br />
                        Notify someone of a missed opportunity to call you out
                        <br />
                        for being late to or absent from a meeting
                    </button>
                </div>

                <!-- Log Missed Meeting Button -->
                <button
                    v-else
                    @click="logMissedMeeting"
                    :class="{ 'cursor-not-allowed': logButtonLoading }"
                    :disabled="logButtonLoading"
                    class="
                        leading-snug
                        font-sans
                        inline-flex
                        items-center
                        px-4
                        py-2
                        bg-green-600
                        border border-transparent
                        rounded-md
                        text-lg text-white
                        tracking-widest
                        hover:bg-green-700
                        active:bg-green-900
                        focus:outline-none focus:border-green-900 focus:shadow-outline-green
                        transition
                        ease-in-out
                        duration-150
                    "
                >
                    <svg
                        v-if="logButtonLoading"
                        class="mr-6 animate-spin -ml-1 mr-3 h-5 w-5 text-white"
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                    >
                        <circle
                            class="opacity-25"
                            cx="12"
                            cy="12"
                            r="10"
                            stroke="currentColor"
                            stroke-width="4"
                        ></circle>
                        <path
                            class="opacity-75"
                            fill="currentColor"
                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"
                        ></path>
                    </svg>
                    Click here to log (yet another) meeting
                    <br />
                    that didn't happen because... Simran
                </button>
            </div>

            <div class="my-12">
                <img
                    src="/img/meeting.gif"
                    class="rounded-lg mx-auto"
                    alt="Sarcastic I have a meeting image from The New Girl"
                />
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout';
import Card from '@/Components/Card';

export default {
    components: {
        AppLayout,
        Card,
    },
    props: [
        'missedMeetingsAll',
        'missedMeetingsToday',
        'missedMeetingsThisWeek',
        'missedMeetingsThisMonth',
        'missedMeetingsDaysSince',
    ],
    data() {
        return {
            animationDuration: 500,
            logButtonLoading: false,
            missed: {
                all: this.missedMeetingsAll,
                today: this.missedMeetingsToday,
                thisWeek: this.missedMeetingsThisWeek,
                thisMonth: this.missedMeetingsThisMonth,
                daysSince: this.missedMeetingsDaysSince,
            },
        };
    },
    methods: {
        logMissedMeeting() {
            this.logButtonLoading = true;
            axios
                .post('/missed-meeting/')
                .then((response) => {
                    this.missed.all++;
                    this.missed.today++;
                    this.missed.thisWeek++;
                    this.missed.thisMonth++;
                    this.missed.daysSince = 0;

                    this.$moshaToast('Simran has been notified!', {
                        position: 'bottom-right',
                        type: 'success',
                    });
                })
                .catch((error) => {
                    console.log(error.response);
                })
                .finally(() => {
                    this.logButtonLoading = false;
                });
        },
    },
};
</script>

<style scoped>
.box {
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: #ffffe9;
    box-shadow: 3px 3px 10px #888;
    border: 3px solid #333;
    height: 200px;
    width: 200px;
    transform: rotate(3deg);
}
</style>
