define([
	'jquery',
	'datatables',
	'vue',
	'vuex',
	'bootstrap-checkbox',
	'chartjs',
	'bootstrap-fileinput',
	'bootstrap-datepicker',
	'vue-router',
	'vue-resource',
	'./store/store'
],
function($, DataTable, Vue, Vuex, Checkbox, Chart, FileInput, DatePicker, VueRouter, VueResource, store) {

	Vue.use(VueResource);

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

		var token = $('meta[name="token"]').attr('content');
		Vue.http.headers.common['X-CSRF-TOKEN'] = token;
		store.commit('setToken', token);

		Vue.component('passport-clients',					require('./components/passport/Clients.vue'));
		Vue.component('passport-authorized-clients',		require('./components/passport/AuthorizedClients.vue'));
		Vue.component('passport-personal-access-tokens', 	require('./components/passport/PersonalAccessTokens.vue'));

		Vue.component('barra-lateral', 	require('./components/template/barra-lateral.vue'));
		Vue.component('barra-superior', require('./components/template/barra-superior.vue'));

		Vue.component('pantalla-usuario', 	require('./components/admin/usuario/pantalla-usuario.vue'));
		Vue.component('lista-usuario', 		require('./components/admin/usuario/lista-usuario.vue'));
		Vue.component('view-usuario', 		require('./components/admin/usuario/view-usuario.vue'));
		Vue.component('perfil-usuario', 	require('./components/admin/usuario/perfil-usuario.vue'));
		Vue.component('editor-usuario', 	require('./components/admin/usuario/editor-usuario.vue'));

		Vue.component('pantalla-cliente', 	require('./components/admin/cliente/pantalla-cliente.vue'));
		Vue.component('lista-cliente', 		require('./components/admin/cliente/lista-cliente.vue'));
		Vue.component('view-cliente', 		require('./components/admin/cliente/view-cliente.vue'));
		// Vue.component('perfil-cliente', 	require('./components/admin/cliente/perfil-cliente.vue'));
		// Vue.component('editor-cliente', 	require('./components/admin/cliente/editor-cliente.vue'));

		Vue.component('pantalla-cotizacion', 	require('./components/admin/cotizacion/pantalla-cotizacion.vue'));
		Vue.component('lista-cotizacion', 		require('./components/admin/cotizacion/lista-cotizacion.vue'));
		Vue.component('view-cotizacion', 		require('./components/admin/cotizacion/view-cotizacion.vue'));
		// Vue.component('perfil-cotizacion', 	require('./components/admin/cotizacion/perfil-cotizacion.vue'));
		// Vue.component('editor-cotizacion', 	require('./components/admin/cotizacion/editor-cotizacion.vue'));

		Vue.component('pantalla-fabricante', 	require('./components/admin/fabricante/pantalla-fabricante.vue'));
		Vue.component('lista-fabricante', 		require('./components/admin/fabricante/lista-fabricante.vue'));
		Vue.component('view-fabricante', 		require('./components/admin/fabricante/view-fabricante.vue'));
		// Vue.component('perfil-fabricante', 	require('./components/admin/fabricante/perfil-fabricante.vue'));
		// Vue.component('editor-fabricante', 	require('./components/admin/fabricante/editor-fabricante.vue'));

		Vue.component('pantalla-moneda', 	require('./components/admin/moneda/pantalla-moneda.vue'));
		Vue.component('lista-moneda', 		require('./components/admin/moneda/lista-moneda.vue'));
		Vue.component('view-moneda', 		require('./components/admin/moneda/view-moneda.vue'));
		// Vue.component('perfil-moneda', 	require('./components/admin/moneda/perfil-moneda.vue'));
		// Vue.component('editor-moneda', 	require('./components/admin/moneda/editor-moneda.vue'));

		Vue.component('pantalla-proveedor', 	require('./components/admin/proveedor/pantalla-proveedor.vue'));
		Vue.component('lista-proveedor', 		require('./components/admin/proveedor/lista-proveedor.vue'));
		Vue.component('view-proveedor', 		require('./components/admin/proveedor/view-proveedor.vue'));
		// Vue.component('perfil-proveedor', 	require('./components/admin/proveedor/perfil-proveedor.vue'));
		// Vue.component('editor-proveedor', 	require('./components/admin/proveedor/editor-proveedor.vue'));

		Vue.component('pantalla-rol', 	require('./components/admin/rol/pantalla-rol.vue'));
		Vue.component('lista-rol', 		require('./components/admin/rol/lista-rol.vue'));
		Vue.component('view-rol', 		require('./components/admin/rol/view-rol.vue'));
		// Vue.component('perfil-rol', 	require('./components/admin/rol/perfil-rol.vue'));
		// Vue.component('editor-rol', 	require('./components/admin/rol/editor-rol.vue'));

		Vue.component('pantalla-producto', 	require('./components/admin/producto/pantalla-producto.vue'));
		Vue.component('lista-producto', 	require('./components/admin/producto/lista-producto.vue'));
		Vue.component('view-producto', 		require('./components/admin/producto/view-producto.vue'));
		// Vue.component('perfil-producto', require('./components/admin/producto/perfil-producto.vue'));
		// Vue.component('editor-producto', require('./components/admin/producto/editor-producto.vue'));

		Vue.component('pantalla-empresa', 	require('./components/admin/empresa/pantalla-empresa.vue'));
		Vue.component('view-empresa', 		require('./components/admin/empresa/view-empresa.vue'));

		Vue.component('modal', require('./components/modal.vue'));

		new Vue({
		    el: '#App',
			data: {
				sesion: null
			},
			methods: { },
			computed: {
				actualPage: function() {
					return store.state.navegacion.currentPage;
				},
				accion: function() {
					return store.state.navegacion.currentAction;
				}
			},
			filters: {
				capitalize: function (value) {
					if (!value) return ''
					value = value.toString()
					return value.charAt(0).toUpperCase() + value.slice(1)
				}
			}
		});
	});
});
