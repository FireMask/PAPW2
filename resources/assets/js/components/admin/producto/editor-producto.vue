<template>
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <form id="dataUpdate" class="login-form" method="POST">
                <input type="hidden" name="_token" :value="csrf_token">
                <input v-if="producto != null" name="_method" type="hidden" value="PUT">
                <input v-if="producto != null" type="hidden" name="idProducto" :value="producto.idProducto">
                <div class="form-group">
                    <label for="codigo">Código:</label>
                    <input required type="text" class="form-control" id="codigo" name="codigo" :value="codigo">
                </div>
                <div class="form-group">
                    <label for="modelo">Modelo:</label>
                    <input required type="text" class="form-control" id="modelo" name="modelo" :value="modelo">
                </div>
                <div class="form-group">
                    <label for="descripcion">Descripción:</label>
                    <input required type="text" class="form-control" id="descripcion" name="descripcion" :value="descripcion">
                </div>
                <div class="form-group">
                    <label for="fabricante">Fabricante:</label>
                    <select required class="form-control input-lg" id="fabricante" name="idFabricante">
                        <option v-for="fabricante in fabricantes" :value="fabricante.idFabricante">{{ fabricante.nombre }}</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="proveedor">Proveedor:</label>
                    <select required class="form-control input-lg" id="proveedor" name="idProveedor">
                        <option v-for="proveedor in proveedores" :value="proveedor.idProveedor">{{ proveedor.nombre }}</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="precio">Precio:</label>
                    <input required type="text" class="form-control" id="precio" name="precio" :value="precio">
                </div>
                <div class="row">
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
                fabricantes:[],
                proveedores:[]
            };
        },
        props:[
            'usuario'
        ],
        computed:{
            csrf_token: function() {
                return store.state.globales.token;
            },
            textoBoton: function() {
                return this.producto != null ? 'Actualizar' : 'Agregar';
            },
            codigo:function(){
              return this.producto == null ? ' ' : this.producto.codigo;
            },
            modelo:function(){
              return this.producto == null ? ' ' : this.producto.modelo;
            },
            descripcion:function(){
              return this.producto == null ? ' ' : this.producto.descripcion;
            },
            fabricante:function(){
              return this.producto == null ? 0 : this.producto.idFabricante;
            },
            proveedor:function(){
              return this.producto == null ? 0 : this.producto.idProveedor;
            },
            precio:function(){
                return this.producto == null ? ' ' : this.producto.precio;
            }
        },
        methods: {
            cambiarPagina: function(pagina) {
                store.commit('setPage', pagina);
            },
            loadData: function(){
                this.$http.get('/cliente/'+usuario.idUsuario+'/info_cotizacion').then(response => {
                    this.fabricantes = response.body.fabricantes;
                    this.proveedores = response.body.proveedores;
                    $('select[name="idFabricante"]').val(this.fabricante);
                    $('select[name="idProducto"]').val(this.proveedor);
                });
            },
            regresar: function(){
                this.$emit('lista')
            },
            sumit: function(){
                var path = this.producto == null ? '/producto' : '/producto/' + this.producto.idProducto;
                let formData = new FormData(document.getElementById('dataUpdate'));
                this.$http.post(path, formData).then(response => {
                    if(response.ok){
                       this.$emit('lista');
                    }
                });
            }
        },
        mounted: function(){
            this.loadData();
        }
    }
</script>
