# Base

This package will provide base structure to the Laravel project such as master templates and Vue EventBus and easy
Vuex binding.

### Install

Before this package work, Vuex must be installed and the Vue app must be configured.

`npm install --save-dev vuex`

### Vue app

The Vue app must be slightly modified:

````
store = window.Vuex

[..]

const app = new Vue({
    el: '#app',
    store
});
````