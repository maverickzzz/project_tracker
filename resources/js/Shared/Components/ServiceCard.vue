<template>
    <div v-if="service" class="w-full bg-white shadow-[4px_6px_10px_-3px_#bfc9d4] rounded border border-[#e0e6ed] dark:border-[#1b2e4b] dark:bg-[#191e3a] dark:shadow-none">
        <div class="py-7 px-6">
            <h5 class="text-[#3b3f5c] text-xl font-semibold mb-4 dark:text-white-light">{{ service.type }}</h5>
            <table class="table-hover">
                <tbody>
                    <tr>
                        <td>Start</td>
                        <td>{{ service.start_date }}</td>
                    </tr>
                    <tr>
                        <td>End</td>
                        <td>{{ service.end_date }}</td>
                    </tr>
                    <tr>
                        <td>Price</td>
                        <td>{{ service.currency + ' ' + (service.amount).toLocaleString() }}</td>
                    </tr>
                    <tr>
                        <td>Is Active</td>
                        <td>
                            <span v-if="service.is_active === 1" class="badge bg-success">Yes</span>
                            <span v-if="service.is_active === 0" class="badge bg-danger">No</span>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">Notes<br />{{ service.notes }}</td>
                    </tr>
                </tbody>
            </table>
            <div class="flex space-x-2">
                <Link :href="`/projects/${service.project_id}/services/${service.id}/edit`" as="button" class="btn btn-primary mt-6">Update</Link>
                <Link :href="`/projects/${service.project_id}/services/${service.id}/logs`" as="button" class="btn btn-outline-primary mt-6">Logs</Link>
            </div>
        </div>
    </div>
</template>

<script setup>


const props = defineProps({
    service: Object
})

</script>
