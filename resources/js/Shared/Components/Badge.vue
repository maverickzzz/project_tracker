<template>
    <span :class="`badge mr-2 badge-outline-${type}`">{{ label }}</span>
</template>

<script setup>
const props = defineProps({
    type: String,
    label: String
})
</script>
