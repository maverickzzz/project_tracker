<template>
    <div :class="{ 'has-error': error }">
        <slot></slot>
        <template v-if="error">
            <p class="text-danger mt-1">{{ error }}</p>
        </template>
    </div>
</template>

<script setup>
const props = defineProps({
    error: String
})
</script>
