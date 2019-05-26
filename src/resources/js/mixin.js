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
    }
})