<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { useForm, Head } from '@inertiajs/vue3';
import DataTableAuthors from '@/Components/DataTableAuthors.vue'
import { ref, computed, onMounted } from 'vue'

const props = defineProps(['authors']);

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
})

</script>

<template>

    <Head title="Authors" />

    <AuthenticatedLayout>

        <div class="overflow-x-auto">
            <DataTableAuthors 
            :rows="rows"
            :columns="columns"
            />
        </div>

    </AuthenticatedLayout>
</template>