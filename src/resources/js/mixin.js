Vue.mixin({
    computed: {
        /**
         * Lodash
         *
         * @return object
         */
        _() {
            return window._
        },
        /**
         * Window node
         *
         * @return object
         */
        window() {
            return window
        },
        /**
         * Get the global event bus.
         *
         * @return {Vue}
         * @constructor
         */
        EventBus() {
            return window.EventBus
        },
        /**
         * Syntax sugar to use this.axios
         * @return axios
         */
        axios() {
            return window.axios
        }
    },
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