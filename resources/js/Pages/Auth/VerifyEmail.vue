<template>
    <app-layout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">Verify Email</h2>
        </template>

        <div>
            <jet-authentication-card>
                <div class="mb-4 text-sm text-gray-600">
                    Thanks for signing up! Before getting started, could you verify your email address by clicking on
                    the link we just emailed to you? If you didn't receive the email, we will gladly send you another.
                </div>

                <div class="mb-4 text-sm font-medium text-green-600" v-if="verificationLinkSent">
                    A new verification link has been sent to the email address you provided during registration.
                </div>

                <form @submit.prevent="submit">
                    <div class="mt-4 flex items-center justify-between">
                        <jet-button :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                            Resend Verification Email
                        </jet-button>

                        <inertia-link
                            :href="route('logout')"
                            method="post"
                            as="button"
                            class="text-sm text-gray-600 underline hover:text-gray-900"
                            >Logout</inertia-link
                        >
                    </div>
                </form>
            </jet-authentication-card>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout';
import JetAuthenticationCard from '@/Jetstream/AuthenticationCard';
import JetAuthenticationCardLogo from '@/Jetstream/AuthenticationCardLogo';
import JetButton from '@/Jetstream/Button';

export default {
    components: {
        AppLayout,
        JetAuthenticationCard,
        JetAuthenticationCardLogo,
        JetButton,
    },

    props: {
        status: String,
    },

    data() {
        return {
            form: this.$inertia.form(),
        };
    },

    methods: {
        submit() {
            this.form.post(this.route('verification.send'));
        },
    },

    computed: {
        verificationLinkSent() {
            return this.status === 'verification-link-sent';
        },
    },
};
</script>
