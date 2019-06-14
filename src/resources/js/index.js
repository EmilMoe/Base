/**
 * Set up event bus
 *
 * @type {Vue}
 */

window.EventBus = new Vue()

/**
 * Set up moment.js
 *
 * @type {moment}
 */

window.moment = require('moment')
window.moment.locale('da')

/**
 * Utility mixin
 *
 * This mixin add shortcut to common methods accross the platform.
 */ 
require('./mixin')

/**
 * Vuex store
 */
import { store } from './store'

window.Vuex = store

if (_.get(window, ['Laravel', 'user'], false)) {
    window.Vuex.state.user = window.Laravel.user
}

/**
 * Easy bind variables to the store.
 */
require('./bind')

/**
 * Prevent Axios from making same GET request twice. 
 */
require('./AxiosCache')