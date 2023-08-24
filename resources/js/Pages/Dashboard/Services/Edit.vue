<template>
    <Layout>
        <template #title>
            <h1 class="font-semibold text-lg dark:text-white-light">Services - Update</h1>
        </template>
        <template #content>
            <form class="space-y-5" @submit.prevent="submit">
                <BaseInput :error="errors.type">
                    <label for="groupname">Service Name</label>
                    <input id="groupname" type="text" placeholder="Service Name" v-model="form.type" class="form-input" readonly />
                </BaseInput>
                <BaseInput :error="errors.start_date">
                    <label for="">Start Date</label>
                    <input type="date" placeholder="Start Date" v-model="form.start_date" class="form-input" />
                </BaseInput>
                <BaseInput :error="errors.end_date">
                    <label for="">End Date</label>
                    <input type="date" placeholder="End Date" v-model="form.end_date" class="form-input" />
                </BaseInput>
                <BaseInput :error="errors.currency">
                    <label for="">Currency</label>
                    <input type="text" placeholder="Currency" v-model="form.currency" class="form-input" />
                </BaseInput>
                <BaseInput :error="errors.amount">
                    <label for="">Price</label>
                    <input type="number" placeholder="Price" v-model="form.amount" class="form-input" />
                </BaseInput>
                <BaseInput :error="errors.is_active">
                    <label for="groupname">Is Active</label>
                    <DropdownBoolean v-model="form.is_active" :label-true="'Yes'" :label-false="'No'" />
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
import DropdownBoolean from "@/Shared/Components/DropdownBoolean.vue";
import BaseInput from "@/Shared/Components/BaseInput.vue";

const props = defineProps({
    data: Object,
    errors: Object,
    _origin: String
});

let form = useForm({
    type: props.data.type,
    start_date: props.data.start_date,
    end_date: props.data.end_date,
    currency: props.data.currency,
    amount: props.data.amount,
    is_active: props.data.is_active.toString(),
    notes: props.data.notes
});

let submit = () => {
    form.put(`/services/${props.data.id}`);
}

</script>
