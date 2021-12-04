//LODASH

window._ = require('lodash');

//BOOTSTRAP

try {
    window.Popper = require('popper.js').default;
    window.$ = window.jQuery = require('jquery');

    require('bootstrap');
} catch (e) {}

//AXIOS

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

//VUE

import { createApp } from  'vue'

window.app = createApp({});
window.vm = app.mount('#app');