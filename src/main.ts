/**CSS*/
import './assets/main.css'
import "primevue/resources/themes/lara-light-indigo/theme.css";
import "/node_modules/primeflex/primeflex.css"
import 'primeicons/primeicons.css';

import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import PrimeVue from 'primevue/config';
import axios from './plugins/axios'

const app = createApp(App)

app.use(router)
app.use(PrimeVue)
app.use(axios, {
    baseUrl: 'http://127.0.0.1:8000/'
})
app.config.globalProperties.$user = null;
app.config.globalProperties.$isAuthorised = false;
app.config.globalProperties.$isGuest = true;
console.log(app.config);
app.mount('#app')
