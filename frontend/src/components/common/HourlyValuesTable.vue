<script setup lang="ts">
import type { DailyHourlyValues } from '@/types/dailyHourlyValues';

defineProps<{
    rows: DailyHourlyValues[];
}>();

const hours = Array.from(
    { length: 25 },
    (_, index) => index + 1,
);
</script>

<template>

<div class="table-container">

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
                v-for="row in rows"
                :key="row.date"
            >

                <td>

                    {{ row.date }}

                </td>

                <td
                    v-for="hour in hours"
                    :key="hour"
                >
                    {{ row[`h${hour}` as keyof DailyHourlyValues] }}
                </td>

            </tr>

        </tbody>

    </table>

</div>

</template>

<style scoped>

.table-container {

    overflow-x: auto;

}

table {

    width: 100%;

    border-collapse: collapse;

}

th,
td {

    border: 1px solid #ddd;

    padding: 8px;

    text-align: center;

    white-space: nowrap;

}

thead {

    background: #f5f5f5;

}

</style>