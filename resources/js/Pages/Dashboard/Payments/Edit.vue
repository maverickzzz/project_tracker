<template>
    <Layout>
        <template #title>
            <h1 class="font-semibold text-lg dark:text-white-light">Payments - Edit {{ }}</h1>
        </template>
        <template #content>
            <form class="space-y-5" @submit.prevent="submit">
                <BaseInput :error="errors['date']">
                    <label for="groupname">Payment Date</label>
                    <input id="groupname" type="date" placeholder="Payment Date" v-model="form.date" class="form-input" />
                </BaseInput>
                <BaseInput :error="errors.project_id">
                    <label for="">Project</label>
                    <select class="form-select" v-model="form.project_id">
                        <template v-for="project in projects">
                            <option v-if="project.id === form.project_id" :value="project.id" selected>{{ project.name }}</option>
                            <option v-else :value="project.id">{{ project.name }}</option>
                        </template>
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
    data: Object,
    projects: Array,
    errors: Object,
    _origin: String,
})

let form = useForm({
    date: props.data.date,
    project_id: props.data.project_id,
    amount: props.data.amount < 0 ? props.data.amount * -1 : props.data.amount,
    is_expense: props.data.amount < 0,
    notes: props.data.notes,
    currency: props.data.currency,
});

let submit = () => {
    form.put(`/payments/${props.data.id}`);
}

</script>
