<script setup>
import {ref} from "vue";

const props = defineProps({
    status: Number,
})

let type = ref('');
let label = ref('');

switch (props.status.value) {
    case 0:
        type.value = 'primary';
        label.value = 'New';
        break;
    case 1:
        type.value = 'secondary';
        label.value = 'Assigned';
        break;
    case 4:
        type.value = 'danger';
        label.value = 'Rejected';
        break;
    case 99:
        type.value = 'success';
        label.value = 'Completed';
        break;
}
</script>

<template>
    <span :class="'badge badge-outline-' + type ">{{ label }}</span>
</template>

<style scoped>

</style>
