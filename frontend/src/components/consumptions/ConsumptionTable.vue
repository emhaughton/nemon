<script setup lang="ts">

import HourlyValuesTable from '../common/HourlyValuesTable.vue';

import type { DailyHourlyValues } from '@/types/dailyHourlyValues';

defineProps<{

    consumptions: DailyHourlyValues[];

}>();

</script>

<template>

<HourlyValuesTable
    :rows="consumptions"
/>

</template>