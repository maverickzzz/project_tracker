<template>
    <Head>
        <title>{{ title }}</title>
    </Head>
    <header>
        <div class="shadow-sm">
            <!--            <div class="horizontal-logo flex lg:hidden justify-between items-center ltr:mr-2 rtl:ml-2">-->
            <!--                <Link href="/public" class="main-logo flex items-center shrink-0">-->
            <!--                        <span class="text-2xl ml-1.5 font-semibold align-middle lg:inline">{{-->
            <!--                                title-->
            <!--                            }}</span>-->
            <!--                </Link>-->
            <!--            </div>-->
            <div class="relative bg-white flex w-full justify-between items-center px-5 py-2.5 h-14">
                <div class="flex items-center space-x-4">
                    <a
                        href="javascript:;"
                        class="flex-none dark:text-[#d0d2d6] hover:text-primary dark:hover:text-primary flex ltr:ml-2 rtl:mr-2 p-2 rounded-full bg-white-light/40 dark:bg-dark/40 hover:bg-white-light/90 dark:hover:bg-dark/60"
                        :class="{ hidden: !store.sidebar }"
                        @click="store.toggleSidebar()"
                    >
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M20 7L4 7" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                            <path opacity="0.5" d="M20 12L4 12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                            <path d="M20 17L4 17" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                        </svg>
                    </a>
                    <p>Company: <span class="font-bold">{{ $page.props._company }}</span>
<!--                        <Link href="/select-company" class="ml-2"><span class="badge badge-outline-primary">Switch Company</span></Link>-->
                    </p>
                </div>
                <p v-if="$page.props._impersonate">Impersonating as {{ $page.props._user.name }}
                    ({{ $page.props._user.username }}).
                    <Link class="font-bold" href="/users/leave">Leave impersonation
                        <Icon name="arrow-right"/>
                    </Link>
                </p>
                <!--                <p>Hello, <span class="font-bold capitalize">{{ $page.props._user.name }}</span></p>-->
                <p>
                    <DropdownMenu />
                </p>
            </div><!-- horizontal menu -->
        </div>
    </header>
</template>
<script setup>

import {ref} from "vue";
import {usePage} from "@inertiajs/vue3";
import {Head} from '@inertiajs/vue3'
import DropdownMenu from "@/Shared/Components/DropdownMenu.vue";
import { useAppStore } from '@/Stores/index';
const store = useAppStore();
// console.log(is_impersonating.value);

const props = defineProps({
    title: String
})
</script>
