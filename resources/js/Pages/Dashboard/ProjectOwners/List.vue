<template>
    <Layout>
        <template #title>
            <h1 class="font-semibold text-lg dark:text-white-light">Project Owners</h1>
            <Link class="btn btn-primary" href="/project-owners/create">Add</Link>
        </template>
        <template #content>
            <TableView :data="data" :headers="headers" :actions="actions" />
        </template>
    </Layout>

    <!-- <Modal :open="open">
        <template #title>
            Project Owner
        </template>
        <template #content>
            <div class="dark:text-white-dark/70 text-base font-medium text-[#1f2937]">
                <p>Mauris mi tellus, pharetra vel mattis sed, tempus ultrices eros. Phasellus egestas sit amet velit sed luctus. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Suspendisse potenti. Vivamus ultrices sed urna ac pulvinar. Ut sit amet ullamcorper mi.</p>
            </div>
        </template>
    </Modal> -->
</template>

<script setup>
import { ref } from 'vue';
import Layout from "@/Shared/Layout.vue"
import TableView from "@/Shared/TableView.vue"

// import Modal from '@/Shared/Modal.vue'

const props = defineProps({
    data: Array,
})

const headers = ref([
    { label: 'id', column: 'id' },
    { label: 'name', column: 'name' },
    { label: 'country', column: 'country' },
    { label: 'contact number', column: 'contact_number' },
    { label: 'no of projects', column: 'total_projects'},
    { label: 'total payments', column: 'total_payment'},
    { label: 'action', column: 'action' },
]);

const actions = ref([
    { label: 'edit', icon: 'pencil', tooltip: 'edit', url: '/project-owners' },
    { label: 'delete', icon: 'trash', tooltip: 'delete', url: '/project-owners' },
    { label: 'projects', icon: 'code', tooltip: 'projects', url: '/project-owners/:id/projects' },
]);
</script>
