<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { useForm, Head } from '@inertiajs/vue3';
import Author from '@/Components/Author.vue';

const props = defineProps(['authors']);

import { ref, computed, onMounted } from 'vue'


import DataTableAuthors from '@/Components/DataTableAuthors.vue'

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
    return props.authors.map(({ id, name, age }) => ({ id, name, age }));

    // return [
    //     { id: 1, name: '2022/03/22', description: '2022/04/30', status: 'IRR 58,500,000', createdDate: 'getg', lastModifiedDate: 'egrttg' },
    //     { id: 2, date: '2022/03/22', due_date: '2022/04/30', full_payment_fee: 'IRR 58,550,000', checked: false },
    //     { id: 3, date: '2022/03/22', due_date: '2022/04/30', full_payment_fee: 'IRR 58,560,000', checked: false },
    //     { id: 4, date: '2022/03/22', due_date: '2022/04/30', full_payment_fee: 'IRR 58,500,000', checked: true },
    //     { id: 5, date: '2022/03/22', due_date: '2022/04/30', full_payment_fee: 'IRR 58,500,000', checked: true },
    // ]
})

const followAuthor = (id) => {
    console.log(id);
}

const unfollowAuthor = (id) => {
    console.log(id);
}

</script>

<template>

    <Head title="Authors" />

    <AuthenticatedLayout>

        <div class="overflow-x-auto">
            <DataTableAuthors 
            :rows="rows"
            :columns="columns"
            @follow="followAuthor"
            @unfollow="unfollowAuthor" 
            />
        </div>

    </AuthenticatedLayout>
</template>