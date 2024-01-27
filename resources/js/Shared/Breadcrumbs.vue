<template>
    <ul class="flex">
        <li v-for="(comp, idx) in component">
            <template v-if="idx > 0">
                <span class="mx-2">/</span>
            </template>
            <span>{{ comp.split(/(?=[A-Z])/).join(' ') }}</span>
        </li>
    </ul>
</template>

<script setup>
import { usePage } from '@inertiajs/vue3'

const component = usePage().component.split('/').slice(1);
</script>
