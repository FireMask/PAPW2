<template lang="html">
	<div class="">
		<div class="">
			{{cliente.nombre}}
			<hr>
			{{cliente.nombre_comercial}}
			<hr>
			{{cliente.giro}}
			<hr>
			{{cliente.direccion}}
			<hr>
			{{cliente.codigo_postal}}
			<hr>
			{{cliente.pais}}
			<hr>
			{{cliente.estado}}
			<hr>
			{{cliente.municipio}}
			<hr>
			{{cliente.correo}}
			<hr>
			{{cliente.telefono_empresa}}
			<hr>
			{{cliente.telefono_personal}}
		</div>
		<div class="footer">
	  	  <a v-on:click="cerrar()" class="btn btn-primary btn-lg"><i class="fa fa-arrow-left"></i> Regresar</a>
	    </div>
	</div>
</template>

<script>
	export default {
		props: ['cliente'],
		methods:{
			cerrar: function() {
				this.$emit('cerrar');
			}
		}
	}
</script>

<style lang="css">

</style>
