<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { useForm, Head } from '@inertiajs/vue3';

const props = defineProps(['books']);

import { ref, computed, onMounted } from 'vue'

import DataTableBooks from '@/Components/DataTableBooks.vue'

const columns = computed(() => {
    return [
        {
            key: 'title',
            label: 'Title'
        },
        {
            key: 'genre',
            label: 'Genre'
        },
    ]

})

const rows = computed(() => {
    return props.books.map(({ id, title, genre, users }) => ({ id, title, genre, borrowed: false, favorite: false }));
})


</script>

<template>
    <Head title="Books" />

    <AuthenticatedLayout>

        <div class="overflow-x-auto">
            <DataTableBooks 
            :rows="rows"
            :columns="columns"
            />
        </div>

    </AuthenticatedLayout>

    <!-- display json for debug purposes -->
    <!-- replace 2 with '\t' to do tab indentation  -->
    <!-- <pre>{{ JSON.stringify(props.books, null, 2) }}</pre> -->
</template>