<template lang="html">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<form id="dataUpdate" class="login-form" method="POST">
				<input type="hidden" name="_token" :value="csrf_token">
                <input type="hidden" name="idUsuario" :value="idUser">
				<input type="hidden" id="idCotizacion" name="idCotizacion" :value="idCotizacion">
				<div class="row">
					<div class="form-group">
						<label for="codigo">Cliente:</label>
						<select required class="form-control input-md" id="cliente" name="idCliente">
							<option v-for="cliente in clientes" :value="cliente.idCliente">{{ cliente.nombre_comercial }}</option>
						</select>
					</div>
				</div>
				<div class="row">
					<div class="col-md-4">
						<div class="form-group">
		                    <label for="codigo">Moneda:</label>
							<select required class="form-control input-md" id="moneda" name="idMoneda">
								<option v-for="moneda in monedas" :value="moneda.idMoneda">{{ moneda.nombre }}</option>
							</select>
		                </div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
		                    <label for="codigo">Validez:</label>
							<select required class="form-control input-md" id="validez" name="validez">
								<option value="5">5 días</option>
								<option value="10">10 días</option>
								<option value="15">15 días</option>
								<option value="30">30 días</option>
								<option value="60">60 días</option>
							</select>
		                </div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
		                    <label for="codigo">Metodo de Pago:</label>
							<select required class="form-control input-md" id="pago" name="pago">
								<option value="Contado">Contado</option>
								<option value="Credito">Credito</option>
							</select>
		                </div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<label for="codigo">Agregar Producto:</label>
						<select required class="form-control input-lg" id="producto" name="idProducto">
							<option v-for="producto in productos" :value="producto.idProducto">{{ producto.modelo }}</option>
						</select>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<a class="btn btn-success btn-lg btn-block" v-on:click="agregarProducto()">
							Agregar +
						</a>
					</div>
				</div>
				<div class="row">
					<div class="col-md-10">
						<hr>
						<label for="">Productos</label>
						<div class="col-md-12">
							asd
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
	                    <div class="col-md-6" align="left">
							<hr>
	                        <a class="btn btn-default" v-on:click="regresar()">
	                            <i class="fa fa-arrow-left"></i> Regresar
	                        </a>
	                    </div>
					</div>
                </div>
			</form>
		</div>
	</div>
</template>

<script>
var store = require('./../../../store/store.js');
var idCotizacion = null;
var prodCount = 0;
export default {
	data() {
		return {
			clientes:[],
			monedas:[],
			productos:[]
		};
	},
	computed:{
		csrf_token: function() {
			return store.state.globales.token;
		},
		idUser: function(){
			return store.state.globales.idUser;
		},
		textoBoton: function() {
			return this.cliente == null ? 'Actualizar' : 'Agregar';
		}
	},
	methods:{
		agregarProducto: function(){
			var idP = $("#producto").val();
			if(prodCount == 0){
				prodCount++;
				this.crearCotizacion();
				$("#idCotizacion").val(idCotizacion);
			}else{

			}
		},
		loadData: function(){
			this.$http.get('/cliente/'+store.state.globales.idUser+'/info_cotizacion').then(response => {
				this.monedas = response.body.monedas;
				this.clientes = response.body.clientes;
				this.productos = response.body.productos;
				$('select[name="idMoneda"]').val(this.monedas);
				$('select[name="idCliente"]').val(this.clientes);
				$('select[name="idProducto"]').val(this.productos);
			});
		},
		regresar: function(){
			this.$emit('cerrar');
		},
		agregarProductoACotizacion(){
			
		},
		crearCotizacion: function(){
			var path = '/cotizacion';
			let formData = new FormData(document.getElementById('dataUpdate'));
			this.$http.post(path, formData).then(response => {
				if(response.ok){
					console.log(response.body);
					idCotizacion = response.body;
					$("#idCotizacion").val(idCotizacion);
				}
			});
		},
		sumit: function(){
			var path = '/cotizacion';
			let formData = new FormData(document.getElementById('dataUpdate'));
			this.$http.post(path, formData).then(response => {
				if(response.ok){
					this.$emit('cerrar');
				}
			});
		}
	},
	mounted: function(){
		this.loadData();
	},
	destroyed: function(){
		prodCount = 0;
	}
}
</script>

<style lang="css">

</style>
