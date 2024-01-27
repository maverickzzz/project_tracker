<template>
    <div class="mb-5">
        <div class="overflow-x-auto">
            <table class="table-hover not-prose table-fixed">
                <thead>
                <tr>
                    <th class="capitalize" v-for="header in props.headers"
                        :class="[{ 'w-32': header.column === 'action'}, header.class]">
                        {{ header.label }}
                    </th>
                </tr>
                </thead>
                <tbody>
                <template v-if="props.data.data.length > 0">
                    <tr v-for="data in props.data.data" :key="data.id">
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
                                    <template v-else-if="action.url.indexOf(':') >= 0">
                                        <template v-if="action.target">
                                            <a :href="replaceKeyWithValue(action.url, data)" :target="action.target">
                                                <i :class="'mr-2 icon pi pi-' + action.icon"></i>
                                            </a>
                                        </template>
                                        <template v-else>
                                            <Link :href="replaceKeyWithValue(action.url, data)">
                                                <i :class="'mr-2 icon pi pi-' + action.icon"></i>
                                            </Link>
                                        </template>
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
                                    {{
                                        (header.hasOwnProperty('property') ? (data[header.column] ?
                                                (data[header.column][header.property] ? data[header.column][header.property] : '') : '')
                                            : (data[header.column] ? data[header.column] : '')).toLocaleString()
                                    }}
                                </template>
                            </template>
                        </td>
                    </tr>
                </template>
                <template v-else>
                    <tr>
                        <td :colspan="props.headers.length" class="text-center italic">
                            No data
                        </td>
                    </tr>
                </template>
                </tbody>
            </table>
        </div>
        <div v-if="paging" class="flex items-center justify-between bg-whitesm:px-6">
            <div class="flex flex-1 justify-between sm:hidden">
                <a href="#"
                   class="relative inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Previous</a>
                <a href="#"
                   class="relative ml-3 inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Next</a>
            </div>
            <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">
                <div>
                    <p class="text-sm text-gray-700">
                        Showing
                        <span class="font-medium">{{ data.from }}</span>
                        to
                        <span class="font-medium">{{ data.to }}</span>
                        of
                        <span class="font-medium">{{ data.total }}</span>
                        results
                    </p>
                </div>
                <div>
                    <nav class="isolate inline-flex -space-x-px rounded-md shadow-sm" aria-label="Pagination">
                        <Component
                            :is="link.url ? 'Link' : 'span'"
                            v-for="(link, index) in data.links"
                            :href="link.url"
                            v-html="link.label"
                            preserve-scroll
                            class="relative inline-flex items-center px-4 py-2 text-sm"
                            :class="
                                    {'z-10 bg-indigo-600 text-white focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 font-semibold': link.active},
                                    {'text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0': !link.active},
                                    {'text-gray-300': !link.url},
                                    {'rounded-l-md': index === 0},
                                    {'rounded-r-md': index === data.links.length - 1}
                                "
                        />
                        <!--                        <a href="#" class="relative inline-flex items-center rounded-l-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0">-->
                        <!--                            <span class="sr-only">Previous</span>-->
                        <!--                            <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">-->
                        <!--                                <path fill-rule="evenodd" d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z" clip-rule="evenodd" />-->
                        <!--                            </svg>-->
                        <!--                        </a>-->
                        <!--                        &lt;!&ndash; Current: "z-10 bg-indigo-600 text-white focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600", Default: "text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:outline-offset-0" &ndash;&gt;-->
                        <!--                        <a href="#" aria-current="page" class="relative z-10 inline-flex items-center bg-indigo-600 px-4 py-2 text-sm font-semibold text-white focus:z-20 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">1</a>-->
                        <!--                        <a href="#" class="relative inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0">2</a>-->
                        <!--                        <a href="#" class="relative hidden items-center px-4 py-2 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0 md:inline-flex">3</a>-->
                        <!--                        <span class="relative inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-700 ring-1 ring-inset ring-gray-300 focus:outline-offset-0">...</span>-->
                        <!--                        <a href="#" class="relative hidden items-center px-4 py-2 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0 md:inline-flex">8</a>-->
                        <!--                        <a href="#" class="relative inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0">9</a>-->
                        <!--                        <a href="#" class="relative inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0">10</a>-->
                        <!--                        <a href="#" class="relative inline-flex items-center rounded-r-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0">-->
                        <!--                            <span class="sr-only">Next</span>-->
                        <!--                            <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">-->
                        <!--                                <path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z" clip-rule="evenodd" />-->
                        <!--                            </svg>-->
                        <!--                        </a>-->
                    </nav>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>

const props = defineProps({
    modelValue: Object,
    headers: Array,
    actions: Array,
    data: Object,
    paging: {type: Boolean, default: true}
});
const emits = defineEmits(['update:modelValue']);

console.log(props.data.data);

function replaceKeyWithValue(url, data) {
    let updated_url = url + JSON.stringify(data);
    const part_start = url.substring(url.indexOf(':'));
    const key_to_replace = part_start.substring(0, part_start.indexOf('/'));
    const key = part_start.substring(1, part_start.indexOf('/'));
    return url.replace(key_to_replace, data[key]);
}

</script>
