<template>
    <div class="content">
        <div align="right">
            <a class="btn btn-app" href="#" v-on:click="crear()">
                <i class="fa fa-plus"></i> Agregar
            </a>
        </div>
        <div class="row">
            <form class="form-horizontal col-md-6">
                <div class="form-group">
                    <label class="control-label col-sm-2" for="correo">Buscar:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" v-on:keyup="mostrarPagina();" v-model="busqueda">
                    </div>
                </div>
            </form>
        </div>
        <div class="row">
            <transition-group name="translate-fade" tag="div" method="out-in">
                <div :key="usuario.idUsuario" v-for="usuario in usuariosMostrados" class="col-md-12" v-on:click="seleccionarUsuario(usuario);">
                    <view-usuario :data="usuario"></view-usuario>
                </div>
            </transition-group>
        </div>
        <div class="row" id="navegador-paginas">
            <div class="col-xs-2" align="center">
                <button style="min-width: 15%;" class="btn btn-app" v-on:click="paginaAnterior();">
                    <i class="fa fa-arrow-left"></i>
                </button>
            </div>
            <div class="col-xs-8" align="center">
                <button style="min-width: 15%;" v-for="n in fin" class="btn btn-app" v-bind:class="{ disabled: (n + inicio -1 == paginaActual) }" v-on:click="pagina(n + inicio - 1);" align="center">
                    <span class="numeroPaginado">{{ n + inicio }}</span>
                </button>
            </div>
            <div class="col-xs-2" align="center">
                <button style="min-width: 15%;" class="btn btn-app" v-on:click="paginaSiguiente();">
                    <i class="fa fa-arrow-right"></i>
                </button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data () {
            return {
                usuarios: [],
				usuariosMostrados: [],
				paginaActual: 0,
				indiceCentral: 0,
				datosPorPagina: 8,
				busqueda: '',
				usuarioSeleccionado: null
            };
        },
        computed: {
            usuariosFiltrados: function () {
                var self = this;
                this.busqueda = this.busqueda.trim().toLowerCase();

                if(this.busqueda == ''){
                    return this.usuarios;
                }

                var usuarios = this.usuarios.filter(function(item){
                    return item.nombres.toLowerCase().indexOf(self.busqueda) !== -1 || item.apellido_paterno.toLowerCase().indexOf(self.busqueda) !== -1 || item.apellido_materno.toLowerCase().indexOf(self.busqueda) !== -1;
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
                this.$http.get('/api/usuarios/').then(response => {
                    this.usuarios = response.body;
                    this.mostrarPagina();
                });
            },
            seleccionarUsuario: function(seleccion) {
                this.$emit('usuario', seleccion);
            },
            crear: function() {
                this.$emit('crear');
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
        }
    }
</script>

<style media="screen">
    #navegador-paginas .btn-app {
        margin: 0px 2% 10px 2%;
    }
    #navegador-paginas > div {
        padding-left: 0;
        padding-right: 0;
    }
    .numeroPaginado {
        font-size: 14px;
        font-weight: bold;
    }
    .translate-fade-enter-active, .no-mode-translate-fade-leave-active {
      transition: all 1s;
    }
    .translate-fade-enter, .no-mode-translate-fade-leave-active {
      opacity: 0;
    }
    .translate-fade-enter {
      transform: translateX(10vw);
    }
    .translate-fade-leave-active {
      transform: translateX(-10vw);
    }
</style>
