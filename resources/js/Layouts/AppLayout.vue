<script setup>
import { ref } from 'vue';
import { Link, Head, router, usePage } from '@inertiajs/vue3';
import Banner from '@/Components/Banner.vue';
import JetNavLink from '@/Jetstream/NavLink.vue'
import JetResponsiveNavLink from '@/Jetstream/ResponsiveNavLink.vue'

defineProps({
    title: String,
});

const showingNavigationDropdown = ref(false)

const switchToTeam = (team) => {
    router.put(route('current-team.update'), {
        team_id: team.id,
    }, {
        preserveState: false,
    });
};

const logout = () => {
    router.post(route('logout'));
};
</script>

<template>
    <div>
        <Head :title="title" />

        <Banner />

        <div class="min-h-screen">
            <!-- Primary Navigation -->
            <nav class="border-b border-gray-100 bg-white">
                <!-- Primary Navigation Menu -->
                <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                    <div class="flex h-16 justify-between">
                        <div class="flex">
                            <!-- Logo -->
                            <div class="flex shrink-0 items-center">
                                <Link
                                    :href="route('dashboard')"
                                    class="text-xl">
                                    Simran Hates Meetings
                                    <span class="font-sans">¯\_(ツ)_/¯</span>
                                </Link>
                            </div>

                            <!-- Navigation Links -->
                            <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                                <JetNavLink
                                    :href="route('dashboard')"
                                    :active="route().current('dashboard')">
                                    Dashboard
                                </JetNavLink>
                                <JetNavLink
                                    v-if="usePage().props.auth.user"
                                    :href="route('shame-log')"
                                    :active="route().current('shame-log')">
                                    Shame Log
                                </JetNavLink>
                                <JetNavLink
                                    v-if="!usePage().props.auth.user"
                                    :href="route('login')"
                                    :active="route().current('login')">
                                    Login
                                </JetNavLink>
                                <JetNavLink
                                    v-if="!usePage().props.auth.user"
                                    :href="route('register')"
                                    :active="route().current('register')">
                                    Register
                                </JetNavLink>
                            </div>
                        </div>

                        <div class="hidden sm:ml-6 sm:flex sm:items-center">
                            <a
                                v-if="usePage().props.impersonated_by"
                                :href="'impersonate/stop'"
                                v-tooltip.bottom="'Stop Impersonating User'"
                                class="mr-3">
                                <i class="fas fa-times-circle text-red-700"></i>
                            </a>
                            <Link
                                v-if="
                                    usePage().props.app_is_local ||
                                    (usePage().props.auth.user && usePage().props.auth.user.email == usePage().props.allowed_horizon_email)
                                "
                                :href="route('impersonate')"
                                v-tooltip.bottom="'Impersonate User'"
                                class="mr-3">
                                <i class="fas fa-crown text-green-700"></i>
                            </Link>
                            <template v-if="usePage().props.auth.user">
                                <a
                                    href="https://github.com/fylzero/simran-hates-meetings/issues/new"
                                    v-tooltip.bottom="'Report Problem/Request Feature'"
                                    target="blank"
                                    class="mr-3">
                                    <i class="fas fa-bug text-purple-700"></i>
                                </a>

                                <button
                                    v-if="usePage().props.jetstream.managesProfilePhotos"
                                    class="flex rounded-full border-2 border-transparent text-sm transition duration-150 ease-in-out focus:border-gray-300 focus:outline-none"
                                    v-tooltip="'Profile & Settings'">
                                    <img
                                        class="h-8 w-8 rounded-full object-cover"
                                        :src="usePage().props.auth.user.profile_photo_url"
                                        :alt="usePage().props.auth.user.name" />
                                </button>

                                <span
                                    v-else
                                    class="inline-flex rounded-md"
                                    v-tooltip.bottom="'Profile & Settings'">
                                    <Link
                                        :href="route('profile.show')"
                                        :active="route().current('profile.show')"
                                        class="inline-flex items-center rounded-md border border-transparent bg-white px-3 py-2 text-base font-medium leading-4 text-gray-600 transition duration-150 ease-in-out hover:text-gray-700 focus:outline-none">
                                        {{ usePage().props.auth.user.name }}
                                    </Link>
                                </span>
                            </template>

                            <form
                                @submit.prevent="logout"
                                v-if="usePage().props.auth.user"
                                v-tooltip="'Logout'">
                                <button
                                    type="submit"
                                    v-tooltip.bottom="'Logout'">
                                    <i class="fas fa-power-off text-red-600"></i>
                                </button>
                            </form>
                        </div>

                        <!-- Hamburger -->
                        <div class="-mr-2 flex items-center sm:hidden">
                            <button
                                @click="showingNavigationDropdown = !showingNavigationDropdown"
                                class="inline-flex items-center justify-center rounded-md p-2 text-gray-400 transition duration-150 ease-in-out hover:bg-gray-100 hover:text-gray-500 focus:bg-gray-100 focus:text-gray-500 focus:outline-none">
                                <svg
                                    class="h-6 w-6"
                                    stroke="currentColor"
                                    fill="none"
                                    viewBox="0 0 24 24">
                                    <path
                                        :class="{
                                            hidden: showingNavigationDropdown,
                                            'inline-flex': !showingNavigationDropdown,
                                        }"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M4 6h16M4 12h16M4 18h16" />
                                    <path
                                        :class="{
                                            hidden: !showingNavigationDropdown,
                                            'inline-flex': showingNavigationDropdown,
                                        }"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                        <!-- End: Hamburger -->
                    </div>
                </div>

                <!-- Responsive Navigation Menu -->
                <div
                    :class="{
                        block: showingNavigationDropdown,
                        hidden: !showingNavigationDropdown,
                    }"
                    class="sm:hidden">
                    <div class="space-y-1 pt-2 pb-3">
                        <JetResponsiveNavLink
                            :href="route('dashboard')"
                            :active="route().current('dashboard')">
                            Dashboard
                        </JetResponsiveNavLink>
                        <JetResponsiveNavLink
                            v-if="usePage().props.auth.user"
                            :href="route('shame-log')"
                            :active="route().current('shame-log')">
                            Shame Log
                        </JetResponsiveNavLink>
                        <JetResponsiveNavLink
                            v-if="!usePage().props.auth.user"
                            :href="route('login')"
                            :active="route().current('login')">
                            Login
                        </JetResponsiveNavLink>
                        <JetResponsiveNavLink
                            v-if="!usePage().props.auth.user"
                            :href="route('register')"
                            :active="route().current('register')">
                            Register
                        </JetResponsiveNavLink>
                    </div>

                    <!-- Responsive Settings Options -->
                    <div
                        class="border-t border-gray-200 pt-4 pb-1"
                        v-if="usePage().props.auth.user">
                        <div class="flex items-center px-4">
                            <div
                                v-if="usePage().props.jetstream.managesProfilePhotos"
                                class="mr-3 shrink-0">
                                <img
                                    class="h-10 w-10 rounded-full object-cover"
                                    :src="usePage().props.auth.user.profile_photo_url"
                                    :alt="usePage().props.auth.user.name" />
                            </div>

                            <div>
                                <div class="text-base font-medium text-gray-800">
                                    {{ usePage().props.auth.user.name }}
                                </div>
                                <div class="text-sm font-medium text-gray-500">
                                    {{ usePage().props.auth.user.email }}
                                </div>
                            </div>
                        </div>

                        <div class="mt-3 space-y-1">
                            <JetResponsiveNavLink
                                :href="route('profile.show')"
                                :active="route().current('profile.show')">
                                Profile
                            </JetResponsiveNavLink>

                            <!-- Authentication -->
                            <form
                                method="POST"
                                @submit.prevent="logout">
                                <JetResponsiveNavLink as="button"> Logout </JetResponsiveNavLink>
                            </form>
                        </div>
                    </div>
                    <!-- End: Responsive Settings Options -->
                </div>
                <!-- End: Responsive Navigation Menu -->
            </nav>

            <!-- Page Heading -->
            <header class="bg-gradient-to-r from-gray-100 to-indigo-200 shadow">
                <div class="mx-auto max-w-7xl py-3 px-4 sm:px-6 lg:px-8">
                    <slot name="header"></slot>
                </div>
            </header>

            <!-- Page Heading -->
            <!-- <header v-if="$slots.header" class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <slot name="header" />
                </div>
            </header> -->

            <!-- Page Content -->
            <main>
                <slot />
            </main>
        </div>
    </div>
</template>
