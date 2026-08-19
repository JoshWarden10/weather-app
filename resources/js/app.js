import '@fortawesome/fontawesome-free/css/all.min.css';

import { createApp } from 'vue';
import Container from './components/weather-app/Container.vue';

import $ from 'jquery';
import select2 from 'select2';

window.$ = $;
window.jQuery = $;

select2(window, $);

createApp(Container).mount('#app');