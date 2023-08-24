<template>
    <Layout>
        <template #title>
            <h1 class="font-semibold text-lg dark:text-white-light">Project Owners - Edit - {{ form.name }}</h1>
        </template>
        <template #content>
            <form class="space-y-5" @submit.prevent="submit">
                <BaseInput :error="errors.name">
                    <label for="groupname">Project Owner Name</label>
                    <input id="groupname" type="text" placeholder="Project Owner Name" class="form-input" v-model="form.name" />
                </BaseInput>
                <BaseInput :error="errors.country">
                    <label for="groupname">Country</label>
                    <DropdownCountry v-model="form.country" />
                </BaseInput>
                <BaseInput :error="errors.contact">
                    <label for="groupname">Contact Number</label>
                    <input id="groupname" type="text" placeholder="Contact Number" v-model="form.contact_number" class="form-input" />
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
import DropdownCountry from "@/Shared/Components/DropdownCountry.vue";
import BaseInput from "@/Shared/Components/BaseInput.vue";
import { useForm } from '@inertiajs/vue3';

const props = defineProps({
    data: Object,
    errors: Object,
    _origin: String,
})

let form = useForm({
    name: props.data.name,
    country: props.data.country,
    contact_number: props.data.contact_number,
});

let submit = () => {
    form.put(`/project-owners/${props.data.id}`);
}

</script>
