<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Solicitud;

class SolicitudController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $solicitud = new Solicitud;
        $solicitud->monto = $request->monto;
        $solicitud->edad = $request->edad;
        $solicitud->tarjeta = $request->tarjeta;
        $solicitud->plazo = $request->plazo;
        $solicitud->porcentaje = $request->porcentaje;
        $solicitud->id_usuario = $request->id_usuario;
        $solicitud->estatus = "pendiente";
        $solicitud->save();
        return $solicitud;

        // return 'done';
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id_usuario
     * @return \Illuminate\Http\Response
     */
    public function show($id_usuario)
    {
        $array = array();
        $solicitud = Solicitud::where([
            ['id_usuario','=',$id_usuario],
            ['estatus','=','pendiente']
        ])->orderBy('created_at','asc')->get();

        foreach($solicitud as $row){

            //calcular el total a pagar 
            $total = (($row['monto']*$row['porcentaje'])*$row['plazo'])/1200;
            $total = $row['monto'] + $total;

            //ingresar valores al arreglo $array
            array_push($array,array(
                "id"=>$row['id'],
                "total"=>$total,
                "estatus"=>$row['estatus'],
                "created_at"=>$row['created_at']->format('m/d/Y H:i:s')
            ));
        }//foreach

        return $array;
    }//show

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

    public function historial($id_usuario){
       
        $array = array();
        //buscar toda las solicitudes donde estatus sea diferente a pendiente
        $historial =  Solicitud::where([
            ['id_usuario','=',$id_usuario],
            ['estatus','!=','pendiente']
        ])->orderBy('created_at','asc')->get();
              
        //recorrer arreglo con busqueda de base de datos
        foreach($historial as $row){
        
            //verificar el tipo estatus para determinar el color de su estatus
            if($row['estatus'] == "rechazado"){
                $color = "alert-danger";//color rojo
            }elseif($row['estatus'] == "aceptado"){
                $color = "alert-success";//color verde
            }
            
            //calcular el total a pagar 
            $total = (($row['monto']*$row['porcentaje'])*$row['plazo'])/1200;
            $total = $row['monto'] + $total;

            //ingresar valores al arreglo $array
            array_push(
                $array,array(
                    "color"=>$color,
                    "id"=>$row['id'],
                    "total"=>$total,
                    "porcentaje"=>$row['porcentaje'],
                    "estatus"=>$row['estatus'],
                    "created_at"=>$row['created_at']->format('m/d/Y H:i:s'),
                )
            );
        }
        return $array;
    }
}
