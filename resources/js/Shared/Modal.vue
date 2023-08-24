<template>
    <!-- vertically centered -->
    <div class="fixed inset-0 bg-[black]/60 z-[999] hidden overflow-y-auto" :class="open && '!block'">
        <div class="flex items-center justify-center min-h-screen px-4" @click.self="open = false">
            <div x-show="open" x-transition x-transition.duration.300 class="panel border-0 p-0 rounded-lg overflow-hidden w-full max-w-lg my-8">
                <div class="flex bg-[#fbfbfb] dark:bg-[#121c2c] items-center justify-between px-5 py-3">
                    <h5 class="font-bold text-lg">
                        <slot name="title"></slot>
                    </h5>
                </div>
                <div class="p-5">
                    <slot name="content"></slot>

                    <div class="flex justify-end items-center mt-8">
                        <button type="button" class="btn btn-outline-danger" @click="toggle">Discard</button>
                        <button type="button" class="btn btn-primary ml-4" @click="toggle">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
const props = defineProps({
    open: Boolean
})
let open = ref(props.open);
const toggle = function () {
    open.value = !open.value;
}
</script>
