<template>
    <Layout>
        <template #title>
            <h1>Companies - Create</h1>
        </template>
        <template #content>
            <form class="space-y-5" @submit.prevent="submit">
                <BaseInput :error="errors.code">
                    <label for="">Code</label>
                    <input id="groupname" type="text" placeholder="Code" class="form-input" v-model="form.code" />
                </BaseInput>
                <BaseInput :error="errors.name">
                    <label for="groupname">Name</label>
                    <input id="groupname" type="text" placeholder="Name" class="form-input" v-model="form.name" />
                </BaseInput>
                <div class="flex space-x-3">
                    <button class="btn btn-primary" type="submit"><Icon :name="'save'" /> Save</button>
                    <Link :href="_origin" class="btn btn-outline-primary"><Icon :name="'times'" /> Cancel</Link>
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
import Icon from "@/Shared/Components/Icon.vue";

const props = defineProps({
    errors: Object,
    _origin: String
})

let form = useForm({
    name: '',
    code: '',
});

let submit = () => {
    form.post('/companies');
}

</script>
