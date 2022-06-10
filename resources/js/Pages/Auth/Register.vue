<template>
    <app-layout>
        <Head title="Register" />

        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">Register</h2>
        </template>

        <jet-authentication-card>
            <jet-validation-errors class="mb-4" />

            <form @submit.prevent="submit">
                <div>
                    <jet-label for="name" value="Name" />
                    <jet-input
                        id="name"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.name"
                        required
                        autofocus
                        autocomplete="name"
                    />
                </div>

                <div class="mt-4">
                    <jet-label for="email" value="Email" />
                    <jet-input id="email" type="email" class="mt-1 block w-full" v-model="form.email" required />
                    <p class="mt-2 text-sm text-indigo-600">Must use company email address</p>
                </div>

                <div class="mt-4">
                    <jet-label for="password" value="Password" />
                    <jet-input
                        id="password"
                        type="password"
                        class="mt-1 block w-full"
                        v-model="form.password"
                        required
                        autocomplete="new-password"
                    />
                </div>

                <div class="mt-4">
                    <jet-label for="password_confirmation" value="Confirm Password" />
                    <jet-input
                        id="password_confirmation"
                        type="password"
                        class="mt-1 block w-full"
                        v-model="form.password_confirmation"
                        required
                        autocomplete="new-password"
                    />
                </div>

                <div class="mt-4">
                    <jet-label for="timezone" value="Timezone" />
                    <time-zone-select @tz="selectTz" id="timezone"></time-zone-select>
                </div>

                <div class="mt-5" v-if="$page.props.jetstream.hasTermsAndPrivacyPolicyFeature">
                    <jet-label for="terms">
                        <div class="flex items-center">
                            <jet-checkbox name="terms" id="terms" v-model:checked="form.terms" />

                            <div class="ml-2">
                                I agree to the
                                <a
                                    target="_blank"
                                    :href="route('terms.show')"
                                    class="text-sm text-gray-600 underline hover:text-gray-900"
                                    >Terms of Service</a
                                >
                                and
                                <a
                                    target="_blank"
                                    :href="route('policy.show')"
                                    class="text-sm text-gray-600 underline hover:text-gray-900"
                                    >Privacy Policy</a
                                >
                            </div>
                        </div>
                    </jet-label>
                </div>

                <div class="mt-5 flex items-center justify-end">
                    <Link :href="route('login')" class="text-sm text-gray-600 underline hover:text-gray-900">
                        Already registered?
                    </Link>

                    <jet-button class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Register
                    </jet-button>
                </div>
            </form>
        </jet-authentication-card>
    </app-layout>
</template>

<script>
import { defineComponent } from 'vue'
import AppLayout from '@/Layouts/AppLayout.vue'
import JetAuthenticationCard from '@/Jetstream/AuthenticationCard.vue'
import JetAuthenticationCardLogo from '@/Jetstream/AuthenticationCardLogo.vue'
import JetButton from '@/Jetstream/Button.vue'
import JetInput from '@/Jetstream/Input.vue'
import JetCheckbox from '@/Jetstream/Checkbox.vue'
import JetLabel from '@/Jetstream/Label.vue'
import JetValidationErrors from '@/Jetstream/ValidationErrors.vue'
import TimeZoneSelect from '@/Components/TimeZoneSelect.vue'
import { Head, Link } from '@inertiajs/inertia-vue3'

export default defineComponent({
    components: {
        Head,
        AppLayout,
        JetAuthenticationCard,
        JetAuthenticationCardLogo,
        JetButton,
        JetInput,
        JetCheckbox,
        JetLabel,
        JetValidationErrors,
        TimeZoneSelect,
        Link,
    },

    data() {
        return {
            form: this.$inertia.form({
                name: '',
                email: '',
                password: '',
                password_confirmation: '',
                timezone: '',
                terms: false,
            }),
        }
    },

    methods: {
        selectTz(e) {
            this.form.timezone = e
        },
        submit() {
            this.form.post(this.route('register'), {
                onFinish: () => this.form.reset('password', 'password_confirmation'),
            })
        },
    },
})
</script>
