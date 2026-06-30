import axios, {
    type AxiosInstance,
    type AxiosError,
    type AxiosResponse,
} from 'axios'

const api = axios.create({
    baseURL: '/api',
    withCredentials: true,
    withXSRFToken: true,
    headers: {
        Accept: 'application/json',
        'X-Requested-With': 'XMLHttpRequest',
    },
})

export function csrf() {
    return axios.get('/sanctum/csrf-cookie', {
        withCredentials: true,
    })
}

export default api