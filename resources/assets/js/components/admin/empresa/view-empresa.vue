<template>
    <form id="dataUpdate" class="login-form" enctype="multipart/form-data" method="POST">
        <div class="row">
            <input type="hidden" name="_method" value="PUT">
            <input type="hidden" name="_token" :value="csrf_token">
            <input type="hidden" name="idEmpresa" :value="empresa.idEmpresa">
            <div class="col-md-4">
                <label for="logo">Logo:</label>
                <input required type="file" class="form-control input-lg" id="logo" name="logo">
            </div>
            <div class="col-md-8">
                <div class="form-group">
                    <label for="nombre">Nombre:</label>
                    <input required type="text" :value="empresa.nombre" class="form-control input-lg" id="nombre" name="nombre">
                </div>
                <div class="form-group">
                    <label for="propietario">Propietario:</label>
                    <input required type="text" :value="empresa.propietario" class="form-control input-lg" id="propietario" name="propietario">
                </div>
                <div class="form-group">
                    <label for="actividad_economica">Actividad Economica:</label>
                    <input type="text" :value="empresa.actividad_economica" class="form-control input-lg" id="actividad_economica" name="actividad_economica">
                </div>
                <div class="form-group">
                    <label for="numero_registro">Numero de Registro:</label>
                    <input required type="text" :value="empresa.numero_registro" class="form-control input-lg" id="numero_registro" name="numero_registro">
                </div>
                <div class="form-group">
                    <label for="direccion">Dirección:</label>
                    <input required type="text" :value="empresa.direccion" class="form-control input-lg" id="direccion" name="direccion">
                </div>
				<div class="form-group">
                    <label for="iva">Impuesto al Valor Agregado:</label>
                    <input required type="text" :value="empresa.iva" class="form-control input-lg" id="iva" name="iva">
                </div>
				<div class="form-group">
                    <label for="telefono">Teléfono:</label>
                    <input required type="text" :value="empresa.telefono" class="form-control input-lg" id="telefono" name="telefono">
                </div>
				<div class="form-group">
					<label for="correoPrincipal">Correo:</label>
					<input required type="email" :value="empresa.correo_principal" class="form-control input-lg" id="correoPrincipal" name="correo_principal">
				</div>
                <div class="form-group">
                    <label for="moneda">Moneda por Defecto:</label>
                    <select class="form-control input-lg" id="moneda" name="idMoneda">
                        <option v-for="moneda in monedas" :value="moneda.idMoneda">{{ moneda.nombre }}</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group">
                <div class="col-xs-2 col-xs-offset-10" align="center">
                    <button type="button" v-on:click="sumit()" class="btn-lg btn-primary">Acutalizar</button>
                </div>
            </div>
        </div>
    </form>
</template>

<script>
    var store = require('./../../../store/store.js');
    export default {
        data: function() {
            return {
                monedas: []
            };
        },
        computed: {
            csrf_token: function() {
                return store.state.globales.token;
            }
        },
        methods: {
            obtenerMonedas: function() {
                this.$http.get('/moneda/').then(response => {
                    this.monedas = response.body;
                    $('select[name="idMoneda"]').val(this.empresa.idMoneda);
                });
            },
            sumit: function(){
                var path = this.empresa == null ? '/empresa' : '/empresa/' + this.empresa.idEmpresa;
                let formData = new FormData(document.getElementById('dataUpdate'));
                this.$http.post(path, formData).then(response => {
                    if(response.ok){
                       this.$emit('cerrar');
                    }
                });
            }
        },
        mounted: function() {
            $("#logo").fileinput({
                showUpload: false,
                maxFileCount: 1,
                showCaption: false
            });
            this.obtenerMonedas();
        },
        props: ['empresa']
    }
</script>
