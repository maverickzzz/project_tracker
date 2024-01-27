<template>
    <Layout>
        <template #title>
            <div>
                <h1>User Groups</h1>
            </div>
            <Link class="btn btn-primary" href="/usergroups/create"><Icon :name="'plus'" /> Add</Link>
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
                        <Link href="/project-owners" class="btn btn-outline-primary" as="button">Clear</Link>
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
import Icon from "@/Shared/Components/Icon.vue";
import BaseInput from "@/Shared/Components/BaseInput.vue";
import {useForm} from "@inertiajs/vue3";

const props = defineProps({
    data: Object,
})

const headers = ref([
    { label: 'name', column: 'name' },
    // { label: 'access', column: 'access' },
    // { label: 'list', column: 'access.sales_order_list' },
    // { label: 'collecting', column: 'access.sales_order_collecting' },
    // { label: 'checking', column: 'access.sales_order_checking' },
    // { label: 'packing', column: 'access.sales_order_packing' },
    // { label: 'username', column: 'username' },
    // { label: 'user group', column: 'usergroup', property: 'name' },
    { label: 'action', column: 'action' },
]);

const actions = ref([
    { label: 'edit', icon: 'pencil', tooltip: 'edit', url: '/usergroups' },
    { label: 'delete', icon: 'trash', tooltip: 'delete', url: '/usergroups' },
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
    form.get(`/usergroups`);
}
</script>
