<script setup lang="ts">
defineProps<{
    message?: string;
}>();
</script>

<template>

<div class="loading">

    {{ message ?? 'Loading...' }}

</div>

</template>

<style scoped>

.loading {

    padding: 20px;

    text-align: center;

    color: #666;

}

</style>