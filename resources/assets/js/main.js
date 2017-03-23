define(['jquery', 'datatables', 'vue', 'bootstrap-checkbox', 'chartjs'],  function($, DataTable, Vue, Checkbox, Chart) {
	$(document).ready(function() {
		$('#table_id').DataTable({
			"scrollX": true
		});

        $(":checkbox").checkboxpicker();

		Vue.component(
		    'passport-clients',
		    require('./components/passport/Clients.vue')
		);

		Vue.component(
		    'passport-authorized-clients',
		    require('./components/passport/AuthorizedClients.vue')
		);

		Vue.component(
		    'passport-personal-access-tokens',
		    require('./components/passport/PersonalAccessTokens.vue')
		);

		Vue.component('lista-usuario', require('./components/admin/usuario/lista-usuario.vue'));
		Vue.component('view-usuario', require('./components/admin/usuario/view-usuario.vue'));
		Vue.component('perfil-usuario', require('./components/admin/usuario/perfil-usuario.vue'));
		Vue.component('modal', require('./components/modal.vue'));

		var usuarios = new Vue({
		    el: '#pantallaUsuarios',
			data: {
				usuarioSeleccionado: null
			},
			methods: {
				seleccionado: function(usuario) {
					this.usuarioSeleccionado = usuario;
				}
			}
		});
	});
});
