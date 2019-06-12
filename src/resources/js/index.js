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

/**
 * Easy bind variables to the store.
 */
require('./bind')

require('./components')