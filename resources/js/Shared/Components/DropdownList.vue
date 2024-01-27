<script setup>
const props = defineProps({
    lists: Array,
    modelValue: String | Number,
    useStringValue: false
});
defineEmits(['update:modelValue'])
</script>

<template>
    <select class="form-input" :value="modelValue" @change="$emit('update:modelValue', $event.target.value)">
        <option v-for="item in lists" :value="useStringValue ? item.strvalue : item.intvalue">{{
                item.label
            }}
        </option>
    </select>
</template>
