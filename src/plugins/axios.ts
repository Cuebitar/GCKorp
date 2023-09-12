import axios from 'axios';
import { App } from 'vue';

interface AxiosOptions {
  baseUrl?: string;
  token?: string;
}

let axiosInstance = axios.create();

export function setupAxios(app: App, options: AxiosOptions) {
  axiosInstance = axios.create({
    baseURL: options.baseUrl,
    headers: {
      Authorization: options.token != null ? `Bearer ${options.token}` : '',
    },
  });

  app.config.globalProperties.$axios = axiosInstance;
}