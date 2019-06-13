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
         * Get the moment.js instance.
         *
         * @return {moment}
         */
        moment() {
            return window.moment
        }
    },
    methods: {
        /**
         * Remove objects from array.
         *
         * @param {Array}  array
         * @param {Array}  ids
         * @param {String} identifier
         */
        _remove(array, ids, identifier = 'id') {
            if (ids.constructor !== Array) {
                ids = [ids]
            }

            return array.filter(item => {
                return ! ids.includes(item[identifier])
            })
        },
        /**
         * Check if a module is loaded.
         *
         * @param {string} module
         * @return {bool}
         */
        hasModule(module) {
            return window.Laravel.modules.includes(module)
        },
        /**
         * Return a number as locale formatted.
         *
         * @param {Number} number
         * @param {String} format
         * @param {Number} minFraction
         * @returns {String}
         */
        toLocaleNumber(number, format = 'decimal', minFraction = null, maxFraction = null) {
            if (Intl === undefined)
                return number

            if ((minFraction === null && number % 1 > 0) || isNaN(parseInt(minFraction)))
                minFraction = 1

            if (maxFraction === null || isNaN(parseInt(maxFraction)))
                maxFraction = 10

            if (format.toLowerCase() === 'percent')
                number = number / 100

            return new Intl.NumberFormat(window.Laravel.locale, {
                style: format.toLowerCase(),
                minimumFractionDigits: minFraction,
                maximumFractionDigits: maxFraction,
            }).format(number)
        }
    }
})