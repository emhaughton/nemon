<script setup lang="ts">

const props = defineProps<{

    currentPage: number;

    lastPage: number;

}>();

const emit = defineEmits<{

    (event: 'change', page: number): void;

}>();

function previous(): void {

    if (props.currentPage <= 1) {
        return;
    }

    emit(
        'change',
        props.currentPage - 1,
    );
}

function next(): void {

    if (props.currentPage >= props.lastPage) {
        return;
    }

    emit(
        'change',
        props.currentPage + 1,
    );
}

</script>

<template>

<div class="pagination">

    <button
        @click="previous"
        :disabled="currentPage === 1"
    >
        Previous
    </button>

    <span>

        Page {{ currentPage }} of {{ lastPage }}

    </span>

    <button
        @click="next"
        :disabled="currentPage === lastPage"
    >
        Next
    </button>

</div>

</template>

<style scoped>

.pagination{

    display:flex;

    justify-content:center;

    align-items:center;

    gap:20px;

    margin-top:20px;

}

button{

    padding:8px 14px;

    cursor:pointer;

}

</style>