var Vue = require('vue');
var Vuex = require('vuex');

Vue.use(Vuex);

const stateModule = {
    state: {
        currentPage: 'inicio',
        pastPages: [],
        currentAction: 'iddle'
    },
    mutations: {
        setPage: function(state, page) {
            state.pastPages.push({
                page: state.currentPage,
                action: state.currentAction
            });
            state.currentPage = page;
        },
        setAction: function(state, action) {
            state.currentAction = action;
        },
        goBack: function() {
            var lastPage = state.pastPages.pop();
            state.currentPage = lastPage.page;
            state.currentAction = lastPage.action;
        }
    },
    actions: {},
    getters: {}
};

const globals = {
    state: {
        token: null
    },
    mutations: {
        setToken: function(state, token) {
            state.token = token;
        }
    }
};

module.exports = new Vuex.Store({
    modules: {
        navegacion: stateModule,
        globales: globals
    }
});
