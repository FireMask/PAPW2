define(['jquery', 'datatables', 'vue', 'bootstrap-checkbox', 'chartjs'],  function($, DataTable, Vue, Checkbox, Chart) {
	$(document).ready(function() {
		$('#table_id').DataTable({
			"scrollX": true
		});

        $(":checkbox").checkboxpicker();

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
