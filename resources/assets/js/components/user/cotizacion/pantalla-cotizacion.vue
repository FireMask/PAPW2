<template>
    <div class="content" id="pantallaCotizaciones">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-default box-add-edit">
                    <div id="pantallaCotizaciones">
                        <transition name="fade" mode="out-in">
                            <div class="" v-if="accion == 'opciones'">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="btn btn-default boton-principal" v-on:click="crear()">
                                            <img class="icon icons8-Add-List" width="64" height="64" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAYAAABXAvmHAAAChUlEQVRoQ+2XTWgTURDH/w+JDVVaQRARtK0gFUX0IHoRD1r8okgDXjy1AQ+eNDl51YvgLXotpfbuIdKLKXFFUBC9RGgFKTUp/aAWkTYHm1Zl5K2sbJYk2zf79st2L8vum3k7v5n/vEwEYn6JmMeP/x8g936d/KgSER5kz7bd97q3awX8ANiTFFipEXRAhALQfzSBN5VfWiBCAUgdT2DjN/BWA0RoAFL7OiBCBdABETqAV4hIAHiBiAwAFyJSAByIyAE4ITJn2lrGGAqAyviwDeDHLLRdAVsGtm4PPHr22czDvRu95t16VpGH3dbax+nvWxPHHoCbaVU/3yqgGgjX3jeA2Eso9gBcSaj6+SYh1UC49r4B6JBQR3sC547txYnuzqZ8kQU4cmA3rp3ej+TOHWbwcytFfPsxhWrtC6q1svmuI9mD1Vr5KQnkXw0WnjeiDH2UWKq+w+TyCNY2vrZUGQEVQZR9mZ7I2w1DBZhcGkb5+7hSexAoZwxNZC0nNgCnB6Tm031dpmw4wVtBE+GxkS5k5HOgAFLzsmGlbD7MP2yY+eLgi7r3fWNXGleIKCXlxAZQqrvDuDh9C2s/lz0ByJ4whgo9gQPI06a0+KQp/6YrIHcgSrEBVHvg5vmDOLSvHaWFHOZWDV0AY4EB3L56GJ27Eng9cwfV9co/AGfG3aRZ3xNUYgO4fajZ+vin63VL3gA8nEJbFkCnhIjoY+ASikwTcyUUmWOUCyD9tPyQEWaNdKE7cAlJgNiPEhIisGHOi1TcfC+MXs4JgbtudvZ1+yS6qWlUZXOO7cXRSwMEIUG6WvkTYVaAMsp/aDhBcXwkCIABAk4JIU7+ndXMc74EIO8M3PrGH6hrFBCszOLMAAAAAElFTkSuQmCC">
                                            <label for="">Agregar</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="btn btn-default boton-principal" v-on:click="lista()">
                                            <img class="icon icons8-Page-Overview-4" width="64" height="64" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACgAAAAoCAYAAACM/rhtAAABOUlEQVRYR+2XMRKCMBBFN1hntMBabyAnULiJhRbiJfQGNtjgXcCTmF467ONooWMCw8JmHByXktlkf94mPxsBPf9Ez/UBC6RW6DcJjte5Nld+TcPXYqbJLQChh1Q65ngVy7P5r5Jgo8BjmQuAhWuBl1haelhgG8ruCD72oKdHbZJjYtVG5qg9iJnsWzG/aTPfooPJU0nQX2c5aPHhhcUpjDATuo7pZjNJeQABM9diVCwtCN0EslG/a9ONYHJbAuip8xJv5Q7lg/4qC83A4hRZJupaYNV87INUytU++CixGHz6YDq3ejVqcsz47ofE0xNMgjYxaiP3qEPCDWsNVof94POqC9qUDxOrYmnZW32zYMxYpJE1GJOUGsM++J8EG22GH+7UdosbVipBfrg3EKR6l8vxfJNQafae4B3P9qkpoiZh9wAAAABJRU5ErkJggg==">
                                            <label for="">Lista</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="btn btn-default boton-principal" v-on:click="editar()">
                                            <img class="icon icons8-Edit-File" width="64" height="64" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAYAAABXAvmHAAACcklEQVRoQ+3YP2gTURwH8O/lSJNSiVew1ILUwViF1mAXxT9DsohDl+DoUOoiDpV0FkQHp4Johw5OziroIIqIZLFLlxgphUrEiKAOgZ6RNsmll5+8q1fOmPYuuYv3i9yNl7uX7+e937t77yT0+CH1eH78/4B7yzXqxigR4fbc6cgtt23bjkA3AEpUgloleIHwBTB1PIy3xS1PEL4A0uNhaDqw5AHCN4CofS8QvgK8QPgOcItgAXCDYAPoFMEK0AmCHaAZkTkV2TOjL4B2lg8BoBtroWAELD0QzIF2yqGTa4NJHEziTurGck9QQkEJBSW0vZhbz2SUTVnOgkghWU4fmp9/J873xIvsaTanTL569Dxc186J0ESkQpZTAsEecHhjdVCizWxI1/sTb16OhOtazIpgDQiRjtGNnCiVkyJ0SNfXrAgQFdkCIrqKSx8uYGVobqkcPWqUTjOCiPIsAWb4oUreCJ0dfdgKUdpfrUyxAzSHN3veiiBQHtJAMp2aVFkBdgtvRfyIxveZ4Vk9Ru3C/0bknx3LGT1voliMgNPwiCApzWAnPIsRcBPed4Db8L4CnIQv9SdwoPF+sLlsrOtDX+aA0/BPxl7j2plhXl/m2glfkxWw2pG1G16UCivA+coNnCg8QF+93HKbI2pelI3oefNgBbhSncBWow8DH7/8hWgVntUIxBpFzNQSRseuU/wPxG7hPQG43NLu3H7/5sTCxfHvs2MHf26f02kNBW0EDXxq9YZ1+r+2j1GnDdldN3v1bGH1m3Jk8fIyDAThM2r0GF+1O3s95+3a/WeA6emkGotqpfhw+cX11MpdKYWiXTgnv/8C5Gr/XStBxVoAAAAASUVORK5CYII=">
                                            <label for="">Editar</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <detalle-cotizacion-user
                                v-on:cerrar="lista()"
                                v-on:editar="editar()"
                                v-if="accion == 'perfil'"
                                :cotizacion="seleccionado"
                            ></detalle-cotizacion-user>
                            <lista-cotizacion-user
                                v-on:seleccionado="seleccionar"
                                v-on:cerrar="accion = 'opciones'"
                                v-on:crear="crear()"
                                v-if="accion == 'buscar'"
                                :idUser="usuarioid"
                            ></lista-cotizacion-user>
                            <add-cotizacion-user
                                v-if="accion == 'crear'"
                                v-on:cerrar="opciones()"
                            ></add-cotizacion-user>
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
                accion: 'opciones'
            };
        },
        computed:{
            idUsuario: function(){
                return this.idUsuario;
            }
        },
        props: ['usuarioid'],
        methods: {
            seleccionar: function(seleccion) {
                this.seleccionado = seleccion;
                this.accion = 'perfil';
            },
            opciones: function(){
                this.accion = 'opciones';
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
        }
    }
</script>

<style>
    @media screen and (max-width: 700px) {
        #pantallaCotizaciones div.box-add-edit{
            padding: 0;
        }
    }
    .fade-enter-active, .fade-leave-active {
        transition: opacity .3s ease;
    }
    .fade-enter, .fade-leave-to {
        opacity: 0
    }
    .boton-princial{
        color: #454545;
    }
</style>
