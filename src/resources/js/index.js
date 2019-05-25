/**
 * Set up event bus
 *
 * @type {Vue}
 */

window.EventBus = new Vue()

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

/**
 * Set language locale.
 */
window.lang = require('lang.js')
window.lang.setLocale(_.get(window, ['Laravel', 'locale'], 'en'))
window.lang.setFallback('en')