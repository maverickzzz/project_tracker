<template>
    <Layout>
        <template #title>
            <h1 class="font-semibold text-lg dark:text-white-light">Payments - Create</h1>
        </template>
        <template #content>
            <form class="space-y-5" @submit.prevent="submit">
                <BaseInput :error="errors.date">
                    <label for="group-name">Payment Date</label>
                    <input id="groupname" type="date" placeholder="Payment Date" v-model="form.date" class="form-input" />
                </BaseInput>
                <BaseInput :error="errors.project_id">
                    <label for="">Project</label>
                    <select class="form-select" v-model="form.project_id" :disabled="selected_project > 0">
                        <option v-for="project in projects" :value="project.id">{{ project.name }}</option>
                    </select>
                </BaseInput>
                <BaseInput :error="errors.currency">
                    <label for="">Currency</label>
                    <input type="text" placeholder="Currency" v-model="form.currency" class="form-input" />
                </BaseInput>
                <BaseInput :error="errors.amount">
                    <label for="groupname">Amount</label>
                    <input id="groupname" type="number" placeholder="Amount" v-model="form.amount" class="form-input" />
                    <div class="pt-2">
                        <input type="checkbox" v-model="form.is_expense" /> Is expense
                    </div>
                </BaseInput>
                <BaseInput :error="errors.notes">
                    <label for="groupname">Notes</label>
                    <textarea rows="10" v-model="form.notes" class="form-input">{{ form.notes }}</textarea>
                </BaseInput>
                <div class="flex space-x-3">
                    <button class="btn btn-primary" type="submit">Save</button>
                    <Link :href="_origin" class="btn btn-outline-primary outline">Cancel</Link>
                </div>
            </form>
        </template>
    </Layout>
</template>

<script setup>
import Layout from "@/Shared/Layout.vue"
import { useForm } from '@inertiajs/vue3';
import BaseInput from "@/Shared/Components/BaseInput.vue"

const props = defineProps({
    projects: Array,
    selected_project: Number,
    errors: Object,
    _origin: String,
})

let form = useForm({
    date: new Date().toISOString().slice(0, 10),
    project_id: props.selected_project > 0 ? +props.selected_project : null,
    amount: 0,
    is_expense: false,
    notes: null,
    currency: 'IDR',
});

let submit = () => {
    form.post('/payments');
}

</script>
