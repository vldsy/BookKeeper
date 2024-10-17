<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { useForm, usePage, Head } from '@inertiajs/vue3';
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

// this is the way to use auth.user in vue script
const {...userInfo} = computed(() => usePage().props.auth.user).value;

const hasUserId = (users) => {
    if (users.length <= 0) return false;
    
    for (var i = 0; i < users.length; i++) {
        if (users[i].pivot && users[i].pivot.follow === 1 && users[i].pivot.user_id === userInfo.id) {
            return true;
        }
    }
    return false;
}

const rows = computed(() => {
    return props.authors.map(({ id, name, age, users }) => ({ id, name, age, followed: hasUserId(users) }));
})

</script>

<template>

    <Head title="Authors" />

    <AuthenticatedLayout>

        <pre>{{ JSON.stringify($page.props.auth.user, null, 2) }}</pre>

        <div class="overflow-x-auto">
            <DataTableAuthors 
            :rows="rows"
            :columns="columns"
            />
        </div>

    </AuthenticatedLayout>
</template>