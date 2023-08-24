<template>
    <div class="mb-5">
        <table class="table-hover">
            <thead>
                <tr>
                    <th class="capitalize" v-for="header in props.headers" :class="{ 'w-32': header.column === 'action' }">{{ header.label }}</th>
                </tr>
            </thead>
            <tbody>
                <template v-if="props.data.length > 0">
                    <tr v-for="data in props.data" :key="data.id">
                        <td v-for="header in props.headers">
                            <template v-if="header.column === 'action'">
                                <template v-for="action in props.actions">
                                    <template v-if="action.label === 'edit'">
                                        <Link :href="`${action.url}/${data.id}/edit`">
                                        <i :class="'mr-2 icon pi pi-' + action.icon"></i>
                                        </Link>
                                    </template>
                                    <template v-else-if="action.label === 'delete'">
                                        <Link :href="`${action.url}/${data.id}`" method="delete" as="button"
                                            onclick="return confirm('Are you sure?')">
                                        <i :class="'mr-2 icon pi pi-' + action.icon"></i>
                                        </Link>
                                    </template>
                                    <template v-else-if="action.url.indexOf(':id') >= 0">
                                        <Link :href="`${action.url.replace(':id', data.id)}`">
                                        <i :class="'mr-2 icon pi pi-' + action.icon"></i>
                                        </Link>
                                    </template>
                                    <template v-else>
                                        <Link :href="action.url">
                                        <i :class="'mr-2 icon pi pi-' + action.icon"></i>
                                        </Link>
                                    </template>
                                    <!-- <button type="button" @click="$emit('update:modelValue', true)">
                                        <i :class="'mr-2 icon pi pi-' + action.icon"></i>
                                    </button> -->
                                    <!-- <button type="button" v-tippy:[action.tooltip]>
                                        <i :class="'icon pi pi-' + action.icon"></i>
                                    </button> -->
                                    <!-- <tippy :target="action.tooltip" class="capitalize">{{ action.label }}</tippy> -->
                                </template>
                            </template>
                            <template v-else>
                                <template v-if="header.hasOwnProperty('type')">
                                    <template v-if="header.type === 'boolean'">
                                        <!-- <span class="badge bg-primary">Primary</span> -->
                                        <!-- <span class="badge bg-secondary">Secondary</span> -->
                                        <span v-if="data[header.column] === 1" class="badge bg-success">Yes</span>
                                        <span v-if="data[header.column] === 0" class="badge bg-danger">No</span>
                                        <!-- <span class="badge bg-warning">Warning</span> -->
                                        <!-- <span class="badge bg-info">Info</span> -->
                                        <!-- <span class="badge bg-dark">Dark</span> -->
                                    </template>
                                    <template v-else-if="header.type === 'boolean-reverse'">
                                        <!-- <span class="badge bg-primary">Primary</span> -->
                                        <!-- <span class="badge bg-secondary">Secondary</span> -->
                                        <span v-if="data[header.column] === 0" class="badge bg-success">No</span>
                                        <span v-if="data[header.column] === 1" class="badge bg-danger">Yes</span>
                                        <!-- <span class="badge bg-warning">Warning</span> -->
                                        <!-- <span class="badge bg-info">Info</span> -->
                                        <!-- <span class="badge bg-dark">Dark</span> -->
                                    </template>
                                    <template v-else-if="header.type === 'html'">
                                        <div v-html="data[header.column]"></div>
                                    </template>
                                </template>
                                <template v-else>
                                    {{ (header.hasOwnProperty('property') ? (data[header.column] ?
                                        (data[header.column][header.property] ? data[header.column][header.property] : '') : '')
                                        : (data[header.column] ? data[header.column] : '')).toLocaleString() }}
                                </template>
                            </template>
                        </td>
                    </tr>
                </template>
            </tbody>
        </table>
    </div>
</template>

<script setup>
;

const props = defineProps(['modelValue', 'headers', 'actions', 'data']);
const emits = defineEmits(['update:modelValue']);

</script>
