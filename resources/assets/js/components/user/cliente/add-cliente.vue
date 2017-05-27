<template lang="html">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<form id="dataUpdate" class="login-form" method="POST">
				<input type="hidden" name="_token" :value="csrf_token">
                <input v-if="cliente != null" name="_method" type="hidden" value="PUT">
                <input v-if="cliente != null" type="hidden" name="idCliente" :value="cliente.idCliente">
				<input type="hidden" name="idUsuario" :value="idUser">
				<div class="form-group">
                    <label for="codigo">Nombre:</label>
                    <input required type="text" class="form-control" id="nombre" name="nombre" :value="nombre_cliente">
                </div>
				<div class="form-group">
                    <label for="codigo">Nombre Comercial:</label>
                    <input required type="text" class="form-control" id="nombre_comercial" name="nombre_comercial" :value="nombre_comercial">
                </div>
				<div class="form-group">
                    <label for="codigo">Giro:</label>
                    <input required type="text" class="form-control" id="giro" name="giro" :value="giro">
                </div>
				<div class="form-group">
                    <label for="codigo">Dirección:</label>
                    <input required type="text" class="form-control" id="direccion" name="direccion" :value="direccion">
                </div>
				<div class="form-group">
                    <label for="codigo">Código Postal:</label>
                    <input required type="text" class="form-control" id="codigo_postal" name="codigo_postal" :value="codigo_postal">
                </div>
				<div class="form-group">
                    <label for="codigo">País:</label>
                    <input required type="text" class="form-control" id="pais" name="pais" :value="pais">
                </div>
				<div class="form-group">
                    <label for="codigo">Estado:</label>
                    <input required type="text" class="form-control" id="estado" name="estado" :value="estado">
                </div>
				<div class="form-group">
                    <label for="codigo">Municipio:</label>
                    <input required type="text" class="form-control" id="municipio" name="municipio" :value="municipio">
                </div>
				<div class="form-group">
                    <label for="codigo">Correo:</label>
                    <input required type="text" class="form-control" id="correo" name="correo" :value="correo">
                </div>
				<div class="form-group">
                    <label for="codigo">Teléfono de la Empresa:</label>
                    <input required type="text" class="form-control" id="telefono_empresa" name="telefono_empresa" :value="telefono_empresa">
                </div>
				<div class="form-group">
                    <label for="codigo">Teléfono de Personal:</label>
                    <input required type="text" class="form-control" id="telefono_personal" name="telefono_personal" :value="telefono_personal">
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
	props:[
		'cliente',
		'idUser'
	],
	computed:{
		csrf_token: function() {
			return store.state.globales.token;
		},
		textoBoton: function() {
			return this.cliente != null ? 'Actualizar' : 'Agregar';
		},
		nombre_cliente: function(){
			return this.cliente == null ? '' : this.cliente.nombre;
		},
		nombre_comercial: function(){
			return this.cliente == null ? '' : this.cliente.nombre_comercial;
		},
		giro: function(){
			return this.cliente == null ? '' : this.cliente.giro;
		},
		direccion: function(){
			return this.cliente == null ? '' : this.cliente.direccion;
		},
		codigo_postal: function(){
			return this.cliente == null ? '' : this.cliente.codigo_postal;
		},
		pais: function(){
			return this.cliente == null ? '' : this.cliente.pais;
		},
		estado: function(){
			return this.cliente == null ? '' : this.cliente.estado;
		},
		municipio: function(){
			return this.cliente == null ? '' : this.cliente.municipio;
		},
		correo: function(){
			return this.cliente == null ? '' : this.cliente.correo;
		},
		telefono_empresa: function(){
			return this.cliente == null ? '' : this.cliente.telefono_empresa;
		},
		telefono_personal: function(){
			return this.cliente == null ? '' : this.cliente.telefono_personal;
		}
	},
	methods:{
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
