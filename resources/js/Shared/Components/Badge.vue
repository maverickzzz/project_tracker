<template>
<span :class="`badge mr-2 bg-${type}`">{{ label }}</span>
</template>

<script setup>
const props = defineProps({
    type: String,
    label: String
})
</script>
