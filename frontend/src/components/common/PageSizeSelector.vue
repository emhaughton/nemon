<script setup lang="ts">

defineProps<{

    modelValue: number;

}>();

const emit = defineEmits<{

    (event: 'update:modelValue', value: number): void;

}>();

</script>

<template>

<select
    :value="modelValue"
    @change="emit('update:modelValue', Number(($event.target as HTMLSelectElement).value))"
>

    <option :value="10">10</option>

    <option :value="25">25</option>

    <option :value="50">50</option>

</select>

</template>

<style scoped>

select {

    padding: 6px;

}

</style>