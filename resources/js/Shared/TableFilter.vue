<template>
    <form class="space-y-5" @submit.prevent="submit">
        <div class="flex w-full space-x-4 justify-between">
            <div v-for="prop in modelValue" class="flex-auto">
                <BaseInput>
                    <label>{{ prop.label }}</label>
                    <template v-if="prop.type === 'date'">
                        <input @change="valueChanged" type="date" class="form-input" v-model="prop.value"/>
                    </template>
                    <template v-else-if="prop.type === 'dropdown'">
                        <select @change="valueChanged" class="form-input" v-model="prop.value">
                            <option v-for="option in prop.options" :value="option.value">{{ option.label }}</option>
                        </select>
                    </template>
                    <template v-else>
                        <input @change="valueChanged" type="text" class="form-input" v-model="prop.value"/>
                    </template>
                </BaseInput>
            </div>
            <div class="max-h-fit place-self-end">
                <button class="btn btn-outline-primary" type="submit">Filter</button>
            </div>
            <div class="max-h-fit place-self-end">
                <button class="btn btn-outline-primary" @click="doClear">Clear</button>
            </div>
        </div>
    </form>
</template>
<script setup>
import {useForm, usePage} from "@inertiajs/vue3";
import BaseInput from "@/Shared/Components/BaseInput.vue";

let form = useForm({});
let form2 = useForm({
    dateFrom: null,
    dateTo: null,
    orderStatus: 99,
    processStatus: 99,
    search: ''
})
const props = defineProps({
    modelValue: Object
})
const emit = defineEmits(['doFilter', 'doClear'])

const valueChanged = () => {
    form = useForm({});
    props.modelValue.forEach(prop => {
        form[prop.name] = prop.value;
    });
}

const doFilter = () => {
    // console.log(form, form2);
    // emit('doFilter', form);
    form.get(`/sales-orders`);
}

const doClear = () => {
    emit('doClear');
}

let submit = () => {
    console.log('submit');

    // form = useForm({});
    // props.modelValue.forEach(prop => {
    //     form[prop.name] = prop.value;
    // });
    form2.get('/sales-orders');
}

//
// const route = new URLSearchParams(window.location);
// if (route.get('search')) {
//     const query = new URLSearchParams(window.location.search);
//     form.dateFrom = query.get('dateFrom');
//     form.dateTo = query.get('dateTo');
//     form.orderStatus = query.get('orderStatus') === '' ? 99 : query.get('orderStatus');
//     form.processStatus = query.get('processStatus') === '' ? 99 : query.get('processStatus');
//     form.search = query.get('search');
// }
//
</script>
