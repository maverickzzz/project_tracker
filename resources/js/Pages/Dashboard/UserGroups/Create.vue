<template>
    <Layout>
        <template #title>
            <h1>User Groups - Create</h1>
        </template>
        <template #content>
            <form class="space-y-5" @submit.prevent="submit">
                <BaseInput :error="errors.name">
                    <label for="groupname">Name</label>
                    <input id="groupname" type="text" placeholder="Name" class="form-input" v-model="form.name" />
                </BaseInput>
                <BaseInput>
                    <label for="dashboard">dashboard</label>
                    <input id="dashboard" type="checkbox" placeholder="dashboard" class="form-input" v-model="form.access.dashboard" />
                </BaseInput>
                <BaseInput>
                    <label for="project_owners">project_owners</label>
                    <input id="project_owners" type="checkbox" placeholder="project_owners" class="form-input" v-model="form.access.project_owners" />
                </BaseInput>
                <BaseInput>
                    <label for="projects">projects</label>
                    <input id="projects" type="checkbox" placeholder="projects" class="form-input" v-model="form.access.projects" />
                </BaseInput>
                <BaseInput>
                    <label for="administration_user_groups">administration_user_groups</label>
                    <input id="administration_user_groups" type="checkbox" placeholder="administration_user_groups" class="form-input" v-model="form.access.administration_user_groups" />
                </BaseInput>
                <BaseInput>
                    <label for="administration_users">administration_users</label>
                    <input id="administration_users" type="checkbox" placeholder="administration_users" class="form-input" v-model="form.access.administration_users" />
                </BaseInput>
                <BaseInput>
                    <label for="administration_companies">administration_companies</label>
                    <input id="administration_companies" type="checkbox" placeholder="administration_companies" class="form-input" v-model="form.access.administration_companies" />
                </BaseInput>
                <BaseInput>
                    <label for="administration_settings">administration_settings</label>
                    <input id="administration_settings" type="checkbox" placeholder="administration_settings" class="form-input" v-model="form.access.administration_settings" />
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
    access: {
        dashboard: false,
        project_owners: false,
        projects: false,
        administration_user_groups: false,
        administration_users: false,
        administration_companies: false,
        administration_settings: false,
    }
});

let submit = () => {
    form.post('/usergroups');
}

</script>
