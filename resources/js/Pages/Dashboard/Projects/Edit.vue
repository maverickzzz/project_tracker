<template>
    <Layout>
        <template #title>
            <h1 class="font-semibold text-lg dark:text-white-light">Projects - Edit {{ }}</h1>
        </template>
        <template #content>
            <form class="space-y-5" @submit.prevent="submit">
                <BaseInput :error="errors.name">
                    <label for="groupname">Project Name</label>
                    <input id="groupname" type="text" placeholder="Project Name" class="form-input" v-model="form.name" />
                </BaseInput>
                <BaseInput :error="errors.owner_id">
                    <label for="">Project Owner</label>
                    <select class="form-select" v-model="form.owner_id">
                        <option v-for="owner in owners" :value="owner.id">{{ owner.name }}</option>
                    </select>
                </BaseInput>
                <BaseInput :error="errors.referrer">
                    <label for="">Referrer</label>
                    <input id="groupname" type="text" placeholder="Referrer" v-model="form.referrer" class="form-input" />
                </BaseInput>
                <BaseInput :error="errors.url">
                    <label for="groupname">URL</label>
                    <div class="flex">
                        <div class="bg-[#eee] flex justify-center items-center ltr:rounded-l-md rtl:rounded-r-md px-3 font-semibold border ltr:border-r-0 rtl:border-l-0 border-[#e0e6ed] dark:border-[#17263c] dark:bg-[#1b2e4b]">
                            https://
                        </div>
                        <input id="groupname" type="text" placeholder="URL" v-model="form.url" class="form-input" />
                    </div>
                </BaseInput>
                <BaseInput :error="errors.is_active">
                    <label for="groupname">Is Active</label>
                    <DropdownBoolean v-model="form.is_active" :label-true="'Yes'" :label-false="'No'" />
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
    owners: Array,
    errors: Array,
    _origin: String,
})

let form = useForm({
    name: props.data.name,
    owner_id: props.data.owner_id,
    url: props.data.url,
    is_active: props.data.is_active.toString(),
    referrer: props.data.referrer,
});

let submit = () => {
    form.put(`/projects/${props.data.id}`);
}

</script>
