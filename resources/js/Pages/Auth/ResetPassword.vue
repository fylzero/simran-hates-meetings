<template>
    <app-layout>
        <Head title="Reset Password" />

        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">Reset Password</h2>
        </template>

        <jet-authentication-card>
            <jet-validation-errors class="mb-4" />

            <form @submit.prevent="submit">
                <div>
                    <jet-label
                        for="email"
                        value="Email" />
                    <jet-input
                        id="email"
                        type="email"
                        class="mt-1 block w-full"
                        v-model="form.email"
                        required
                        autofocus />
                </div>

                <div class="mt-4">
                    <jet-label
                        for="password"
                        value="Password" />
                    <jet-input
                        id="password"
                        type="password"
                        class="mt-1 block w-full"
                        v-model="form.password"
                        required
                        autocomplete="new-password" />
                </div>

                <div class="mt-4">
                    <jet-label
                        for="password_confirmation"
                        value="Confirm Password" />
                    <jet-input
                        id="password_confirmation"
                        type="password"
                        class="mt-1 block w-full"
                        v-model="form.password_confirmation"
                        required
                        autocomplete="new-password" />
                </div>

                <div class="mt-4 flex items-center justify-end">
                    <jet-button
                        :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing">
                        Reset Password
                    </jet-button>
                </div>
            </form>
        </jet-authentication-card>
    </app-layout>
</template>

<script>
import { defineComponent } from 'vue'
import { Head } from '@inertiajs/vue3'
import AppLayout from '@/Layouts/AppLayout.vue'
import JetAuthenticationCard from '@/Jetstream/AuthenticationCard.vue'
import JetAuthenticationCardLogo from '@/Jetstream/AuthenticationCardLogo.vue'
import JetButton from '@/Jetstream/Button.vue'
import JetInput from '@/Jetstream/Input.vue'
import JetLabel from '@/Jetstream/Label.vue'
import JetValidationErrors from '@/Jetstream/ValidationErrors.vue'

export default defineComponent({
    components: {
        Head,
        AppLayout,
        JetAuthenticationCard,
        JetAuthenticationCardLogo,
        JetButton,
        JetInput,
        JetLabel,
        JetValidationErrors,
    },

    props: {
        email: String,
        token: String,
    },

    data() {
        return {
            form: this.$inertia.form({
                token: this.token,
                email: this.email,
                password: '',
                password_confirmation: '',
            }),
        }
    },

    methods: {
        submit() {
            this.form.post(this.route('password.update'), {
                onFinish: () => this.form.reset('password', 'password_confirmation'),
            })
        },
    },
})
</script>
