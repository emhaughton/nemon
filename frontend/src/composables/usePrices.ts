import { onMounted, ref } from 'vue';

import { getPrices } from '@/api/prices';

import type { DailyHourlyValues } from '@/types/dailyHourlyValues';
import type { Pagination } from '@/types/pagination';

export function usePrices() {

    const prices = ref<DailyHourlyValues[]>([]);

    const pagination = ref<Pagination>({
        currentPage: 1,
        perPage: 10,
        total: 0,
        lastPage: 0,
    });

    const loading = ref(false);

    const error = ref<string | null>(null);

    async function load(
        page = 1,
    ): Promise<void> {

        loading.value = true;

        error.value = null;

        try {

            const response = await getPrices(
                page,
                pagination.value.perPage,
            );

            prices.value = response.data;

            pagination.value = response.meta;

        } catch {

            error.value = 'Unable to load prices.';

        } finally {

            loading.value = false;

        }

    }

    async function changePage(
        page: number,
    ): Promise<void> {

        await load(
            page,
        );
    }

    async function changePerPage(
        perPage: number,
    ): Promise<void> {

        pagination.value.perPage = perPage;

        await load(
            1,
        );
    }

    onMounted(() => {

        void load();

    });

    return {

        prices,

        pagination,

        loading,

        error,

        load,

        changePage,

        changePerPage,

    };
}