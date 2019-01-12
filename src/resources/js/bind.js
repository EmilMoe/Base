import { BaseStore } from './BaseStore'

Vue.mixin({
    BaseStore,
    mounted() {
        this.bind('app', this.window.Laravel)

        if (this.window.bind) {
            Object.entries(this.window.bind).forEach(entry => {
                this.bind(entry[0], entry[1])
            })
        }
    },
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
    }
})