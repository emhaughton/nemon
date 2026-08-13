import { ref } from 'vue';

import { calculateIndexedPrice } from '@/api/indexedPrice';

const DEFAULT_FORMULA = '(CONSUMPTION * PRICE)';

export function useIndexedPrice() {

    const from = ref('');

    const to = ref('');

    const formula = ref(
        DEFAULT_FORMULA,
    );

    const indexedPrice = ref<number>();

    const loading = ref(false);

    const error = ref<string>();

    async function calculate(): Promise<void> {

        loading.value = true;

        error.value = undefined;

        try {

            const response =
                await calculateIndexedPrice({

                    from: from.value,

                    to: to.value,

                    formula: formula.value,

                });

            indexedPrice.value =
                response.price_indexed;

        } catch (e) {
            // Prefer the API-provided message when available
            const apiMessage = (e as any)?.response?.data?.message;
            error.value = apiMessage ?? 'Unable to calculate indexed price.';

            // Clear previous result when calculation fails
            indexedPrice.value = undefined;

        } finally {

            loading.value = false;

        }

    }

    return {

        from,

        to,

        formula,

        indexedPrice,

        loading,

        error,

        calculate,

    };
}