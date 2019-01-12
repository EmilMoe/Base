/**
 * Set up event bus
 *
 * @type {Vue}
 */

window.EventBus = new Vue()

/**
 * Easy bind variables to the BaseStore
 */
require('./bind')