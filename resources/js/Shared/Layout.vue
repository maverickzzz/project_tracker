<template>
    <div class="main-section antialiased relative font-nunito text-sm font-normal">
        <!--  BEGIN MAIN CONTAINER  -->
        <div class="relative">
            <div class="main-container text-black dark:text-white-dark min-h-screen">
                <!--  BEGIN SIDEBAR  -->
                <Sidebar :title="title" :sidebar="sidebar"/>
                <!--  END SIDEBAR  -->

                <!--  BEGIN CONTENT AREA  -->
                <div class="main-content">
                    <!--  BEGIN TOP NAVBAR  -->
                    <!-- <Header /> -->
                    <!--  END TOP NAVBAR  -->
                    <div class="p-6 animation">
                        <Breadcrumbs/>
                        <div class="pt-5">
                            <div class="grid xl:grid-cols-3 gap-6 mb-6">
                                <div class="panel h-full xl:col-span-3">
                                    <!-- dropdown -->
                                    <div class="flex items-center justify-between mb-5">
                                        <slot name="title"></slot>
                                    </div>
                                    <slot name="content"></slot>
                                </div>
                            </div>
                        </div>
                        <!-- BEGIN FOOTER -->
                        <!-- <Footer /> -->
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
import {ref} from "vue";
import meta from "@/BaseData/meta.js";

const title = ref(meta.title);
const sidebar = ref(meta.sidebar);

if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
    document.querySelector('body')?.classList.add('dark');
} else {
    document.querySelector('body')?.classList.remove('dark');
}

</script>
