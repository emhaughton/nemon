<script setup lang="ts">
import { useIndexedPrice } from '@/composables/useIndexedPrice';

const {
    from,
    to,
    formula,
    indexedPrice,
    loading,
    error,
    calculate,
} = useIndexedPrice();
</script>

<template>

<form
    class="form"
    @submit.prevent="calculate"
>

    <label>

        From

        <input
            v-model="from"
            type="date"
        >

    </label>

    <label>

        To

        <input
            v-model="to"
            type="date"
        >

    </label>

    <label>

        Formula

        <input
            v-model="formula"
            type="text"
        >

    </label>

    <button
        :disabled="loading"
        type="submit"
    >

        Calculate

    </button>

</form>

<p
    v-if="loading"
>

    Calculating...

</p>

<p
    v-if="error"
>

    {{ error }}

</p>

<h2
    v-if="indexedPrice !== undefined"
>

    {{ indexedPrice }}

</h2>

</template>

<style scoped>

.form{

    display:flex;

    flex-direction:column;

    gap:16px;

    max-width:500px;

}

label{

    display:flex;

    flex-direction:column;

    gap:6px;

}

button{

    width:180px;

    padding:10px;

}

</style>