define(['jquery', 'datatables', 'vue', 'bootstrap-checkbox', 'chartjs', 'bootstrap-fileinput', 'bootstrap-datepicker', 'vue-router', 'vue-resource'],
function($, DataTable, Vue, Checkbox, Chart, FileInput, DatePicker, VueRouter, VueResource) {
	$(document).ready(function() {
		$('#table_id').DataTable({
			"scrollX": true
		});

        $(":checkbox").checkboxpicker();
        $("#fecha-agregar").datepicker();

        $("#imagen").fileinput({
            showUpload: false,
            maxFileCount: 1,
            showCaption: false
        });

		Vue.use(VueResource);
		Vue.use(VueRouter);

		Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#token').getAttribute('value');

		Vue.component('passport-clients',require('./components/passport/Clients.vue'));
		Vue.component('passport-authorized-clients',require('./components/passport/AuthorizedClients.vue'));
		Vue.component('passport-personal-access-tokens', require('./components/passport/PersonalAccessTokens.vue'));
		Vue.component('lista-usuario', require('./components/admin/usuario/lista-usuario.vue'));
		Vue.component('view-usuario', require('./components/admin/usuario/view-usuario.vue'));
		Vue.component('perfil-usuario', require('./components/admin/usuario/perfil-usuario.vue'));
		Vue.component('modal', require('./components/modal.vue'));

		// var router = new VueRouter();
		//
		// router.map({
		// 	'/': {
		// 		component: Home
		// 	},
		// 	'/usuario': {
		// 		component: SecretQuote
		// 	}
		// })
		//
		// router.redirect({
		// 	'*': '/home'
		// })
		//
		// router.start(App, '#app');
		var usuarios = new Vue({
		    el: '#pantallaUsuarios',
			data: {
				usuarioSeleccionado: null
			},
			methods: {
				seleccionado: function(usuario) {
					this.usuarioSeleccionado = null;
					this.usuarioSeleccionado = usuario;
				}
			}
		});
	});
});
