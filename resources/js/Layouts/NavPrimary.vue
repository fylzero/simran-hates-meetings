<template>
    <nav class="bg-white border-b border-gray-100">
        <!-- Primary Navigation Menu -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <!-- Logo -->
                    <div class="shrink-0 flex items-center">
                        <inertia-link :href="route('dashboard')" class="text-xl">
                            Simran Hates Meetings
                            <span class="font-sans">¯\_(ツ)_/¯</span>
                        </inertia-link>
                    </div>

                    <!-- Navigation Links -->
                    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                        <jet-nav-link :href="route('dashboard')" :active="route().current('dashboard')">
                            Dashboard
                        </jet-nav-link>
                        <jet-nav-link
                            v-if="$page.props.user"
                            :href="route('shame-log')"
                            :active="route().current('shame-log')"
                        >
                            Shame Log
                        </jet-nav-link>
                        <jet-nav-link
                            v-if="!$page.props.user"
                            :href="route('login')"
                            :active="route().current('login')"
                        >
                            Login
                        </jet-nav-link>
                        <jet-nav-link
                            v-if="!$page.props.user"
                            :href="route('register')"
                            :active="route().current('register')"
                        >
                            Register
                        </jet-nav-link>
                    </div>
                </div>

                <div class="hidden sm:flex sm:items-center sm:ml-6">
                    <template v-if="$page.props.user">
                        <button
                            v-if="$page.props.jetstream.managesProfilePhotos"
                            class="
                                flex
                                text-sm
                                border-2 border-transparent
                                rounded-full
                                focus:outline-none focus:border-gray-300
                                transition
                                duration-150
                                ease-in-out
                            "
                        >
                            <img
                                class="h-8 w-8 rounded-full object-cover"
                                :src="$page.props.user.profile_photo_url"
                                :alt="$page.props.user.name"
                            />
                        </button>

                        <span v-else class="inline-flex rounded-md" v-tooltip.bottom="'Profile & Settings'">
                            <inertia-link
                                :href="route('profile.show')"
                                :active="route().current('profile.show')"
                                class="
                                    inline-flex
                                    items-center
                                    px-3
                                    py-2
                                    border border-transparent
                                    text-base
                                    leading-4
                                    font-medium
                                    rounded-md
                                    text-gray-600
                                    bg-white
                                    hover:text-gray-700
                                    focus:outline-none
                                    transition
                                    ease-in-out
                                    duration-150
                                "
                            >
                                {{ $page.props.user.name }}
                            </inertia-link>
                        </span>
                    </template>

                    <form @submit.prevent="logout" v-if="$page.props.user">
                        <button type="submit" v-tooltip.bottom="'Logout'">
                            <i class="fas fa-power-off text-red-600"></i>
                        </button>
                    </form>
                </div>

                <!-- Hamburger -->
                <div class="-mr-2 flex items-center sm:hidden">
                    <button
                        @click="showingNavigationDropdown = !showingNavigationDropdown"
                        class="
                            inline-flex
                            items-center
                            justify-center
                            p-2
                            rounded-md
                            text-gray-400
                            hover:text-gray-500 hover:bg-gray-100
                            focus:outline-none focus:bg-gray-100 focus:text-gray-500
                            transition
                            duration-150
                            ease-in-out
                        "
                    >
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path
                                :class="{
                                    hidden: showingNavigationDropdown,
                                    'inline-flex': !showingNavigationDropdown,
                                }"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16"
                            />
                            <path
                                :class="{
                                    hidden: !showingNavigationDropdown,
                                    'inline-flex': showingNavigationDropdown,
                                }"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"
                            />
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
            class="sm:hidden"
        >
            <div class="pt-2 pb-3 space-y-1">
                <jet-responsive-nav-link :href="route('dashboard')" :active="route().current('dashboard')">
                    Dashboard
                </jet-responsive-nav-link>
                <jet-responsive-nav-link
                    v-if="$page.props.user"
                    :href="route('shame-log')"
                    :active="route().current('shame-log')"
                >
                    Shame Log
                </jet-responsive-nav-link>
                <jet-responsive-nav-link
                    v-if="!$page.props.user"
                    :href="route('login')"
                    :active="route().current('login')"
                >
                    Login
                </jet-responsive-nav-link>
                <jet-responsive-nav-link
                    v-if="!$page.props.user"
                    :href="route('register')"
                    :active="route().current('register')"
                >
                    Register
                </jet-responsive-nav-link>
            </div>

            <!-- Responsive Settings Options -->
            <div class="pt-4 pb-1 border-t border-gray-200" v-if="$page.props.user">
                <div class="flex items-center px-4">
                    <div v-if="$page.props.jetstream.managesProfilePhotos" class="shrink-0 mr-3">
                        <img
                            class="h-10 w-10 rounded-full object-cover"
                            :src="$page.props.user.profile_photo_url"
                            :alt="$page.props.user.name"
                        />
                    </div>

                    <div>
                        <div class="font-medium text-base text-gray-800">
                            {{ $page.props.user.name }}
                        </div>
                        <div class="font-medium text-sm text-gray-500">
                            {{ $page.props.user.email }}
                        </div>
                    </div>
                </div>

                <div class="mt-3 space-y-1">
                    <jet-responsive-nav-link :href="route('profile.show')" :active="route().current('profile.show')">
                        Profile
                    </jet-responsive-nav-link>

                    <!-- Authentication -->
                    <form method="POST" @submit.prevent="logout">
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
import JetApplicationMark from '@/Jetstream/ApplicationMark';
import JetDropdown from '@/Jetstream/Dropdown';
import JetDropdownLink from '@/Jetstream/DropdownLink';
import JetNavLink from '@/Jetstream/NavLink';
import JetResponsiveNavLink from '@/Jetstream/ResponsiveNavLink';
export default {
    components: {
        JetApplicationMark,
        JetDropdown,
        JetDropdownLink,
        JetNavLink,
        JetResponsiveNavLink,
    },
    data() {
        return {
            showingNavigationDropdown: false,
        };
    },

    methods: {
        logout() {
            this.$inertia.post(route('logout'));
        },
    },
};
</script>
