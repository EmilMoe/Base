# Base

This package will provide base structure to the Laravel project such as master templates and Vue EventBus and easy
Vuex binding.

### Install

Before this package work, Vuex must be installed and the Vue app must be configured.

### Vue app

The Vue app must have the `bind` method addded:

````
const app = new Vue({
    [...]
    methods: {
        /**
         * Syntactic sugar for binding to Vuex dynamics binding.
         *
         * @param  {string} property Node to bind to
         * @param  {mixed}  value    Value to assign
         * @return {mixed}           Value that was assigned
         */
        bind(property, value = undefined) {
            if (value === undefined)
                return _.get(this.$store.state.bindings, property, null)

            this.$store.commit('bind', [property, value])
        }
    },
    [...]
});
````

### Vuex

The Vuex store must have the following methods addded:

````
export const store = new Vuex.Store({
    [...]
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
    }
    [...]
})
````