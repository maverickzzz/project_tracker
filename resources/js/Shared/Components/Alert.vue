<template>
    <div class="flex items-center p-3.5 rounded mb-4"
         :class="{
            'text-danger bg-danger-light dark:bg-danger-dark-light': alert_type === 'danger',
            'text-success bg-success-light dark:bg-success-dark-light': alert_type === 'success',
            'text-warning bg-warning-light dark:bg-warning-dark-light': alert_type === 'warning'
        }"
    >
        <span class="ltr:pr-2 rtl:pl-2">{{ message }}</span>
    </div>
</template>

<script setup>
const props = defineProps({
    alert_type: String,
    message: String
})
</script>
