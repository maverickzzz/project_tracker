<template>
    <div class="main-section antialiased relative font-inter text-sm font-normal"
         :class="[store.sidebar ? 'toggle-sidebar' : '']"
    >
        <!--  BEGIN MAIN CONTAINER  -->
        <div class="relative">
            <!-- sidebar menu overlay -->
            <div class="fixed inset-0 bg-[black]/60 z-50 lg:hidden" :class="{ hidden: store.sidebar }" @click="store.toggleSidebar()"></div>

            <div class="main-container text-black min-h-screen">
                <!--  BEGIN SIDEBAR  -->
                <Sidebar :style="{'margin-left': (store.sidebar ? '-260px' : '0')}" :title="title" :sidebar="sidebar"/>
                <!--  END SIDEBAR  -->

                <!--  BEGIN CONTENT AREA  -->
                <div class="main-content" :style="{'margin-left': (!store.sidebar ? '260px' : '0')}">
                    <!--  BEGIN TOP NAVBAR  -->
                    <Header :title="title" />
                    <!--  END TOP NAVBAR  -->
                    <div class="p-6 animation">
                        <Breadcrumbs/>
                        <div class="pt-5">
                            <div class="grid xl:grid-cols-3 gap-6 mb-6">
                                <div class="panel h-full xl:col-span-3 prose max-w-full">
                                    <!-- dropdown -->
                                    <div class="flex items-center justify-between mb-5">
                                        <slot name="title"></slot>
                                    </div>
                                    <slot name="content" ></slot>
                                </div>
                            </div>
                        </div>
                        <!-- BEGIN FOOTER -->
                        <Footer />
                        <!-- END FOOTER -->
                    </div>
                </div>
                <!--  END CONTENT AREA  -->
            </div>
        </div>
    </div>
</template>

<script setup>
import Sidebar from "@/Shared/Sidebar.vue";
import Breadcrumbs from "@/Shared/Breadcrumbs.vue";
import Header from "@/Shared/Header.vue";
import Footer from "@/Shared/Footer.vue";
import {ref} from "vue";
import meta from "@/BaseData/meta.js";

import { useAppStore } from '@/Stores/index';
const store = useAppStore();

const title = ref(meta.title);
const sidebar = ref(meta.sidebar);

// if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
//     document.querySelector('body')?.classList.add('dark');
// } else {
document.querySelector('body')?.classList.remove('dark');
// }

</script>
