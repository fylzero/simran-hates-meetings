<template>
    <!-- This example requires Tailwind CSS v2.0+ -->
    <div class="flex flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th
                                    scope="col"
                                    class="
                                        px-6
                                        py-3
                                        text-left text-xs
                                        font-medium
                                        text-gray-500
                                        uppercase
                                        tracking-wider
                                    "
                                >
                                    Person
                                </th>
                                <th
                                    scope="col"
                                    class="
                                        px-6
                                        py-3
                                        text-left text-xs
                                        font-medium
                                        text-gray-500
                                        uppercase
                                        tracking-wider
                                    "
                                >
                                    When Meeting Was Marked As Missed, Cancelled, Late-To, or Rescheduled
                                </th>
                                <th scope="col" class="relative px-6 py-3">
                                    <span class="sr-only">Edit</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr v-for="(missedMeeting, index) in this.meetings" :key="index">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div>
                                            <div class="text-sm font-medium text-gray-900">
                                                {{ missedMeeting.user.name }}
                                            </div>
                                            <div class="text-xs text-gray-500">
                                                {{ missedMeeting.user.email }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ missedMeeting.created_at_local_timezone }}
                                    <br />
                                    <span class="text-xs text-indigo-500">{{
                                        missedMeeting.created_at_diff_for_humans
                                    }}</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <button
                                        v-if="
                                            $page.props.user.id == missedMeeting.user.id && !$page.props.user.is_simran
                                        "
                                        @click="deleteMissedMeeting(missedMeeting.id, index)"
                                        class="
                                            inline-flex
                                            items-center
                                            justify-center
                                            px-4
                                            py-2
                                            bg-red-600
                                            border-0
                                            rounded-md
                                            font-semibold
                                            text-sm text-white
                                            tracking-widest
                                            hover:bg-red-500
                                            focus:outline-none focus:border-red-700 focus:shadow-outline-red
                                            active:bg-red-600
                                            transition
                                            ease-in-out
                                            duration-150
                                        "
                                    >
                                        Delete
                                    </button>
                                </td>
                            </tr>

                            <!-- More items... -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import DangerButton from '@/Jetstream/DangerButton';

export default {
    props: ['missedMeetings'],
    data() {
        return {
            meetings: this.missedMeetings,
        };
    },
    components: {
        DangerButton,
    },
    methods: {
        deleteMissedMeeting(id, index) {
            console.log(id);
            axios
                .delete('missed-meeting/' + id)
                .then((response) => {
                    // Clear the row
                    this.meetings.splice(index, 1);
                })
                .catch((error) => {
                    console.log(error.response);
                });
        },
    },
};
</script>
