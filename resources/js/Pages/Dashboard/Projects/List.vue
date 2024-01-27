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
            <form class="space-y-5" @submit.prevent="submit">
                <div class="flex w-full space-x-4 justify-between">
                    <div class="flex-auto">
                        <BaseInput>
                            <label>Search</label>
                            <input type="text" class="form-input" v-model="form.search"/>
                        </BaseInput>
                    </div>
                    <div class="max-h-fit place-self-end">
                        <button class="btn btn-outline-primary" type="submit">Filter</button>
                    </div>
                    <div class="max-h-fit place-self-end">
                        <Link href="/projects" class="btn btn-outline-primary" as="button">Clear</Link>
                    </div>
                </div>
            </form>
            <TableView :data="data" :headers="headers" :actions="actions" />
        </template>
    </Layout>
</template>

<script setup>
import { ref } from 'vue';
import Layout from "@/Shared/Layout.vue"
import TableView from "@/Shared/TableView.vue"
import BaseInput from "@/Shared/Components/BaseInput.vue";
import {useForm} from "@inertiajs/vue3";


const props = defineProps({
    data: Object,
    subtitle: Object,
    services: Array
})

props.data.data.map(data => {
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
    { label: 'project name', column: 'name', class: 'w-1/4' },
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

let form = useForm({
    search: ''
})

const route = new URLSearchParams(window.location);
if (route.get('search')) {
    const query = new URLSearchParams(window.location.search);
    form.search = query.get('search');
}

let submit = () => {
    form.get(`/projects`);
}
</script>
