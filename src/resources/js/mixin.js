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
        },
        /**
         * Language object.
         */
        lang() {
            return window.lang
        }
    },
    methods: {
        /** 
         * Get translation.
         */
        __(phrase, source = null) {
            let currentSource = window.lang.getSource()
            window.lang.setSource(source)
            let message = window.lang.get(phrase)
            window.lang.setSource(curretnSource)

            return message
        }
    }
})