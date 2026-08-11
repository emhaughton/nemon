import api from './axios'

export const getIndexedPrice = async () => {
  const { data } = await api.get('/indexed-price')
  return data
}
