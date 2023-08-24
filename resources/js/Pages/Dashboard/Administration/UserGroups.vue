<template>
    <Layout>
        <template #title>
            <h1>User Groups</h1>
        </template>
        <template #content>
            <TableView :data="data" :headers="headers" :actions="actions" />
        </template>
    </Layout>
</template>

<script setup>
import { ref } from 'vue';
import Layout from "@/Shared/Layout.vue"
import TableView from "@/Shared/TableView.vue"

const props = defineProps({
    data: Array,
})

const headers = ref([
    { label: 'nama', column: 'name' },
    { label: 'permissions', column: 'permissions' },
    { label: 'action', column: 'action' },
]);

const actions = ref([
    { label: 'edit', icon: 'pencil', tooltip: 'edit', url: '/payments' },
    { label: 'delete', icon: 'trash', tooltip: 'delete', url: '/payments' },
]);
</script>
