<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { useForm, Head } from '@inertiajs/vue3';
import Author from '@/Components/Author.vue';

defineProps(['authors']);

import UiTable from "@/Components/GridTable.vue";
import { ref } from 'vue';
	
	const table = {
        headers: {
            id: 'ID',
            date: 'Date',
            due_date: 'Due Date',
            full_payment_fee: 'Full Payment Fee (IRR)',
            operation: ''
        },
        data: [
            { id: 1, date: '2022/03/22', due_date: '2022/04/30', full_payment_fee: 'IRR 58,500,000', checked: false },
            { id: 2, date: '2022/03/22', due_date: '2022/04/30', full_payment_fee: 'IRR 58,550,000', checked: false },
            { id: 3, date: '2022/03/22', due_date: '2022/04/30', full_payment_fee: 'IRR 58,560,000', checked: false },
            { id: 4, date: '2022/03/22', due_date: '2022/04/30', full_payment_fee: 'IRR 58,500,000', checked: true },
            { id: 5, date: '2022/03/22', due_date: '2022/04/30', full_payment_fee: 'IRR 58,500,000', checked: true },
        ]
    }
	
	const formRef = ref({
		installments: []
	})

</script>

<template>
    <Head title="Authors" />

    <AuthenticatedLayout>
        
        <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
            <div class="mt-6 bg-white shadow-sm rounded-lg divide-y">
                <Author
                    v-for="author in authors"
                    :key="author.id"
                    :author="author"
                />
            </div>
        </div>

        <UiTable :items="table">
            <!-- { ..., row } is an array element which is in loop (an item of items array) -->
            <!-- Note #checked is same name for it's column name and destructed -->
            <!-- <template #checked="{ checked, row }">
                <span class="fi fi-rr-check leading-none mt-0.5 text-xl text-success-solid" v-if="checked"></span>
                <ui-checkbox v-else v-model="formRef.installments" :value="row.full_payment_fee" />
            </template> -->
	    </UiTable>
    </AuthenticatedLayout>
</template>