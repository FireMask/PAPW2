<template>
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="box box-default box-add-edit">
                <form id="dataUpdate" class="login-form" method="POST">
                    <input type="hidden" name="_token" :value="csrf_token">
                    <input v-if="rol != null" name="_method" type="hidden" value="PUT">
                    <input v-if="rol != null" type="hidden" name="idRol" :value="rol.idRol">
                    <div class="form-group">
                        <label for="nombres">Nombre:</label>
                        <input required type="text" :value="nombre" class="form-control" id="nombre" name="nombre">
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
        props: ['rol'],
        computed: {
            csrf_token: function() {
                return store.state.globales.token;
            },
            textoBoton: function() {
                return this.rol != null ? 'Actualizar' : 'Agregar';
            },
            nombre: function(){
              return this.rol == null ? '' : this.rol.nombre;
            }
        },
        methods: {
            regresar: function(){
                this.$emit('cerrar');
            },
            sumit: function(){
                var path = this.rol == null ? '/rol' : '/rol/' + this.rol.idRol;
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
