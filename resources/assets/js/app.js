require('./bootstrap');

window.Vue = require('vue');
window.Vuelogin = require('vue');

/*-- pages --*/
Vue.component('contenedor-principal', require('./components/pages/ContenedorPrincipal.vue'));
Vue.component('solicitud-form', require('./components/pages/SolicitudForm.vue'));

/*-- elements --*/
Vue.component('usuario-datos-personales', require('./components/elements/UsuarioDatosPersonales'));
Vue.component('usuario-solicitud-pendiente', require('./components/elements/UsuarioSolicitudPendiente'));
Vue.component('solicitud-element', require('./components/elements/SolicitudElement'));
Vue.component('historial-element', require('./components/elements/HistorialElement'));

const app = new Vue({
    el: '#app'
});


Vuelogin.component('login-form',require('./components/pages/LoginForm.vue'));
Vuelogin.component('registro-form',require('./components/pages/RegistroForm.vue'));

const login = new Vuelogin({
    el: '#login'
});