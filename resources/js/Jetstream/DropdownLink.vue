<template>
    <div>
        <button
            type="submit"
            class="block w-full px-4 py-2 text-left text-sm leading-5 text-gray-700 transition duration-150 ease-in-out hover:bg-gray-100 focus:bg-gray-100 focus:outline-none"
            v-if="as == 'button'"
        >
            <slot></slot>
        </button>

        <inertia-link
            :href="href"
            class="block px-4 py-2 text-sm leading-5 text-gray-700 transition duration-150 ease-in-out hover:bg-gray-100 focus:bg-gray-100 focus:outline-none"
            v-else
        >
            <slot></slot>
        </inertia-link>
    </div>
</template>

<script>
export default {
    props: ['href', 'as'],
};
</script>
