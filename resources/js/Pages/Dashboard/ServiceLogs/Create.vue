<template>
    <Layout>
        <template #title>
            <h1 class="font-semibold text-lg dark:text-white-light">Service Log - Create</h1>
        </template>
        <template #content>
            <form class="space-y-5" @submit.prevent="submit">
                <BaseInput :error="errors.date">
                    <label for="groupname">Log Date</label>
                    <input id="groupname" type="date" placeholder="Log Date" v-model="form.date" class="form-input" />
                </BaseInput>
                <BaseInput :error="errors.project_id">
                    <label for="">Project</label>
                    <select class="form-select" v-model="form.project_id" :disabled="selected_project > 0">
                        <option v-for="project in projects" :value="project.id">{{ project.name }}</option>
                    </select>
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
    errors: Object,
    _origin: String,
    selected_project: Number,
})

let form = useForm({
    date: new Date().toISOString().slice(0, 10),
    project_id: props.selected_project > 0 ? +props.selected_project : null,
    notes: null,
});

let submit = () => {
    form.post('/service-logs');
}

</script>
