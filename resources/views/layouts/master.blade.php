<!DOCTYPE html>
<html>
<head>
    @section('headers')
    @show
</head>
<body class="hold-transition skin-purple sidebar-mini">
    <div id="App" class="wrapper">
        <barra-superior></barra-superior>
        <barra-lateral></barra-lateral>

        <div id="main-container" class="content-wrapper" style="min-height: 100vh;">
            <section class="content-header">
                <h1>@{{ actualPage | capitalize }}</h1>
            </section>
            <section class="content">
                <transition name="fade" mode="out-in">
                    <pantalla-usuario       v-if="actualPage === 'usuarios'"            :accion="accion"></pantalla-usuario>
                    <pantalla-cliente       v-else-if="actualPage === 'clientes'"       :accion="accion"></pantalla-cliente>
                    <pantalla-cotizacion    v-else-if="actualPage === 'cotizaciones'"   :accion="accion"></pantalla-cotizacion>
                    <pantalla-empresa       v-else-if="actualPage === 'empresa'"        :accion="accion"></pantalla-empresa>
                    <pantalla-fabricante    v-else-if="actualPage === 'fabricantes'"    :accion="accion"></pantalla-fabricante>
                    <pantalla-moneda        v-else-if="actualPage === 'monedas'"        :accion="accion"></pantalla-moneda>
                    <pantalla-producto      v-else-if="actualPage === 'productos'"      :accion="accion"></pantalla-producto>
                    <pantalla-proveedor     v-else-if="actualPage === 'proveedores'"    :accion="accion"></pantalla-proveedor>
                    <pantalla-rol           v-else-if="actualPage === 'roles'"          :accion="accion"></pantalla-rol>
                </transition>
            </section>
        </div>
    </div>
    @section('scripts')
    @show
</body>
</html>
