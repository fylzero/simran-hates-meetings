<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Register</h2>
        </template>

        <div>
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

                    <div class="mt-4" v-if="$page.props.jetstream.hasTermsAndPrivacyPolicyFeature">
                        <jet-label for="terms">
                            <div class="flex items-center">
                                <jet-checkbox name="terms" id="terms" v-model:checked="form.terms" />

                                <div class="ml-2">
                                    I agree to the
                                    <a
                                        target="_blank"
                                        :href="route('terms.show')"
                                        class="underline text-sm text-gray-600 hover:text-gray-900"
                                        >Terms of Service</a
                                    >
                                    and
                                    <a
                                        target="_blank"
                                        :href="route('policy.show')"
                                        class="underline text-sm text-gray-600 hover:text-gray-900"
                                        >Privacy Policy</a
                                    >
                                </div>
                            </div>
                        </jet-label>
                    </div>

                    <div class="flex items-center justify-end mt-8">
                        <inertia-link
                            :href="route('login')"
                            class="underline text-sm text-gray-600 hover:text-gray-900"
                        >
                            Already registered?
                        </inertia-link>

                        <jet-button class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                            Register
                        </jet-button>
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
import JetInput from '@/Jetstream/Input';
import JetCheckbox from '@/Jetstream/Checkbox';
import JetLabel from '@/Jetstream/Label';
import JetValidationErrors from '@/Jetstream/ValidationErrors';
import TimeZoneSelect from '@/Components/TimeZoneSelect';

export default {
    components: {
        AppLayout,
        JetAuthenticationCard,
        JetAuthenticationCardLogo,
        JetButton,
        JetInput,
        JetCheckbox,
        JetLabel,
        JetValidationErrors,
        TimeZoneSelect,
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
        };
    },

    methods: {
        selectTz(e) {
            this.form.timezone = e;
        },
        submit() {
            this.form.post(this.route('register'), {
                onFinish: () => this.form.reset('password', 'password_confirmation'),
            });
        },
    },
};
</script>
