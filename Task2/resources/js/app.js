
import * as Vue from 'vue'
import App from "./App.vue";
import axios from 'axios'
import VueAxios from 'vue-axios'
import mitt from 'mitt';

const emitter = mitt();

const app = Vue.createApp(App);

app.config.globalProperties.emitter = emitter;

app.mount("#app");

app.use(VueAxios, axios);
