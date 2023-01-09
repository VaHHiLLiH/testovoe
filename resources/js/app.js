require('./bootstrap');

import { createApp } from 'vue';
import products from './components/products';

const app = createApp({});

app.component('products', products);

app.mount('#app');
