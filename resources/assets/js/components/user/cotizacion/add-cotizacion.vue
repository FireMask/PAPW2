<template lang="html">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<form id="dataUpdate" class="login-form" method="POST">
				<input type="hidden" name="_token" :value="csrf_token">
                <input type="hidden" name="idUsuario" :value="usuario.idUsuario">
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
								<option value="0">5 días</option>
								<option value="1">10 días</option>
								<option value="2">15 días</option>
								<option value="3">30 días</option>
								<option value="4">60 días</option>
							</select>
		                </div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
		                    <label for="codigo">Pago:</label>
		                    <input required type="text" class="form-control" id="pago" name="pago">
		                </div>
					</div>
				</div>
				<div class="col-md-12">
                    <div class="col-md-6" align="left">
                        <a class="btn btn-default" v-on:click="regresar()">
                            <i class="fa fa-arrow-left"></i> Regresar
                        </a>
                    </div>
                    <div class="col-md-6" align="right">
                        <button type="button" v-on:click="sumit()" class="btn btn-primary">{{ textoBoton }}</button>
                    </div>
                </div>
			</form>
		</div>
	</div>
</template>

<script>
var store = require('./../../../store/store.js');
export default {
	data() {
		return {
			clientes:[],
			monedas:[]
		};
	},
	props:['cliente'],
	computed:{
		csrf_token: function() {
			return store.state.globales.token;
		},
		textoBoton: function() {
			return this.cliente == null ? 'Actualizar' : 'Agregar';
		}
	},
	methods:{
		loadData: function(){
			this.$http.get('/monedas_clientes/').then(response => {
				this.monedas = response.body.monedas;
				this.clientes = response.body.clientes;
				$('select[name="idMoneda"]').val(this.monedas);
				$('select[name="idCliente"]').val(this.clientes);
			});
		},
		regresar: function(){
			this.$emit('cerrar');
		},
		sumit: function(){
			var path = this.cliente == null ? '/cliente' : '/cliente/' + this.cliente.idCliente;
			let formData = new FormData(document.getElementById('dataUpdate'));
			console.log(formData);
			this.$http.post(path, formData).then(response => {
				if(response.ok){
					this.$emit('cerrar');
				}
			});
		},
		mounted: function(){
			console.log("asd");
		}
	}
}
</script>

<style lang="css">

</style>
