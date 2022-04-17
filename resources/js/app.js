require('./bootstrap');
import VueRouter from "vue-router";
import router from "./routes";
import Vuex from 'vuex';
import Index from "./Index";
import storeDefinition from "./store";
import ValidationErrors from "./shared/components/ValidationErrors";

window.Vue = require('vue').default;
Vue.use(VueRouter);
Vue.use(Vuex);
Vue.component("v-errors", ValidationErrors);
const store = new Vuex.Store(storeDefinition);
const app = new Vue({
    el: "#app",
    router,
    store,
    components: {
        index: Index,
    },
    async beforeCreate(){
        this.$store.dispatch("loadStoredState");
    }
});
