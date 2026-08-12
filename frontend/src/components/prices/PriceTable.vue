<script setup lang="ts">

import HourlyValuesTable from '../common/HourlyValuesTable.vue';

import type { DailyHourlyValues } from '@/types/dailyHourlyValues';

defineProps<{

    prices: DailyHourlyValues[];

}>();

</script>

<template>

<HourlyValuesTable
    :rows="prices"
/>

</template>