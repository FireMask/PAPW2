<template>
    <div class="content">
        <div class="row">
            <div class="col-md-2 col-offset-10 cerrar">
                <a class="btn btn-default" href="#" v-on:click="cerrar()">
                    <i class="fa fa-arrow-left"></i> Volver
                </a>
            </div>
            <br>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="box box-primary">
                    <div class="box-body box-profile">
                        <h3 class="profile-username text-center">{{ proveedor.nombre_comercial }}</h3>
                        <p class="text-muted text-center">{{ proveedor.nombre }}</p>

                        <ul class="list-group list-group-unbordered">
                            <li class="list-group-item">
                                <b>Fecha de registro</b> <p class="pull-right text-muted">{{ proveedor.created_at | fecha }}</p>
                            </li>
                        </ul>

                        <a v-on:click="editar();" class="btn btn-primary btn-block">
                            <i class="fa fa-edit margin-r-5"></i>
                            <b>Editar</b>
                        </a>
                        <a v-on:click="showModal = true" class="btn btn-danger btn-block">
                            <i class="fa fa-close margin-r-5"></i>
                            <b>Eliminar</b>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Perfil</h3>
                    </div>
                    <div class="box-body">
                        <strong><i class="fa fa-shopping-basket margin-r-5"></i> Productos</strong>
                        <div class="content">
                            <view-producto v-for="producto in productos" :producto="producto"></view-producto>
                        </div>
                        <hr>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data: function() {
            return {
                productos: []
            }
        },
        props: ['proveedor'],
        filters: {
            fecha: function(value) {
                if (!value) return '';
                var fecha = value.split(' ');
                return fecha[0];
            }
        },
        methods: {
            loadData: function() {
                this.$http.get('/proveedor/' + this.proveedor.idProveedor + '/productos').then(response => {
                    this.productos = response.body;
                });
            },
            cerrar: function() {
                this.$emit('cerrar');
            },
            editar: function() {
                this.showModal = false;
                this.$emit('editar');
            },
            borrar: function() {
                this.showModal = false;
                var data = {
                    _method: 'DELETE'
                };
                this.$http.post('/proveedor/' + this.proveedor.idProveedor, data).then(response => {
                    this.cerrar();
                });
            }
        },
        mounted: function() {
            this.loadData();
        }
    }
</script>

<style>

</style>
