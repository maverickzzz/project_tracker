<template>
    <Layout>
        <template #title>
            <div>
                <h1 class="font-semibold text-lg dark:text-white-light">Payments</h1>
                <h2 v-if="subtitle">{{ 'of ' + subtitle.name }}</h2>
            </div>
            <Link class="btn btn-primary" href="/payments/create">Add</Link>
        </template>
        <template #content>
            <h2>By Date</h2>
            <TableView :data="data1" :headers="headers1" :actions="actions" />
            <h2 class="mt-8">By Projects</h2>
            <TableView :data="data2" :headers="headers2" />
        </template>
    </Layout>
</template>

<script setup>
import { ref } from 'vue';
import Layout from "@/Shared/Layout.vue"
import TableView from "@/Shared/TableView.vue"


const props = defineProps({
    data1: Array,
    data2: Array,
    subtitle: Object
})

const headers1 = ref([
    { label: 'id', column: 'id' },
    { label: 'date', column: 'date' },
    { label: 'project', column: 'project', property: 'name' },
    { label: 'amount', column: 'amount' },
    { label: 'action', column: 'action' },
]);

const headers2 = ref([
    { label: 'project', column: 'project', property: 'name' },
    { label: 'amount', column: 'amount' },
]);

const actions = ref([
    { label: 'edit', icon: 'pencil', tooltip: 'edit', url: '/payments' },
    { label: 'delete', icon: 'trash', tooltip: 'delete', url: '/payments' },
]);
</script>
