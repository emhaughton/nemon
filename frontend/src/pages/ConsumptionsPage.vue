<script setup lang="ts">
import ConsumptionTable from '../components/consumptions/ConsumptionTable.vue';
import ErrorMessage from '../components/common/ErrorMessage.vue';
import Loading from '../components/common/Loading.vue';
import PageSizeSelector from '../components/common/PageSizeSelector.vue';
import Pagination from '../components/common/Pagination.vue';

import { useConsumptions } from '../composables/useConsumptions';

const {
    consumptions,
    pagination,
    loading,
    error,
    changePage,
    changePerPage,
} = useConsumptions();
</script>

<template>
    <h2>Consumptions</h2>

    <Loading
        v-if="loading"
    />

    <ErrorMessage
        v-else-if="error"
        :message="error"
    />

    <template v-else>

        <div class="toolbar">

            <div>

                Total records:
                <strong>{{ pagination.total }}</strong>

            </div>

            <div>

                Rows per page:

                <PageSizeSelector
                    :model-value="pagination.perPage"
                    @update:model-value="changePerPage"
                />

            </div>

        </div>

        <ConsumptionTable
            :consumptions="consumptions"
        />

        <Pagination
            :current-page="pagination.currentPage"
            :last-page="pagination.lastPage"
            @change="changePage"
        />

    </template>
</template>

<style scoped>

.toolbar {

    display: flex;

    justify-content: space-between;

    align-items: center;

    margin-bottom: 20px;

}

</style>