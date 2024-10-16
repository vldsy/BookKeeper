<script setup>
import {computed, onMounted, ref} from "vue";
const props = defineProps({
    items: {
        type: Object,
        default: {
            headers: {},
            data: []
        },
        required: true
    }
})
// Actually is items' columns count
//const gridSpan = computed(() => props.items.data.length ? _.keys(props.items.data[0]).length : 0)
const gridSpan = computed(() => props.items.data.length ? props.items.data[0].length : 0)
// Inserts after each loop cycle, acts like a new line
const gridSpanClass = computed(() => `col-span-${gridSpan.value}`)
// In case of asynchronous
const ready = ref(false)
// In case tailwind didn't include classes, so we add em manually
const gridClasses = ref([
    'col-span-1', 'col-span-2', 'col-span-3', 'col-span-4', 'col-span-5', 'col-span-6',
    'col-span-7', 'col-span-8', 'col-span-9', 'col-span-10', 'col-span-11', 'col-span-12'
])
// Can be deleted; for testing & proofing purposes
onMounted(() => {
    ready.value = true
})
</script>

<template>
    <perfect-scrollbar class="overflow-x-auto pb-2 text-lg" v-if="ready">
        <div class="grid">
            <div v-for="(heading, index, i) in items.headers"
                 :key="index + 100"
                 v-text="heading"
                 class="whitespace-nowrap bg-muted-2 py-3.5 px-5"
                 :class="{ 'rounded-l-xl': i === 0, 'rounded-r-xl': i === (gridSpan - 1) }"
            ></div>

            <div class="mb-2" :class="gridSpanClass"></div>

            <template v-for="(item, index) in items.data" :key="item.id">
                <div v-for="(data, key, i) in item"
                     :key="item.id"
                     class="whitespace-nowrap bg-muted-1 py-3 px-5"
                     :class="{
                         'rounded-tl-xl': (index === 0 && i === 0),
                         'rounded-tr-xl': (i === (gridSpan - 1) && index === 0),
                         'rounded-bl-xl': (index === (gridSpan - 1) && i === 0),
                         'rounded-br-xl': (index === (gridSpan - 1) && i === (gridSpan - 1))
                     }"
                >
                    <slot :name="key" :[key]="data" :row="item">
                        <div v-html="data"></div>
                    </slot>
                </div>
                <div class="bg-muted-1" v-if="index !== (gridSpan - 1)" :class="gridSpanClass">
                    <div class="border-t-2 border-muted-3 mx-12 my-1"></div>
                </div>
            </template>
        </div>
    </perfect-scrollbar>
</template>

<style scoped></style>