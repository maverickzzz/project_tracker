<template>
    <Layout>
        <template #title>
            <div>
                <h1 class="font-semibold text-lg dark:text-white-light">Projects</h1>
                <h2 v-if="subtitle">{{ 'of ' + subtitle.name }}</h2>
            </div>
            <Link class="btn btn-primary" href="/projects/create">Add</Link>
        </template>
        <template #content>
            <TableView :data="additionalData" :headers="headers" :actions="actions" />
        </template>
    </Layout>
</template>

<script setup>
import { ref } from 'vue';
import Layout from "@/Shared/Layout.vue"
import TableView from "@/Shared/TableView.vue"


const props = defineProps({
    data: Array,
    subtitle: Object,
    services: Array
})

const additionalData = [...props.data];
additionalData.map(data => {
    let badges = '';
    if (props.services.filter(service => service.type === 'Maintenance' && service.project_id === data.id).length > 0) {
        badges += '<span class=\"badge mr-2 badge-outline-primary\">Maintenance</span>'
    }
    if (props.services.filter(service => service.type === 'SEO' && service.project_id === data.id).length > 0) {
        badges += '<span class=\"badge mr-2 badge-outline-success\">SEO</span>'
    }
    if (props.services.filter(service => service.type === 'Domain' && service.project_id === data.id).length > 0) {
        badges += '<span class=\"badge mr-2 badge-outline-danger\">Domain</span>'
    }
    if (props.services.filter(service => service.type === 'Hosting' && service.project_id === data.id).length > 0) {
        badges += '<span class=\"badge mr-2 badge-outline-warning\">Hosting</span>'
    }
    data['service'] = badges;
})

const headers = ref([
    { label: 'id', column: 'id' },
    { label: 'project name', column: 'name' },
    { label: 'project owner', column: 'owner', property: 'name' },
    { label: 'referrer', column: 'referrer' },
    { label: 'url', column: 'url' },
    { label: 'service', column: 'service', type: 'html' },
    { label: 'is active', column: 'is_active', type: 'boolean' },
    { label: 'action', column: 'action' },
]);

const actions = ref([
    { label: 'services', icon: 'chart-bar', tooltip: 'services', url: '/projects/:id/services' },
    { label: 'edit', icon: 'pencil', tooltip: 'edit', url: '/projects' },
    // { label: 'delete', icon: 'trash', tooltip: 'delete', url: '/projects' },
    // { label: 'payments', icon: 'dollar', tooltip: 'payments', url: '/projects/:id/payments' },
    // { label: 'services', icon: 'cog', tooltip: 'services', url: '/projects/:id/services' },
]);
</script>
