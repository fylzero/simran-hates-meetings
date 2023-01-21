<template>
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
                        <jet-nav-link
                            :href="route('dashboard')"
                            :active="route().current('dashboard')">
                            Dashboard
                        </jet-nav-link>
                        <jet-nav-link
                            v-if="$page.props.user"
                            :href="route('shame-log')"
                            :active="route().current('shame-log')">
                            Shame Log
                        </jet-nav-link>
                        <jet-nav-link
                            v-if="!$page.props.user"
                            :href="route('login')"
                            :active="route().current('login')">
                            Login
                        </jet-nav-link>
                        <jet-nav-link
                            v-if="!$page.props.user"
                            :href="route('register')"
                            :active="route().current('register')">
                            Register
                        </jet-nav-link>
                    </div>
                </div>

                <div class="hidden sm:ml-6 sm:flex sm:items-center">
                    <a
                        v-if="$page.props.impersonated_by"
                        :href="'impersonate/stop'"
                        v-tooltip.bottom="'Stop Impersonating User'"
                        class="mr-3">
                        <i class="fas fa-times-circle text-red-700"></i>
                    </a>
                    <Link
                        v-if="
                            $page.props.app_is_local ||
                            ($page.props.user && $page.props.user.email == $page.props.allowed_horizon_email)
                        "
                        :href="route('impersonate')"
                        v-tooltip.bottom="'Impersonate User'"
                        class="mr-3">
                        <i class="fas fa-crown text-green-700"></i>
                    </Link>
                    <template v-if="$page.props.user">
                        <a
                            href="https://github.com/fylzero/simran-hates-meetings/issues/new"
                            v-tooltip.bottom="'Report Problem/Request Feature'"
                            target="blank"
                            class="mr-3">
                            <i class="fas fa-bug text-purple-700"></i>
                        </a>

                        <button
                            v-if="$page.props.jetstream.managesProfilePhotos"
                            class="flex rounded-full border-2 border-transparent text-sm transition duration-150 ease-in-out focus:border-gray-300 focus:outline-none"
                            v-tooltip="'Profile & Settings'">
                            <img
                                class="h-8 w-8 rounded-full object-cover"
                                :src="$page.props.user.profile_photo_url"
                                :alt="$page.props.user.name" />
                        </button>

                        <span
                            v-else
                            class="inline-flex rounded-md"
                            v-tooltip.bottom="'Profile & Settings'">
                            <Link
                                :href="route('profile.show')"
                                :active="route().current('profile.show')"
                                class="inline-flex items-center rounded-md border border-transparent bg-white px-3 py-2 text-base font-medium leading-4 text-gray-600 transition duration-150 ease-in-out hover:text-gray-700 focus:outline-none">
                                {{ $page.props.user.name }}
                            </Link>
                        </span>
                    </template>

                    <form
                        @submit.prevent="logout"
                        v-if="$page.props.user"
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
                <jet-responsive-nav-link
                    :href="route('dashboard')"
                    :active="route().current('dashboard')">
                    Dashboard
                </jet-responsive-nav-link>
                <jet-responsive-nav-link
                    v-if="$page.props.user"
                    :href="route('shame-log')"
                    :active="route().current('shame-log')">
                    Shame Log
                </jet-responsive-nav-link>
                <jet-responsive-nav-link
                    v-if="!$page.props.user"
                    :href="route('login')"
                    :active="route().current('login')">
                    Login
                </jet-responsive-nav-link>
                <jet-responsive-nav-link
                    v-if="!$page.props.user"
                    :href="route('register')"
                    :active="route().current('register')">
                    Register
                </jet-responsive-nav-link>
            </div>

            <!-- Responsive Settings Options -->
            <div
                class="border-t border-gray-200 pt-4 pb-1"
                v-if="$page.props.user">
                <div class="flex items-center px-4">
                    <div
                        v-if="$page.props.jetstream.managesProfilePhotos"
                        class="mr-3 shrink-0">
                        <img
                            class="h-10 w-10 rounded-full object-cover"
                            :src="$page.props.user.profile_photo_url"
                            :alt="$page.props.user.name" />
                    </div>

                    <div>
                        <div class="text-base font-medium text-gray-800">
                            {{ $page.props.user.name }}
                        </div>
                        <div class="text-sm font-medium text-gray-500">
                            {{ $page.props.user.email }}
                        </div>
                    </div>
                </div>

                <div class="mt-3 space-y-1">
                    <jet-responsive-nav-link
                        :href="route('profile.show')"
                        :active="route().current('profile.show')">
                        Profile
                    </jet-responsive-nav-link>

                    <!-- Authentication -->
                    <form
                        method="POST"
                        @submit.prevent="logout">
                        <jet-responsive-nav-link as="button"> Logout </jet-responsive-nav-link>
                    </form>
                </div>
            </div>
            <!-- End: Responsive Settings Options -->
        </div>
        <!-- End: Responsive Navigation Menu -->
    </nav>
</template>

<script>
import { Link } from '@inertiajs/vue3'
import JetApplicationMark from '@/Jetstream/ApplicationMark.vue'
import JetDropdown from '@/Jetstream/Dropdown.vue'
import JetDropdownLink from '@/Jetstream/DropdownLink.vue'
import JetNavLink from '@/Jetstream/NavLink.vue'
import JetResponsiveNavLink from '@/Jetstream/ResponsiveNavLink.vue'
export default {
    components: {
        Link,
        JetApplicationMark,
        JetDropdown,
        JetDropdownLink,
        JetNavLink,
        JetResponsiveNavLink,
    },
    data() {
        return {
            showingNavigationDropdown: false,
        }
    },

    methods: {
        logout() {
            this.$inertia.post(route('logout'))
        },
    },
}
</script>
