<template>
    <Layout>
        <template #title>
            <h1 class="font-semibold text-lg dark:text-white-light">Project Owners</h1>
            <Link class="btn btn-primary" href="/project-owners/create">Add</Link>
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
                        <Link href="/usergroups" class="btn btn-outline-primary" as="button">Clear</Link>
                    </div>
                </div>
            </form>
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
import BaseInput from "@/Shared/Components/BaseInput.vue";
import {useForm} from "@inertiajs/vue3";

// import Modal from '@/Shared/Modal.vue'

const props = defineProps({
    data: Object,
})

const headers = ref([
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

let form = useForm({
    search: ''
})

const route = new URLSearchParams(window.location);
if (route.get('search')) {
    const query = new URLSearchParams(window.location.search);
    form.search = query.get('search');
}

let submit = () => {
    form.get(`/project-owners`);
}
</script>
