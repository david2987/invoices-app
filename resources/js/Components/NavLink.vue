<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    href: {
        type: String,
        required: true,
    },
    active: {
        type: Boolean,
    },
});

const classes = computed(() =>
    props.active
        ? 'inline-flex items-center px-1 pt-1 border-b-2 border-indigo-400 dark:border-indigo-600 text-lg   font-medium leading-5 text-white dark:text-gray-100 focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out gap-1'
        : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-lg font-medium leading-5 text-white dark:text-gray-400 hover:text-black dark:hover:text-gray-300 hover:border-gray-300 dark:hover:border-black focus:outline-none focus:text-gray-700 dark:focus:text-black focus:border-gray-300 dark:focus:border-gray-700 transition duration-150 ease-in-out gap-1'
);
</script>

<template>
    <Link :href="href" :class="classes">
        <slot />
    </Link>
</template>
