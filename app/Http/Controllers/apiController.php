<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Cotizacion;
use App\Models\Usuario;
use App\Models\Rol;
use App\Models\UsuarioCliente;
use App\Models\Empresa;
use App\Models\Fabricante;
use App\Models\TipoDeMoneda;
use App\Models\Producto;
use App\Models\Proveedor;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class apiController extends Controller
{
    public function getFabProd(){
        $fabricantes = Fabricante::all();
        $proveedores = Proveedor::all();
        return array(
            'fabricantes' => $fabricantes,
            'proveedores' => $proveedores
        );
    }

    public function estadisticasEmpresa() {
        $ventas = Cotizacion::where('finalizada', '=', '1')
            ->select('updated_at')
            ->selectRaw('YEAR(IF(updated_at is null, updated_at, updated_at)) as ano')
            ->selectRaw('MONTH(IF(updated_at is null, updated_at, updated_at)) as mes')
            ->selectRaw('COUNT(*) as ventas')
            ->groupBy(DB::raw('YEAR(IF(updated_at is null, updated_at, updated_at))'))
            ->groupBy(DB::raw('MONTH(IF(updated_at is null, updated_at, updated_at))'))
            ->having('updated_at', '>', DB::raw('DATE_SUB(now(), INTERVAL 6 MONTH)'))
            ->orderBy('ano')
            ->orderBy('mes', 'desc')
            ->get();

        $cotizaciones = Cotizacion::select('created_at')
            ->selectRaw('YEAR(created_at) as ano')
            ->selectRaw('MONTH(created_at) as mes')
            ->selectRaw('COUNT(*) as cotizaciones')
            ->groupBy(DB::raw('YEAR(created_at)'))
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->having('created_at', '>', DB::raw('DATE_SUB(now(), INTERVAL 6 MONTH)'))
            ->orderBy('ano')
            ->orderBy('mes', 'desc')
            ->get();

        $totalVentas = Cotizacion::selectRaw('COUNT(*) as ventas')
            ->where('finalizada', '=', '1')
            ->get();

        $totalCotizaciones = Cotizacion::selectRaw('COUNT(*) as cotizaciones')->get();

        $porcentajeExitoAnterior = 0;
        $ventasAnteriores = 0;
        $cotizacionesAnteriores = 0;
        // if (array_key_exists(1,$ventas)) {
            $ventasAnteriores = $ventas[1]->ventas;
        // }
        // if (array_key_exists(1,$cotizaciones)) {
            $cotizacionesAnteriores = $cotizaciones[1]->cotizaciones;
        // }
        $porcentajeExitoAnterior = ($ventasAnteriores / ($cotizacionesAnteriores == 0 ? 1 : $cotizacionesAnteriores)) * 100;
        $porcentajeExitoActual = ($ventas[0]->ventas / $cotizaciones[0]->cotizaciones) * 100;
        $progresoMensual = ($porcentajeExitoAnterior == 0 ? 100 : ($porcentajeExitoAnterior / 100) * ($porcentajeExitoActual - $porcentajeExitoAnterior));

        $mejoresVendedores = Usuario::join('cotizacion', 'usuario.idUsuario', '=', 'cotizacion.idUsuario')
            ->join(DB::raw('
                (select count(sc.idCotizacion) cotizaciones, su.idUsuario
		        from cotizacion sc join usuario su on su.idUsuario = sc.idUsuario
		        group by su.idUsuario) as total
            '), function($join) {
                $join->on("total.idUsuario","=","usuario.idUsuario");
            })
            ->select('usuario.nombres','usuario.apellido_paterno','usuario.apellido_materno','imagen_perfil')
            ->selectRaw('COUNT(cotizacion.idCotizacion) as ventas, total.cotizaciones, CAST(COUNT(cotizacion.idCotizacion) / total.cotizaciones * 100 AS UNSIGNED) as promedio')
            ->where('cotizacion.finalizada', '=', '1')
            ->groupBy(DB::raw('usuario.idUsuario'))
            ->orderBy('promedio', 'desc')
            ->orderBy('ventas', 'desc')
            ->limit(3)
            ->get();

        $eventosClientes = DB::table('cliente')
            ->join('usuario_cliente','usuario_cliente.idCliente','=','cliente.idCliente')
            ->join('usuario','usuario_cliente.idUsuario','=','usuario.idUsuario')
            ->selectRaw('
                cliente.created_at as fecha,
                "nuevo cliente" as evento,
                concat("Agregado por ", usuario.nombres, " ", usuario.apellido_paterno) as descripcion,
                cliente.nombre_comercial as responsable'
            )
            ->orderBy('cliente.created_at', 'desc')
            ->limit(10);
        $eventosUsuario = DB::table('usuario')
            ->join('rol','rol.idRol','=','usuario.idRol')
            ->selectRaw('
                usuario.created_at as fecha,
                "nuevo usuario" as evento,
                concat("Se unio al equipo de ", rol.nombre) as descripcion, concat(usuario.nombres, " ", usuario.apellido_paterno, " ", usuario.apellido_materno) as responsable'
            )
            ->orderBy('usuario.created_at', 'desc')
            ->limit(10);
        $actividadReciente = DB::table('cotizacion')
            ->join('usuario','cotizacion.idUsuario','=','usuario.idUsuario')
            ->join('cliente','cotizacion.idCliente','=','cliente.idCliente')
            ->selectRaw('
                IF(cotizacion.finalizada = 0 and cotizacion.aprobada = 0, cotizacion.created_at, cotizacion.updated_at) as fecha,
                IF(cotizacion.finalizada = 0 and cotizacion.aprobada = 0, "nueva cotizacion", IF(cotizacion.finalizada = 1, "venta finalizada", "cotizacion aprobada")) as evento,
                IF(cotizacion.finalizada = 0 and cotizacion.aprobada = 0,
                    concat(usuario.nombres, " ", usuario.apellido_paterno, " envio una cotizacion al cliente ", cliente.nombre_comercial),
                    IF(cotizacion.finalizada = 1,
                        concat("Finalizo la venta con id ", cotizacion.idCotizacion, " al cliente ", cliente.nombre_comercial),
                        concat("Se aprovo la cotizacion con id ", cotizacion.idCotizacion, " con pago de tipo ", cotizacion.pago, " al cliente ", cliente.nombre_comercial)
                    )
                ) as descripcion,
                concat(usuario.nombres, " ", usuario.apellido_paterno) as responsable'
            )
            ->limit(10)
            ->unionAll($eventosUsuario)
            ->unionAll($eventosClientes)
            ->orderBy('fecha', 'desc')
            ->limit(30)
            ->get();

        $estadisticas = array(
            'ventas' => $ventas,
            'cotizaciones' => $cotizaciones,
            'progresoMensual' => $progresoMensual,
            'exitoAnterior' => $porcentajeExitoAnterior,
            'exitoActual' => $porcentajeExitoActual,
            'porcentajeExito' => ($totalVentas[0]->ventas / $totalCotizaciones[0]->cotizaciones) * 100,
            'mejoresVendedores' => $mejoresVendedores,
            'actividadReciente' => $actividadReciente
        );

        return $estadisticas;
    }

    public function getPaginationData() {
        $count = DB::table('usuario')->count();
        return $count;
    }

    public function getUsers(){
		$usuarios = Usuario::with('rol')->get();
        return $usuarios;
	}

    function getUserInfo($id) {
        $ventas = $this->getVentas($id);
        $cotizaciones = $this->getCotizacionesTabla($id);

        $porcentajeExitoAnterior = 0;
        $ventasAnteriores = 0;
        $cotizacionesAnteriores = 0;
        // if (array_key_exists(1,$ventas)) {
            $ventasAnteriores = $ventas[1]->ventas;
        // }
        // if (array_key_exists(1,$cotizaciones)) {
            $cotizacionesAnteriores = $cotizaciones[1]->cotizaciones;
        // }
        $porcentajeExitoAnterior = ($ventasAnteriores / ($cotizacionesAnteriores == 0 ? 1 : $cotizacionesAnteriores)) * 100;
        $porcentajeExitoActual = ($ventas[0]->ventas / $cotizaciones[0]->cotizaciones) * 100;
        $progresoMensual = ($porcentajeExitoAnterior == 0 ? 100 : ($porcentajeExitoAnterior / 100) * ($porcentajeExitoActual - $porcentajeExitoAnterior));

        return array(
            'ventasTotales' => $this->getCountVentasTotales($id),
            'promedioMensualAnterior' => $porcentajeExitoAnterior,
            'promedioMensual' => $porcentajeExitoActual,
            'progresoMensual' => $progresoMensual,
            'clientes' => $this->getUserClients($id),
            'ventas' => $ventas,
            'cotizaciones' => $cotizaciones
        );
    }

	public function getUserStadistics($id){
		$promedioMensual = $this->getPromedioVentasMensuales($id);
		$ventasTotales = $this->getVentasTotales($id);
		$ventasDelMes = $this->getVentasDelMes($id);
		return response()->json([
			'ventasDelMes' => $ventasDelMes,
			'promedioMensual' => $promedioMensual,
			'ventasTotales' => $ventasTotales
		]);
	}

	public function getUserClients($id){
		$clientes = Cliente::join('usuario_cliente','usuario_cliente.idCliente','=','cliente.idCliente')
            ->where('idUsuario', '=', $id)
            ->select('cliente.*')
            ->get();
		return $clientes;
	}

	public function getUserSells($id){
		$ventas = $this->getVentas($id);
		return $ventas;
	}

	public function getUserCotizations($id){
		$cotizaciones = $this->getCotizaciones($id);
		return $cotizaciones;
	}

    function getPromedioVentasMensuales($id){
        $ventasMensuales = Cotizacion::select(DB::raw('MONTH(created_at) mes, COUNT(*) ventasMensuales'))
            ->where('idUsuario', '=', $id)
            ->where('finalizada', '=', 1)
            ->groupBy(DB::raw('YEAR(created_at)'))
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->get();

        $sumVentas = 0;
        $promedioMensual = 0;
        if(count($ventasMensuales) > 0) {
            foreach($ventasMensuales as $ventaDelMes)
                $sumVentas += $ventaDelMes['ventasMensuales'];
            $promedioMensual = $sumVentas / count($ventasMensuales);
        }

        return $promedioMensual;
    }

    function getCountVentasTotales($id){
        return Cotizacion::where('idUsuario', '=', $id)
            ->where('finalizada', '=', 1)
            ->count();
    }

    function getVentasTotales($id){
        return Cotizacion::where('idUsuario', '=', $id)
            ->where('finalizada', '=', 1)
            ->count();
    }

    function getVentasDelMes($id){
        $ventas = Cotizacion::where('idUsuario', '=',$id)
            ->where('finalizada', '=', '1')
            ->selectRaw('MONTH(IF(updated_at is null, created_at, updated_at)) mes, YEAR(IF(updated_at is null, created_at, updated_at)) ano, COUNT(*) ventas')
            ->groupBy(DB::raw('YEAR(IF(updated_at is null, created_at, updated_at)), MONTH(IF(updated_at is null, created_at, updated_at))'))
            ->havingRaw('ano = YEAR(CURDATE()) and mes = MONTH(CURDATE())')
            ->get();
        return (sizeof($ventas) > 0 ? $ventas[0]->ventas : 0);
    }

    function getClientes($id){
        return UsuarioCliente::with('cliente')
            ->where('idUsuario', '=', $id)
            ->count();//count en vez de get, tarda un chingo
    }

    function getVentas($id){
        return Cotizacion::where('idUsuario', '=', $id)
            ->where('finalizada', '=', '1')
            ->select('updated_at')
            ->selectRaw('YEAR(IF(updated_at is null, updated_at, updated_at)) as ano')
            ->selectRaw('MONTH(IF(updated_at is null, updated_at, updated_at)) as mes')
            ->selectRaw('COUNT(*) as ventas')
            ->groupBy(DB::raw('YEAR(IF(updated_at is null, updated_at, updated_at))'))
            ->groupBy(DB::raw('MONTH(IF(updated_at is null, updated_at, updated_at))'))
            ->having('updated_at', '>', DB::raw('DATE_SUB(now(), INTERVAL 6 MONTH)'))
            ->orderBy('ano', 'desc')
            ->orderBy('mes', 'desc')
            ->get();
    }

    function getCotizacionesTabla($id){
        return Cotizacion::where('idUsuario', '=', $id)
            ->select('created_at')
            ->selectRaw('YEAR(created_at) as ano')
            ->selectRaw('MONTH(created_at) as mes')
            ->selectRaw('COUNT(*) as cotizaciones')
            ->groupBy(DB::raw('YEAR(created_at)'))
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->having('created_at', '>', DB::raw('DATE_SUB(now(), INTERVAL 6 MONTH)'))
            ->orderBy('ano', 'desc')
            ->orderBy('mes', 'desc')
            ->get();
    }

    function getCountCotizaciones($id){
        return Cotizacion::where('idUsuario', '=', $id)
            ->count();
    }

    function getCotizacionesFromUser($id){
        return Cotizacion::where('idUsuario', '=', $id)
            ->get();
    }

    function getRoles() {
        return Rol::get();
    }

    function getClients() {
        return Cliente::get();
    }

    function getCotizaciones() {
        return Cotizacion::with(['usuario','moneda','cliente'])->get();
    }

    function getDetalleCotizacion($id){
        $empresa = Empresa::where('idEmpresa','=','1')->select('iva')->get();
        return Producto::join('producto_cotizacion','producto.idProducto','=','producto_cotizacion.idProducto')
            ->where('producto_cotizacion.idCotizacion','=',$id)
            ->select('producto.codigo','producto.precio','producto.modelo')
            ->selectRaw('(cast(producto.precio as decimal(8,2)) + (cast(producto.precio as decimal(8,2)) * '.$empresa[0]->iva.'/100)) as precioIva')
            ->get();
    }

    function getEmpresa() {
        return Empresa::get();
    }

    function getFabricantes() {
        return Fabricante::get();
    }

    function getProductosDeFabricante($id) {
        return Producto::with(['proveedor','fabricante'])->where('idFabricante','=',$id)->get();
    }

    function getMonedas() {
        return TipoDeMoneda::get();
    }

    function getProductos() {
        return Producto::with(['proveedor','fabricante'])->get();
    }

    function getProveedores() {
        return Proveedor::get();
    }

    function getProductosDeProveedor($id) {
        return Producto::with(['proveedor','fabricante'])->where('idProveedor','=',$id)->get();
    }
}
