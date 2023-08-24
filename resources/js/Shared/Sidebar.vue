<template>
    <div>
        <nav class="sidebar fixed min-h-screen h-full top-0 bottom-0 w-[260px] shadow-[5px_0_25px_0_rgba(94,92,154,0.1)] z-50 transition-all duration-300">
            <div class="flex flex-col bg-white dark:bg-[#0e1726] h-full">
                <div class="flex justify-between items-center px-4 py-3">
                    <Link href="/" class="main-logo flex items-center shrink-0">
                    <span class="text-2xl ml-1.5 font-semibold align-middle lg:inline dark:text-white-light">{{ title }}</span>
                    </Link>
                    <!-- <a href="javascript:;" class="collapse-icon w-8 h-8 rounded-full flex items-center hover:bg-gray-500/10 dark:hover:bg-dark-light/10 dark:text-white-light transition duration-300 rtl:rotate-180 hover:text-primary" @click="store.toggleSidebar()">
                        <svg class="w-5 h-5 m-auto" width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M13 19L7 12L13 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            <path opacity="0.5" d="M16.9998 19L10.9998 12L16.9998 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </a> -->
                </div>
                <ul class="relative space-y-0.5 p-4 py-0">
                    <template v-for="item in sidebar">
                        <h2 v-if="item.icon === ''" class="py-3 px-7 flex items-center uppercase font-extrabold bg-white-light/30 dark:bg-dark dark:bg-opacity-[0.08] -mx-4 mb-1">
                            <svg class="w-4 h-5 flex-none hidden" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                            </svg>
                            <span>{{ item.label }}</span>
                        </h2>

                        <li v-else class="nav-item">
                            <Link :href="item.url" class="group" :class="{ 'font-semibold router-link-active active': $page.component === item.component }">
                            <div class="flex items-center">
                                <i :class="'icon pi pi-' + item.icon"></i>

                                <span class="pl-3 capitalize text-black dark:text-[#506690] dark:group-hover:text-white-dark">{{
                                    item.label
                                }}</span>
                            </div>
                            </Link>
                        </li>
                    </template>
                </ul>
                <div class="mt-auto mb-4 px-4">
                    <Link href="/logout">
                    <button class="btn btn-danger mx-auto w-full">
                        <i class="icon pi pi-power-off"></i>
                        <span class="pl-3 capitalize text-white">Log Out</span></button>
                    </Link>
                </div>
            </div>
        </nav>
    </div>
</template>

<script setup>

const props = defineProps({
    title: String,
    sidebar: Array,
})

</script>
