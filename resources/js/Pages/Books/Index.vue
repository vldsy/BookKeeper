<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { useForm, Head } from '@inertiajs/vue3';

const props = defineProps(['books']);

import { ref, computed, onMounted } from 'vue'

</script>

<template>
    <!-- display json for debug purposes -->
    <!-- replace 2 with '\t' to do tab indentation  -->
    <pre>{{ JSON.stringify(props.books, null, 2) }}</pre>
</template>