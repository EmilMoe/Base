Vue.mixin({
    methods: {
        /**
         * Connect every component to the bind operator.
         *
         * @param  {string} property Node to bind to
         * @param  {mixed}  value    Value to assign
         * @return {mixed}           Value that was assigned
         */
        bind(property, value = undefined) {
            if (value === undefined) {
                return _.get(this.$store.state.base.bindings, property, null)
            }

            this.$store.commit('bind', [property, value])
        },
        /**
         * Detele a bound variable.
         *
         * @param {string} property
         */
        unbind(property) {
            this.$store.commit('unbind', property)
        },
        /**
         * Is property bound.
         *
         * @param {string} property
         * @return {bool}
         */
        hasBind(property) {
            return this.bind(property) !== null
        },
        /**
         * Alternate method name for hasBind().
         *
         * @param {string} property
         * @return {bool}
         */
        isBound(property) {
            return this.hasBind(property)
        }
    }
})

Vue.use({
    install(Vue) {
        window.Vuex.registerModule('base', {
            state: {
                /**
                 * Bounded variables
                 *
                 * @var {object}
                 */
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
                 * @param {Object} state
                 * @param {string} payload
                 */
                unbind(state, payload) {
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
                 * @param {Object} state
                 * @param {string} payload
                 */
                refresh(state, payload) {
                    let tmp        = state.bindings
                    state.bindings = null
                    state.bindings = Object.assign({}, tmp)
                }
            }
        })
    }
})