import Vue from "vue";
import Vuex from "vuex";
import tasks from "./modules/tasks";

Vue.use(Vuex);

const store = new Vuex.Store({
    modules: {
        tasks,
    },
});

export default store;
