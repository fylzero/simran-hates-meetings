<template>
    <div class="md:col-span-1">
        <div class="px-4 sm:px-0">
            <h3 class="text-xl font-medium text-white">
                <slot name="title"></slot>
            </h3>

            <p class="mt-1 text-base text-indigo-200">
                <slot name="description"></slot>
            </p>
        </div>
    </div>
</template>
