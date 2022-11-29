<template>
    <app-layout title="Impersonate">
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">Impersonate</h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <!-- Table -->
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
                                                class="relative px-6 py-3">
                                                <span class="sr-only">Impersonate</span>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200 bg-white">
                                        <tr
                                            v-for="(user, index) in users"
                                            :key="index">
                                            <td class="whitespace-nowrap px-6 py-4">
                                                <div class="flex items-center">
                                                    <div>
                                                        <div class="text-sm font-medium text-gray-900">
                                                            {{ user.name }}
                                                        </div>
                                                        <div class="text-xs text-gray-500">
                                                            {{ user.email }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="whitespace-nowrap px-6 py-4 text-right text-sm font-medium">
                                                <a
                                                    :href="`impersonate/${user.id}`"
                                                    class="focus:shadow-outline-red inline-flex items-center justify-center rounded-md border-0 bg-indigo-600 px-4 py-2 text-sm font-semibold tracking-widest text-white transition duration-150 ease-in-out hover:bg-indigo-500 focus:border-indigo-700 focus:outline-none active:bg-indigo-600">
                                                    Impersonate
                                                </a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End: Table -->
            </div>
        </div>
    </app-layout>
</template>

<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'

const props = defineProps(['users'])
</script>
