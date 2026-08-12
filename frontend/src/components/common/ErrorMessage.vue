<script setup lang="ts">

defineProps<{

    message: string;

}>();

</script>

<template>

<div class="error">

    {{ message }}

</div>

</template>

<style scoped>

.error {

    color: #c62828;

    padding: 15px;

    border: 1px solid #c62828;

    border-radius: 4px;

    background: #ffebee;

}

</style>