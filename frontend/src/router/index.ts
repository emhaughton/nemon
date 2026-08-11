import { createRouter, createWebHistory } from 'vue-router';

import ConsumptionsPage from '@/pages/ConsumptionsPage.vue';
import PricesPage from '@/pages/PricesPage.vue';
import IndexedPricePage from '@/pages/IndexedPricePage.vue';

const router = createRouter({
    history: createWebHistory(),

    routes: [
        {
            path: '/',
            redirect: '/consumptions',
        },
        {
            path: '/consumptions',
            component: ConsumptionsPage,
        },
        {
            path: '/prices',
            component: PricesPage,
        },
        {
            path: '/indexed-price',
            component: IndexedPricePage,
        },
    ],
});

export default router;