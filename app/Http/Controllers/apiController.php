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
    public function getPaginationData() {
        $count = DB::table('usuario')->count();
        return $count;
    }

    public function getUsers(){
        $usersPerPage = 8;
		$usuarios = Usuario::with('rol')->get();
        foreach($usuarios as $user){
            $ventasTotales = $this->getCountVentasTotales($user->idUsuario);
            $promedioMensual = $this->getPromedioVentasMensuales($user->idUsuario);
            $ventasDelMes = $this->getVentasDelMes($user->idUsuario);

            $user->estadisticas = array(
                'ventasTotales' => $ventasTotales,
                'promedioMensual' => $promedioMensual,
                'ventasDelMes' => $ventasDelMes
            );

            $user->clientes = $this->getUserClients($user->idUsuario);
            $user->ventas = $this->getVentas($user->idUsuario);
            $user->cotizaciones = $this->getCotizacionesTabla($user->idUsuario);
		}
        return $usuarios;
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
		$clientes = UsuarioCliente::with('clientName')
            ->select('idCliente')
            ->where('idUsuario', '=', $id)
            ->get(['nombre']);

        $clis = [];
        foreach ($clientes as $cliente)
            array_push($clis, $cliente['clientName']);
		return $clis;
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
            ->orderBy('ano')
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
            ->orderBy('ano')
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

    function getEmpresa() {
        return Empresa::get();
    }

    function getFabricantes() {
        return Fabricante::get();
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
}
