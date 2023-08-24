<template>
    <Layout>
        <template #title>
            <div>
                <h1 class="font-semibold text-lg dark:text-white-light">{{ project.name }}</h1>
            </div>
        </template>
        <template #content>
            <div>
                <div class="flex space-x-4">
                    <div
                        class="w-1/2 bg-white shadow-[4px_6px_10px_-3px_#bfc9d4] rounded border border-[#e0e6ed] dark:border-[#1b2e4b] dark:bg-[#191e3a] dark:shadow-none">
                        <div class="py-7 px-6">
                            <div class="flex justify-between">
                                <h5 class="text-[#3b3f5c] text-xl font-semibold mb-4 dark:text-white-light">Project</h5>
                                <Link :href="`/projects/${project.id}/edit`">
                                    <Icon :name="'pencil'"/>
                                </Link>
                            </div>
                            <table class="table-hover">
                                <tbody>
                                <tr>
                                    <th>Name</th>
                                    <td>{{ project.name }}</td>
                                </tr>
                                <tr>
                                    <th>URL</th>
                                    <td>{{ project.url }}</td>
                                </tr>
                                <tr>
                                    <th>Is Active</th>
                                    <td>
                                        <span v-if="project.is_active === 1" class="badge bg-success">Yes</span>
                                        <span v-if="project.is_active === 0" class="badge bg-danger">No</span>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div
                        class="w-1/2 bg-white shadow-[4px_6px_10px_-3px_#bfc9d4] rounded border border-[#e0e6ed] dark:border-[#1b2e4b] dark:bg-[#191e3a] dark:shadow-none">
                        <div class="py-7 px-6">
                            <div class="flex justify-between">
                                <h5 class="text-[#3b3f5c] text-xl font-semibold mb-4 dark:text-white-light">Owner</h5>
                                <Link :href="`/project-owners/${project.owner.id}/edit`">
                                    <Icon :name="'pencil'"/>
                                </Link>
                            </div>
                            <table class="table-hover">
                                <tbody>
                                <tr>
                                    <th>Name</th>
                                    <td>{{ project.owner.name }}</td>
                                </tr>
                                <tr>
                                    <th>Contact</th>
                                    <td>
                                        <a target="_blank" :href="'https://wa.me/' + project.owner.contact_number">
                                            {{ project.owner.contact_number }}
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Country</th>
                                    <td>{{ project.owner.country }}</td>
                                </tr>
                                </tbody>
                            </table>

                        </div>
                    </div>
                    <div
                        class="w-1/2 bg-white shadow-[4px_6px_10px_-3px_#bfc9d4] rounded border border-[#e0e6ed] dark:border-[#1b2e4b] dark:bg-[#191e3a] dark:shadow-none">
                        <div class="py-7 px-6">
                            <div class="flex justify-between">
                                <h5 class="text-[#3b3f5c] text-xl font-semibold mb-4 dark:text-white-light">Incomes</h5>
                            </div>
                            <table class="table-hover">
                                <tbody>
                                <tr>
                                    <th>Gross Income</th>
                                    <td>{{
                                            payments.reduce((acc, item) => acc +
                                                item.amount, 0).toLocaleString()
                                        }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Expense</th>
                                    <td>{{
                                            (expenses.reduce((acc, item) => acc +
                                                item.amount, 0) * -1).toLocaleString()
                                        }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Nett Income</th>
                                    <td>{{
                                            (payments.reduce((acc, item) => acc + item.amount, 0) + expenses.reduce((acc,
                                                                                                                     item) => acc +
                                                item.amount, 0)).toLocaleString()
                                        }}
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div
                class="mt-8 w-full bg-white shadow-[4px_6px_10px_-3px_#bfc9d4] rounded border border-[#e0e6ed] dark:border-[#1b2e4b] dark:bg-[#191e3a] dark:shadow-none">
                <div class="py-7 px-6">
                    <div class="flex justify-between">
                        <h1 class="font-semibold text-lg dark:text-white-light">Services</h1>
                        <label class="flex items-center cursor-pointer">
                            <input type="checkbox" class="form-checkbox" v-model="bolShowAll"/>
                            <span>Show all services</span>
                        </label>
                    </div>
                    <TableView class="w-full" :data="filteredServices" :headers="headers" :actions="actions"/>
                </div>
            </div>
            <div class="flex space-x-8 mt-8 ">
                <div
                    class="w-1/2 bg-white shadow-[4px_6px_10px_-3px_#bfc9d4] rounded border border-[#e0e6ed] dark:border-[#1b2e4b] dark:bg-[#191e3a] dark:shadow-none">
                    <div class="py-7 px-6">
                        <div class="flex justify-between">
                            <h1 class="font-semibold text-lg dark:text-white-light">Payments</h1>
                            <Link :href="`/projects/${project.id}/payments/create`">
                                <Icon :name="'plus'"/>
                            </Link>
                        </div>
                        <TableView class="w-full" :data="payments" :headers="headers2" :actions="actions2"/>
                        <div class="flex justify-between mt-16">
                            <h1 class="font-semibold text-lg dark:text-white-light">Expenses</h1>
                            <Link :href="`/projects/${project.id}/payments/create`">
                                <Icon :name="'plus'"/>
                            </Link>
                        </div>
                        <TableView class="w-full" :data="expenses" :headers="headers2" :actions="actions2"/>
                    </div>
                </div>
                <div
                    class="w-1/2 bg-white shadow-[4px_6px_10px_-3px_#bfc9d4] rounded border border-[#e0e6ed] dark:border-[#1b2e4b] dark:bg-[#191e3a] dark:shadow-none">
                    <div class="py-7 px-6">
                        <div class="w-full">
                            <div class="flex justify-between">
                                <h1 class="font-semibold text-lg dark:text-white-light">Logs</h1>
                                <Link :href="`/projects/${project.id}/service-logs/create`">
                                    <Icon :name="'plus'"/>
                                </Link>
                            </div>
                            <TableView class="w-full" :data="logs" :headers="headers3" :actions="actions3"/>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <div class=" flex space-x-4">
                <ServiceCard v-for="d in filteredServices" :service="d" />
            </div>-->
        </template>
    </Layout>
</template>

<script setup>
import {watch, ref, computed} from 'vue'
import Layout from '@/Shared/Layout.vue'
import ServiceCard from '@/Shared/Components/ServiceCard.vue'
import Icon from '@/Shared/Components/Icon.vue'
import TableView from "@/Shared/TableView.vue"


const props = defineProps({
    project: Object,
    data: Array,
    success: String,
    payments: Array,
    expenses: Array,
    logs: Array,
})

const headers = ref([
    // { label: 'id', column: 'id' },
    {label: 'type', column: 'type'},
    {label: 'from', column: 'start_date'},
    {label: 'to', column: 'end_date'},
    {label: 'currency', column: 'currency'},
    {label: 'amount', column: 'amount'},
    {label: 'is active', column: 'is_active', type: 'boolean'},
    {label: 'notes', column: 'notes'},
    {label: 'action', column: 'action'},
]);

const actions = ref([
    {label: 'edit', icon: 'pencil', tooltip: 'edit', url: `/projects/${props.project.id}/services`},
    // { label: 'delete', icon: 'trash', tooltip: 'delete', url: '/projects' },
    // { label: 'payments', icon: 'dollar', tooltip: 'payments', url: '/projects/:id/payments' },
    // { label: 'services', icon: 'cog', tooltip: 'services', url: '/projects/:id/services' },
]);

const bolShowAll = ref(false);
let filteredServices = ref([...props.data.filter(d => d.is_active === 1)]);
// let filteredPayments = ref([...props.payments.filter(d => d.amount > 0)].sort((a, b) => b.date.toLocaleString() > a.date.toLocaleString()));
// let filteredExpenses = ref([...props.payments.filter(d => d.amount < 0)].sort((a, b) => b.date.toLocaleString() > a.date.toLocaleString()));

watch(bolShowAll, async (newValue, oldValue) => {
    console.log(newValue, oldValue)
    if (newValue !== oldValue) {
        filteredServices.value = [...props.data.filter(d => newValue === true || (newValue === false && d.is_active === 1))]
    }
})

const headers2 = ref([
    {label: 'date', column: 'date'},
    {label: 'amount', column: 'amount'},
    {label: 'notes', column: 'notes'},
    {label: 'action', column: 'action'},
]);

const actions2 = ref([
    {label: 'edit', icon: 'pencil', tooltip: 'edit', url: `/payments`},
    {label: 'delete', icon: 'trash', tooltip: 'delete', url: '/payments'},
]);

const headers3 = ref([
    {label: 'date', column: 'date'},
    {label: 'notes', column: 'notes'},
    {label: 'action', column: 'action'},
]);

const actions3 = ref([
    {label: 'edit', icon: 'pencil', tooltip: 'edit', url: '/service-logs'},
    {label: 'delete', icon: 'trash', tooltip: 'delete', url: '/service-logs'},
]);

// const headers2 = ref([
//     { label: 'project', column: 'project', property: 'name' },
//     { label: 'amount', column: 'amount' },
// ]);

// const filteredServices = computed(() => {
//     return props.data.filter(d => bolShowAll.value || (!bolShowAll.value && d.is_active === 1))
// })
</script>
