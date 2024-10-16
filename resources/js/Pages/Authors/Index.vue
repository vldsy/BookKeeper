<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { useForm, Head } from '@inertiajs/vue3';
import Author from '@/Components/Author.vue';

const props = defineProps(['authors']);

import { ref, computed, onMounted } from 'vue'


import DataTable from '@/Components/DataTable.vue'

const columns = computed(() => {
    return [
        {
            key: 'name',
            label: 'Name'
        },
        {
            key: 'age',
            label: 'Age'
        },
    ]

})

const rows = computed(() => {
    return props.authors.map(({ name, age }) => ({ name, age }));

    // return [
    //     { id: 1, name: '2022/03/22', description: '2022/04/30', status: 'IRR 58,500,000', createdDate: 'getg', lastModifiedDate: 'egrttg' },
    //     { id: 2, date: '2022/03/22', due_date: '2022/04/30', full_payment_fee: 'IRR 58,550,000', checked: false },
    //     { id: 3, date: '2022/03/22', due_date: '2022/04/30', full_payment_fee: 'IRR 58,560,000', checked: false },
    //     { id: 4, date: '2022/03/22', due_date: '2022/04/30', full_payment_fee: 'IRR 58,500,000', checked: true },
    //     { id: 5, date: '2022/03/22', due_date: '2022/04/30', full_payment_fee: 'IRR 58,500,000', checked: true },
    // ]
})

</script>

<template>

    <Head title="Authors" />

    <AuthenticatedLayout>

        <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
            <div class="mt-6 bg-white shadow-sm rounded-lg divide-y">
                <Author v-for="author in authors" :key="author.id" :author="author" />
            </div>
        </div>

        <div class="overflow-x-auto">
            <DataTable :rows="rows" :columns="columns" @edit="openEditModal" @delete="deleteTodo" />
        </div>

    </AuthenticatedLayout>
</template>