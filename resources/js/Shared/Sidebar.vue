<template>
    <div>
        <nav
            class="sidebar fixed min-h-screen h-full top-0 bottom-0 w-[260px] shadow-[5px_0_25px_0_rgba(94,92,154,0.1)] z-50 transition-all duration-300">
            <div class="flex flex-col bg-white h-full">
                <div class="flex justify-between items-center px-4 py-3">
                    <Link href="/" class="main-logo flex items-center shrink-0">
                        <span class="text-2xl ml-1.5 font-semibold align-middle lg:inline">{{
                                title
                            }}</span>
                    </Link>
                    <a href="javascript:;"
                       class="collapse-icon w-8 h-8 rounded-full flex items-center hover:bg-gray-500/10 dark:hover:bg-dark-light/10 dark:text-white-light transition duration-300 rtl:rotate-180 hover:text-primary"
                       @click="store.toggleSidebar()">
                        <svg class="w-5 h-5 m-auto" width="20" height="20" viewBox="0 0 24 24" fill="none"
                             xmlns="http://www.w3.org/2000/svg">
                            <path d="M13 19L7 12L13 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                  stroke-linejoin="round"/>
                            <path opacity="0.5" d="M16.9998 19L10.9998 12L16.9998 5" stroke="currentColor"
                                  stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </a>
                </div>
                <perfect-scrollbar
                    :options="{
                        swipeEasing: true,
                        wheelPropagation: false,
                    }"
                    class="h-[calc(100vh-80px)] relative"
                >
                    <ul class="relative space-y-0.5 p-4 py-0">
                        <template v-for="item in sidebar">

                            <template v-if="item.icon === ''">
                                <h2 class="py-3 px-7 flex items-center uppercase font-extrabold bg-white-light/30 -mx-4 mb-1"
                                    :class="{'hidden': checkAccess(item.key)}">
                                    <svg class="w-4 h-5 flex-none hidden" viewBox="0 0 24 24" stroke="currentColor"
                                         stroke-width="1.5" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <line x1="5" y1="12" x2="19" y2="12"></line>
                                    </svg>
                                    <span>{{ item.label }}</span>
                                </h2>
                            </template>

                            <template v-else>
                                <template v-if="useraccess">
                                    <template v-if="useraccess[item.key]">
                                        <li class="nav-item">
                                            <Link :href="item.url" class="group"
                                                  :class="{ 'font-semibold router-link-active active': $page.component.indexOf(item.component) >= 0 }">
                                                <div class="flex items-center">
                                                    <i :class="'icon pi pi-' + item.icon"></i>

                                                    <span
                                                        class="pl-3 capitalize text-black">{{
                                                            item.label
                                                        }}</span>
                                                </div>
                                            </Link>
                                        </li>
                                    </template>
                                </template>
                            </template>
                        </template>
                    </ul>
                </perfect-scrollbar>
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

import {ref} from "vue";
import {usePage} from "@inertiajs/vue3";
import { useAppStore } from '@/stores/index';
const store = useAppStore();

const props = defineProps({
    title: String,
    sidebar: Array,
})

// const useraccess = ref({'dashboard': 1, 'sales_order_list': 1, 'sales_order_collecting': 1, 'sales_order_checking': 1, 'sales_order_packing': 1, 'administration_user_groups': 1, 'administration_users': 1, 'administration_companies': 1, 'administration_settings': 1, })

const useraccess = ref(usePage().props._useraccess ? JSON.parse(usePage().props._useraccess) : null);

function checkAccess(label_key) {
    for (let access in useraccess.value) {
        // if (props.sidebar.filter(item => item.key === label_key && item.icon === '').length === 1) {
        //
        // }
        // console.log(props.sidebar.filter(item => item.key === label_key)[0], access.substring(0, label_key.length), label_key, useraccess.value[access])
        if (access.substring(0, label_key.length) === label_key && useraccess.value[access]) {
            return false
        }
    }
    return true;
}

</script>
