<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Models\Cotizacion;
use App\Models\Cliente;
use Illuminate\Support\Facades\DB;
use App\Models\Rol;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class UsuarioController extends Controller
{

    public function index(){
      return Usuario::with('rol')->get();
    }

    public function create(){
        return Rol::all();
    }

    public function store(Request $request){
        $usuario = new Usuario;
        $usuario->fill($request->all());
        $usuario->contra_usuario = sha1($request->contra_usuario);
        if($request->hasFile('imagen_perfil')){
            $file = $request->file('imagen_perfil');
            $extension = $file->getClientOriginalExtension();
            $newname = sha1(Carbon::now().$file->getFilename()).'.'.$extension;
            $usuario->imagen_perfil = $newname;
            Storage::disk('public')->put($newname,  File::get($file));
        }
        $usuario->save();
    }

    public function edit($id){
        $roles = Rol::all();
        $usuario = Usuario::find($id);
        return compact(['roles', 'usuario']);
    }

    public function update(Request $request){
        try{
            $usuario = Usuario::find($request->idUsuario);
            $pass = $usuario->contra_usuario;
            $usuario->fill($request->all());
            if($request->contra_usuario != "")
                $usuario->contra_usuario = sha1($request->contra_usuario);
            else
                $usuario->contra_usuario = $pass;
            if($request->hasFile('imagen_perfil')){
                $file = $request->file('imagen_perfil');
                $extension = $file->getClientOriginalExtension();
                $newname = sha1(Carbon::now().$file->getFilename()).'.'.$extension;
                $usuario->imagen_perfil = $newname;
                Storage::disk('public')->put($newname,  File::get($file));
            }
            $usuario->save();
        }catch(Exception $ex){

        }
    }

    public function destroy($id){
        Usuario::find($id)->delete();
    }

    public function getPaginationData() {
        return Usuario::count();
    }

    public function show($id){
        $ventas = $this->getVentas($id);
        $cotizaciones = $this->getCotizacionesTabla($id);
        $ventasAnteriores = $ventas[1]->ventas;
        $cotizacionesAnteriores = $cotizaciones[1]->cotizaciones;
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

    public function getVentas($id){
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

    public function getCotizacionesTabla($id){
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

    public function getCountVentasTotales($id){
        return Cotizacion::where('idUsuario', '=', $id)
            ->where('finalizada', '=', 1)
            ->count();
    }

    public function getUserClients($id){
        return Cliente::join('usuario_cliente','usuario_cliente.idCliente','=','cliente.idCliente')
            ->where('idUsuario', '=', $id)
            ->select('cliente.*')
            ->get();
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

    public function getPromedioVentasMensuales($id){
        $ventasMensuales = Cotizacion::select(DB::raw('MONTH(created_at) mes, COUNT(*) ventasMensuales'))
            ->where('idUsuario', '=', $id)
            ->where('finalizada', '=', 1)
            ->groupBy(DB::raw('YEAR(created_at)'))
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->get();

        $sumVentas = 0;
        $promedioMensual = 0;
        if (count($ventasMensuales) > 0) {
            foreach ($ventasMensuales as $ventaDelMes)
                $sumVentas += $ventaDelMes['ventasMensuales'];
            $promedioMensual = $sumVentas / count($ventasMensuales);
        }

        return $promedioMensual;
    }



    public function getVentasDelMes($id){
        $ventas = Cotizacion::where('idUsuario', '=',$id)
            ->where('finalizada', '=', '1')
            ->selectRaw('MONTH(IF(updated_at is null, created_at, updated_at)) mes, YEAR(IF(updated_at is null, created_at, updated_at)) ano, COUNT(*) ventas')
            ->groupBy(DB::raw('YEAR(IF(updated_at is null, created_at, updated_at)), MONTH(IF(updated_at is null, created_at, updated_at))'))
            ->havingRaw('ano = YEAR(CURDATE()) and mes = MONTH(CURDATE())')
            ->get();
        return (sizeof($ventas) > 0 ? $ventas[0]->ventas : 0);
    }

    public function getUserSells($id){
        return $this->getVentas($id);
    }

    public function getVentasTotales($id){
        return Cotizacion::where('idUsuario', '=', $id)
            ->where('finalizada', '=', 1)
            ->count();
    }
}
