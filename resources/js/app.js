import './bootstrap';

import { createApp } from 'vue';
import { createPinia } from 'pinia';
import { createPersistedState } from 'pinia-plugin-persistedstate';

import router from './routes';
import App    from '@/Pages/App/App.vue'

const pinia = createPinia()
.use(createPersistedState());

createApp(App)
.use(router)
.use(pinia)
.mount('#app');
