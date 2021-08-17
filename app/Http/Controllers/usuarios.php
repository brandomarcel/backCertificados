<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
class usuarios extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function devuelvecursosxUsuario($usuario)
    {

        $detalleUsu=DB::table('detalleusuario')
        ->join('usuarios','usuarios.cedula','=','detalleusuario.cedulausu')
        ->join('cursos','cursos.id','=','detalleusuario.idcurso')
      
        ->join('periodos','periodos.id','=','cursos.idPeriodo')
        ->select('usuarios.cedula as Cedula','usuarios.nombre as Nombre','usuarios.email as Email',
        'cursos.id as idCurso','cursos.nombre as nombreCurso',
       'periodos.fecInicio as fechaInicio','periodos.fecFin as fechaFin')
        ->where('usuarios.cedula','=',$usuario)
        ->get();
/* 
        //return $detalleUsu;
       $listaDetalle=[];
       $detalles=[];
        foreach ($detalleUsu as $detalle ) {

            
            $detalleCurso=DB::table('detallecurso')
        ->join('cursos','cursos.id','=','detallecurso.idcurso')
        ->join('certificados','certificados.id','=','detallecurso.idcertificado')
        ->select('detallecurso.idcertificado as idCertificado','certificados.nombre as nombreCertificado')
        ->where('cursos.id','=',$detalle->idCurso)
        ->get();

        foreach ($detalleCurso as $item) {
            array_push($detalles,$item);
        }
   
        } */

        $certVip=DB::table('vip')
        ->join('certificados','certificados.id','=','vip.idcertificado')
        
      
        ->select('vip.*','certificados.nombre as nomCertificado')
        ->where('vip.cedula','=',$usuario)
        ->get();
        $fecha = Carbon::now()->locale('es')->translatedFormat(' d \d\e F \d\e\l Y');

        return response()->json(
            [
                
                'detalleUsu' =>$detalleUsu,
               'fecha' =>$fecha,
               'certVip' =>$certVip,
                'HttpResponse' => [
                    'status' => 200,
                    'statusText' => 'OK',
                    'ok' => true,
                    'mensajeConsulta' => 'detalleUsu Consultadas...'
                ]
            ],
            201
        );
    }


    public function devuelvecertificadosxcurso($idCurso)
    {

        $detalleCurso=DB::table('detallecurso')
        ->join('cursos','cursos.id','=','detallecurso.idcurso')
        ->join('certificados','certificados.id','=','detallecurso.idcertificado')
        ->select('detallecurso.idcertificado as idCertificado','certificados.nombre as nombreCertificado')
        ->where('cursos.id','=',$idCurso)
        ->get();


        return response()->json(
            [
                'detalleCurso' =>$detalleCurso,
              
                'HttpResponse' => [
                    'status' => 200,
                    'statusText' => 'OK',
                    'ok' => true,
                    'mensajeConsulta' => 'detalleUsu Consultadas...'
                ]
            ],
            201
        );
    }

    public function devuelvecertificados()
    {

        $usuarios=DB::table('usuarios')
        ->get();



        return response()->json(
            [
                'usuarios' =>$usuarios,
                'HttpResponse' => [
                    'status' => 200,
                    'statusText' => 'OK',
                    'ok' => true,
                    'mensajeConsulta' => 'usuarios Consultadas...'
                ]
            ],
            201
        );
    }


    public function credenciales($usuario,$password)
    {
        $usuarios=DB::table('usuarios')
        ->where([['usuarios.cedula','=',$usuario],['usuarios.password','=',$password]])
        ->get();


        if (count($usuarios)<1) {
            return response()->json([
                'HttpResponse' => [
                    'tittle' => 'Error',
                    'message' => 'No se cargo el usuarios',
                    'status' => 400,
                    'statusText' => 'error',
                    'ok' => true
                ]
            ]);
        }


        return response()->json([
            'usuarios' => $usuarios,
            'HttpResponse' => [
                
                'message' => 'usuarios consultados...',
                'status' => 200,
                'statusText' => 'OK',
                'ok' => true
            ]
        ]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
