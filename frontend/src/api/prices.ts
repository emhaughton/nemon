import axios from './axios';
import type { DailyHourlyValues } from '@/types/dailyHourlyValues';
import type { PaginatedResponse } from '@/types/paginatedResponse';

export async function getPrices(
    page = 1,
    perPage = 10,
): Promise<PaginatedResponse<DailyHourlyValues>> {

    const response = await axios.get<PaginatedResponse<DailyHourlyValues>>(
        '/prices',
        {
            params: {
                page,
                perPage,
            },
        },
    );

    return response.data;
}