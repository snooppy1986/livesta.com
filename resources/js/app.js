/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

/*import './bootstrap';*/
import '../css/app.css';
import 'vue-search-select/dist/VueSearchSelect.css'
import Moveable from '@gabojkz/vue_moveable_v3';
import { createApp } from 'vue';
import {h} from 'vue';
import IndexComponent from "./components/IndexComponent.vue";
import main_menu from "./components/elements/_main_menu.vue";
import child_main_menu from "./components/elements/child_main_menu.vue";
import rangeSlider from "./components/elements/category/_rangeSlider.vue";
import router from "./router/index";
import Paginate from 'vuejs-paginate-next';
import VueformSlider from '@vueform/slider';
import vue3Spinner from 'vue3-spinner';

import { createMetaManager, defaultConfig, plugin as metaPlugin} from 'vue-meta'
/**
 * Next, we will create a fresh Vue application instance. You may then begin
 * registering components with the application instance so they are ready
 * to use in your application's views. An example is included for you.
 */

const app = createApp({
    components:{
        IndexComponent,
        main_menu,
        child_main_menu,
        rangeSlider,

    }
}).use(Paginate).use(vue3Spinner);

app.component('Slider', VueformSlider);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// Object.entries(import.meta.glob('./**/*.vue', { eager: true })).forEach(([path, definition]) => {
//     app.component(path.split('/').pop().replace(/\.\w+$/, ''), definition.default);
// });

/**
 * Finally, we will attach the application instance to a HTML element with
 * an "id" attribute of "app". This element is included with the "auth"
 * scaffolding. Otherwise, you will need to add an element yourself.
 */


const metaManager = createMetaManager(false, {
    ...defaultConfig,
    meta: { keyName: 'head', tag: 'meta', nameless: true, refreshOnceOnNavigation: true},
});

app.use(router).use(metaManager).use(metaPlugin) ;
/*app.use(axios);*/
app.mount('#app');
