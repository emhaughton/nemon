<script setup lang="ts">

import type { DailyHourlyValues } from '@/types/dailyHourlyValues';

defineProps<{
    consumptions: DailyHourlyValues[];
}>();

const hours = Array.from(
    { length: 25 },
    (_, index) => index + 1,
);

</script>

<template>

<table>

    <thead>

        <tr>

            <th>Date</th>

            <th
                v-for="hour in hours"
                :key="hour"
            >
                H{{ hour }}
            </th>

        </tr>

    </thead>

    <tbody>

        <tr
            v-for="consumption in consumptions"
            :key="consumption.date"
        >

            <td>

                {{ consumption.date }}

            </td>

            <td
                v-for="hour in hours"
                :key="hour"
            >
                {{ consumption[`h${hour}` as keyof DailyHourlyValues] }}
            </td>

        </tr>

    </tbody>

</table>

</template>

<style scoped>

table {

    width: 100%;

    border-collapse: collapse;

}

th,
td {

    border: 1px solid #DDD;

    padding: 6px;

    text-align: center;

}

thead {

    background: #F5F5F5;

}

</style>