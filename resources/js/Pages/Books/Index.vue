<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { useForm, usePage, Head } from '@inertiajs/vue3';
import DataTableBooks from '@/Components/DataTableBooks.vue'
import { ref, computed, onMounted } from 'vue'

const props = defineProps(['books']);

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

const { ...userInfo } = computed(() => usePage().props.auth.user).value;

const getIsBorrowed = (users) => {
    if (users.length <= 0) return false;

    for (var i = 0; i < users.length; i++) {
        if (users[i].pivot && users[i].pivot.borrowed === 1 && users[i].pivot.user_id === userInfo.id) {
            return true;
        }
    }
    return false;
}

const getIsFavorite = (users) => {
    if (users.length <= 0) return false;

    for (var i = 0; i < users.length; i++) {
        if (users[i].pivot && users[i].pivot.favorite === 1 && users[i].pivot.user_id === userInfo.id) {
            return true;
        }
    }
    return false;
}

const rows = computed(() => {
    return props.books.map(({ id, title, genre, users }) => ({ id, title, genre, borrowed: getIsBorrowed(users), favorite: getIsFavorite(users) }));
})


</script>

<template>

    <Head title="Books" />

    <AuthenticatedLayout>

        <div class="overflow-x-auto">
            <DataTableBooks :rows="rows" :columns="columns" />
        </div>

    </AuthenticatedLayout>

    <!-- display json for debug purposes -->
    <!-- replace 2 with '\t' to do tab indentation  -->
    <!-- <pre>{{ JSON.stringify(props.books, null, 2) }}</pre> -->
</template>