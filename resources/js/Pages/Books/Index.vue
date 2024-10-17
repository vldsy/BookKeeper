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
            key: 'author',
            label: 'Author'
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
    return props.books.map(({ id, title, genre, users, author }) => ({ id, title, author: author.name, genre, borrowed: getIsBorrowed(users), favorite: getIsFavorite(users) }));
})


</script>

<template>

    <Head title="Books" />

    <AuthenticatedLayout>
        <div class="mx-auto w-full px-4 md:px-10">
            <div class="mt-4 flex flex-wrap">
                <div class="mb-12 w-full px-4 xl:mb-0 xl:w-8/12">
                    <div class="relative mb-6 flex w-full min-w-0 flex-col break-words rounded bg-white shadow-lg">
                        <div class="mb-0 rounded-t border-0 px-4 py-3">
                            <div class="flex flex-wrap items-center">
                                <div class="relative w-full max-w-full flex-1 flex-grow px-4">
                                    <h3 class="text-blueGray-700 text-base font-semibold">Books</h3>
                                </div>
                            </div>
                        </div>
                        <div class="block w-full overflow-x-auto">
                            <div class="overflow-x-auto">
                                <DataTableBooks :rows="rows" :columns="columns" />
                            </div>

                        </div>
                    </div>
                </div>
                <div class="w-full px-4 xl:w-4/12">
                    <div class="relative mb-6 flex w-full min-w-0 flex-col break-words rounded bg-white shadow-lg">
                        <div class="mb-0 rounded-t border-0 px-4 py-3">
                            <div class="flex flex-wrap items-center">
                                <div class="relative w-full max-w-full flex-1 flex-grow px-4">
                                    <h3 class="text-blueGray-700 text-base font-semibold">Borrowed books</h3>
                                </div>
                            </div>
                        </div>
                        <div class="block w-full overflow-x-auto"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- display json for debug purposes -->
        <!-- replace 2 with '\t' to do tab indentation  -->
        <!-- <pre>{{ JSON.stringify(props.books, null, 2) }}</pre> -->



    </AuthenticatedLayout>


</template>