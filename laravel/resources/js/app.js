require('./bootstrap');

import { createApp } from 'vue'
import ExampleComponent from './components/ExampleComponent.vue'

const Home = { template: "<div>Home</div>" };
const About = { template: "<div>About</div>" };
const routes = [
  { path: "/", component: Home },
  { path: "/about", component: About },
];
import { createRouter, createWebHistory } from "vue-router";
const router = createRouter({
  history: createWebHistory(),
  routes,
});

createApp({
    components: {
        ExampleComponent
    }
}).use(router).mount('#app')
