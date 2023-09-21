/**CSS*/
import './assets/main.css'
import "primevue/resources/themes/lara-light-indigo/theme.css";
import "/node_modules/primeflex/primeflex.css"
import 'primeicons/primeicons.css';

import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import PrimeVue from 'primevue/config';
import {setupAxios} from './plugins/axios'
import VueCookies from 'vue-cookies';

const app = createApp(App)

app.use(router)
app.use(PrimeVue)
setupAxios(app, {
    baseUrl: 'http://127.0.0.1:8000/',
});

app.use(VueCookies, { expires: '1d'});
app.config.globalProperties.$sleep = (ms) => {
    return new Promise(val => setTimeout(val, ms));
}

console.log(app.config);
app.mount('#app');

