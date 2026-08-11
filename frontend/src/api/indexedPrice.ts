import api from './axios';

import type { CalculateIndexedPriceRequest } from '@/types/calculateIndexedPriceRequest';
import type { CalculateIndexedPriceResponse } from '@/types/calculateIndexedPriceResponse';

export async function calculateIndexedPrice(
    request: CalculateIndexedPriceRequest,
): Promise<CalculateIndexedPriceResponse> {

    const response =
        await api.post<CalculateIndexedPriceResponse>(
            '/indexed-price',
            request,
        );

    return response.data;
}