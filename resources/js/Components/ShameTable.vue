<template>
    <!-- This example requires Tailwind CSS v2.0+ -->
    <div class="flex flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                <div class="overflow-hidden border-b border-gray-200 shadow sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th
                                    scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                    Person
                                </th>
                                <th
                                    scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500">
                                    When Meeting Was Marked As Missed, Cancelled, Late-To, or Rescheduled
                                </th>
                                <th
                                    scope="col"
                                    class="relative px-6 py-3">
                                    <span class="sr-only">Edit</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white">
                            <tr
                                v-for="(missedMeeting, index) in meetings"
                                :key="index">
                                <td class="whitespace-nowrap px-6 py-4">
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
                                <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500">
                                    {{ missedMeeting.created_at_local_timezone }}
                                    <br />
                                    <span class="text-xs text-indigo-500">{{
                                        missedMeeting.created_at_diff_for_humans
                                    }}</span>
                                </td>
                                <td class="whitespace-nowrap px-6 py-4 text-right text-sm font-medium">
                                    <button
                                        v-if="
                                            $page.props.user.id == missedMeeting.user.id && !$page.props.user.is_simran
                                        "
                                        @click="deleteMissedMeeting(missedMeeting.id, index)"
                                        class="focus:shadow-outline-red inline-flex items-center justify-center rounded-md border-0 bg-red-600 px-4 py-2 text-sm font-semibold tracking-widest text-white transition duration-150 ease-in-out hover:bg-red-500 focus:border-red-700 focus:outline-none active:bg-red-600">
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

<script setup>
import { createToast } from 'mosha-vue-toastify'

const props = defineProps(['missedMeetings'])

const meetings = props.missedMeetings

function deleteMissedMeeting(id, index) {
    axios
        .delete('missed-meeting/' + id)
        .then((response) => {
            // Clear the row
            meetings.splice(index, 1)

            createToast('Missed meeting removed!', {
                position: 'bottom-right',
                type: 'danger',
            })
        })
        .catch((error) => {
            console.log(error.response)
        })
}
</script>
