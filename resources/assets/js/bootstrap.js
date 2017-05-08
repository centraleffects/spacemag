
window._ = require('lodash');

/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

window.$ = window.jQuery = require('jquery');

window.angular = require('angular');
require('./angular/angular-route.js');
require('../materialize/js/materialize.js');

require('angucomplete-alt');

require('../password_strength/password_strength_lightweight.js');

require('./rebuy.lib.js');

import 'angucomplete-alt/angucomplete-alt.css';

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from "laravel-echo"

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: 'your-pusher-key'
// });
