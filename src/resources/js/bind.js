Vue.mixin({
    methods: {
        /**
         * Connect every component to the bind operator of root.
         *
         * @param  {string} property Node to bind to
         * @param  {mixed}  value    Value to assign
         * @return {mixed}           Value that was assigned
         */
        bind(property, value = undefined) {
            return this.$root.bind(property, value)
        }
    }
})