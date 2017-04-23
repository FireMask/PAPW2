<template>
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="box box-default box-add-edit">
                <form id="dataUpdate" class="login-form" method="POST">
                    <input type="hidden" name="_token" :value="csrf_token">
                    <input v-if="moneda != null" name="_method" type="hidden" value="PUT">
                    <input v-if="moneda != null" type="hidden" name="idMoneda" :value="moneda.idMoneda">
                    <div class="form-group">
                        <label for="nombre">Nombre:</label>
                        <input required type="text" :value="nombre" class="form-control" id="nombre" name="nombre">
                    </div>
                    <div class="form-group">
                        <label for="simbolo">Simbolo:</label>
                        <input required type="text" :value="simbolo" class="form-control" id="simbolo" name="simbolo">
                    </div>
                    <div class="form-group">
                        <label for="presicion">Presicion:</label>
                        <input type="text" :value="presicion" class="form-control" id="presicion" name="presicion">
                    </div>
                    <div class="form-group">
                        <label for="separador_millares">Separador de Millares:</label>
                        <input required type="text" :value="separadorMillares" class="form-control" id="separador_millares" name="separador_millares">
                    </div>
                    <div class="form-group">
                        <label for="separador_decimales">Separador de Decimales:</label>
                        <input required type="text" :value="separadorDecimales" class="form-control" id="separador_decimales" name="separador_decimales">
                    </div>
                    <div class="row">
                        <div class="col-md-6" align="left">
                            <a class="btn btn-default" href="#" v-on:click="regresar()">
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
    </div>
</template>

<script>
    var store = require('./../../../store/store.js');
    export default {
        data: function() {
            return {

            }
        },
        props: ['moneda'],
        computed: {
            csrf_token: function() {
                return store.state.globales.token;
            },
            textoBoton: function() {
                return this.moneda != null ? 'Actualizar' : 'Agregar';
            },
            nombre:function(){
              return this.moneda == null ? '' : this.moneda.nombre;
            },
            simbolo:function(){
              return this.moneda == null ? '' : this.moneda.simbolo;
            },
            presicion:function(){
              return this.moneda == null ? '' : this.moneda.presicion;
            },
            separadorDecimales:function(){
              return this.moneda == null ? '' : this.moneda.separador_decimales;
            },
            separadorMillares:function(){
              return this.moneda == null ? '' : this.moneda.separador_millares;
            }
        },
        methods: {
            regresar: function(){
                this.$emit('cerrar');
            },
            sumit: function(){
                var path = this.moneda == null ? '/moneda' : '/moneda/' + this.moneda.idMoneda;
                let formData = new FormData(document.getElementById('dataUpdate'));
                this.$http.post(path, formData).then(response => {
                    if(response.ok){
                       this.$emit('cerrar');
                    }
                });
            }
        }
    }
</script>

<style>

</style>
