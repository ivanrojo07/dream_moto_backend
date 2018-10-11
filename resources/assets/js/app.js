
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));
Vue.component('servicios-component',require('./components/ServiciosComponent.vue'));
Vue.component('revision-component', require('./components/RevisionComponent.vue'));
Vue.component('refaccion-component',require('./components/RefaccionComponent.vue'));
Vue.component('servicio-component', require('./components/ServicioComponent.vue'));

// Vue.filter('formatDate', {
// 		read: function (val) {
//     	return formatDate(parseDate(val));
// 	},
// 	  write: function (val, oldVal) {
//       var d = parseDate(val);
// 	  return d ? formatDate(d) : val
// 	}  
// });

const app = new Vue({
    el: '#app',
    data: {
    	message:'hola'
    }
});


// // super simple pt-BR date parser
// function parseDate(str) {
//   if(str === null || isDate(str)) return str || null;
//   var p = str.match(/^(\d{1,2})\/?(\d{1,2})?\/?(\d{2,4})?$/);
//   if(!p) return null;
//   return new Date(parseInt(p[3] || new Date().getFullYear()), parseInt(p[2] || (new Date().getMonth() + 1)) - 1, parseInt(p[1]), 0, 0, 0, 0);
// }

// super simple pt-BR date format
function formatDate(dt) {
  if(dt == null) return '';
  var f = function(d) { return d < 10 ? '0' + d : d; };
  return f(dt.getDate()) + '/' + f(dt.getMonth() + 1) + '/' + dt.getFullYear();
}

// // is object a date?
// function isDate(d) {
//     return Object.prototype.toString.call(d) === '[object Date]';
// }