<template>
    <footer>
        <p v-if="$page.props._is_administrator || $page.props._impersonate">
        {{ $page.props }}
        </p>
    </footer>
</template>
<script setup>
import {usePage} from "@inertiajs/vue3";
</script>
