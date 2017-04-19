<template>
    <div class="content" id="pantallaEmpresa">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-default box-add-edit">
                    <div id="pantallaEmpresa">
                        <transition name="fade" mode="out-in">
                            <view-empresa
                                :empresa="empresa"
                                v-if="empresa != null"
                            ></view-empresa>
                        </transition>
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
                seleccionado: null,
                accion: 'buscar',
                empresa: null
            };
        },
        methods: {
            loadData: function () {
                this.$http.get('/api/empresa/').then(response => {
                    this.empresa = response.body[0];
                });
            },
            seleccionado: function(seleccion) {
                this.seleccionado = seleccion;
                this.accion = 'perfil';
            },
            crear: function() {
                this.accion = 'crear';
            },
            editar: function() {
                this.accion = 'editar';
            },
            lista: function() {
                this.seleccionado = null;
                this.accion = 'buscar';
            }
        },
        mounted: function () {
            this.loadData();
        }
    }
</script>

<style>
    .fade-enter-active, .fade-leave-active {
        transition: opacity .3s ease;
    }
    .fade-enter, .fade-leave-to {
        opacity: 0
    }
</style>
