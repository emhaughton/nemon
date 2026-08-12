<script setup lang="ts">
import PriceTable from '../components/prices/PriceTable.vue';
import ErrorMessage from '../components/common/ErrorMessage.vue';
import Loading from '../components/common/Loading.vue';
import PageSizeSelector from '../components/common/PageSizeSelector.vue';
import Pagination from '../components/common/Pagination.vue';

import { usePrices } from '../composables/usePrices';

const {
    prices,
    pagination,
    loading,
    error,
    changePage,
    changePerPage,
} = usePrices();
</script>

<template>
    <h2>Prices</h2>

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

        <PriceTable
            :prices="prices"
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