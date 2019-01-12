import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

export const BaseStore = new Vuex.Store({
    state: {
        bindings: {}
    },
    mutations: {
        /**
         * Variable bindings to the store.
         *
         * @param  {Object} state   Current state
         * @param  {Array}  payload First parameter should be the binding path, second is the value
         */
        bind(state, payload) {
            state.bindings = Object.assign({}, state.bindings, _.set(state.bindings, payload[0], payload[1]))
        },
        /**
         * Delete a binding.
         *
         * @param state
         * @param payload
         */
        deleteBind(state, payload) {
            let bindings = state.bindings

            if (Array.isArray(payload))
                _.get(bindings, payload[0]).splice(payload[1], 1)
            else
                delete _.get(bindings, payload)

            state.bindings = Object.assign({}, bindings)
        },
        /**
         * Refresh all bindings.
         *
         * @param state
         * @param payload
         */
        refresh(state, payload) {
            let tmp        = state.bindings
            state.bindings = null
            state.bindings = Object.assign({}, tmp)
        }
    },
    actions: {

    },
    getters: {

    }
})
