define(['jquery', 'datatables', 'vue', 'bootstrap-checkbox'],  function($, DataTable, Vue, Checkbox) {
	$(document).ready(function() {
		$('#table_id').DataTable({
			"scrollX": true
		});

        $(":checkbox").checkboxpicker();

		Vue.component('view-usuario', require('./components/admin/usuario/view-usuario.vue'));

		const app = new Vue({
		    el: '#listaUsuarios',
			data: {
				usuarios: [],
				usuariosMostrados: [],
				paginaActual: 0,
				indiceCentral: 0,
				datosPorPagina: 4,
				busqueda: ''
			},
			computed: {
				usuariosFiltrados: function () {
					var self = this;
					this.busqueda = this.busqueda.trim().toLowerCase();

					if(this.busqueda == ''){
						return this.usuarios;
					}

					var usuarios = this.usuarios.filter(function(item){
						return item.nombres.toLowerCase().indexOf(self.busqueda) !== -1;
					});
					this.paginaActual = 0;
					return usuarios;
				},
				paginas: function() {
					return Math.ceil(this.usuariosFiltrados.length / this.datosPorPagina);
				},
				centro: function() {
					var centro = 0;
					if (this.paginas > 5) {
						if (this.paginaActual < 2) {
							centro = 2;
						} else if (this.paginaActual > this.paginas - 3) {
							centro = this.paginas - 3;
						} else {
							centro = this.paginaActual;
						}
					}
					return centro;
				},
				inicio: function() {
					return this.centro - 2 > 0 ? this.centro - 2 : 0;
				},
				fin: function() {
					return (this.inicio + 5 > this.paginas ? this.paginas : this.inicio + 5) - this.inicio;
				}
			},
			methods: {
		        loadData: function () {
		            $.get('/api/usuarios', function (response) {
		                this.usuarios = response.usuarios;
						this.mostrarPagina();
		            }.bind(this));
		        },
				mostrarPagina: function() {
					var usados = (this.paginaActual * this.datosPorPagina) + this.datosPorPagina;
					var restantes = usados > this.usuariosFiltrados.length ? this.usuariosFiltrados.length - (this.paginaActual * this.datosPorPagina) : this.datosPorPagina;
					this.usuariosMostrados = this.usuariosFiltrados.slice((this.paginaActual * this.datosPorPagina), (this.paginaActual * this.datosPorPagina) + restantes);
				},
				pagina: function(numero) {
					this.paginaActual = numero;
					this.mostrarPagina();
				},
				paginaSiguiente: function() {
					if (this.paginaActual < Math.ceil(this.usuariosFiltrados.length / this.datosPorPagina) - 1) {
						this.paginaActual++;
						this.mostrarPagina();
					}
				},
				paginaAnterior: function() {
					if (this.paginaActual > 0) {
						this.paginaActual--;
						this.mostrarPagina();
					}
				}
		    },
		    mounted: function () {
		        this.loadData();
		        setInterval(function () {
		            this.loadData();
		        }.bind(this), 30000);
		    }
		});
	});
});
