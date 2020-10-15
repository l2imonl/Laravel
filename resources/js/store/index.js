import Vue from "vue";
import Vuex from "vuex";
import axios from "axios";
import createPersistedState from "vuex-persistedstate";

Vue.use(Vuex);

export default new Vuex.Store({
    plugins: [createPersistedState({
        storage: window.sessionStorage,
    })],
    state: {
        jwt: 'empty',
    },
    mutations: {
        setJwt(state, payload) {
            state.jwt = payload;
        }
    },
    actions: {
        setJwt(state, credentials) {
            axios.post("/api/login", {
                email: credentials.mail,
                password: credentials.password
            }).then(response => {
                state.commit("setJwt", response.data.token);
            });

        }
    },
    modules: {},
    getters: {
        getToken: state => state.jwt,
    },

});
