<template>
    <select class="form-select" v-model="value" @change="$emit('update:modelValue', $event.target.value)">
        <option value="0">{{ labelFalse }}</option>
        <option value="1">{{ labelTrue }}</option>
    </select>
</template>

<script setup>
import { ref } from 'vue';

const props = defineProps(['modelValue', 'labelTrue', 'labelFalse']);
const emits = defineEmits(['update:modelValue']);
let value = ref(props.modelValue);
</script>
