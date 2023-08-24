<template>
    <i :class="'mr-2 icon pi pi-' + name"></i>
</template>

<script setup>
const props = defineProps({
    name: String,
})
</script>
