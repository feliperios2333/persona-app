<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comuna; // Importa el modelo Municipio
use Illuminate\Support\Facades\DB; // Importa la clase DB para realizar consultas a la base de datos

class Comunacontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Realiza una consulta a la base de datos para obtener los registros de la tabla 'tb_comuna'
        // y unirlos con la tabla 'tb_municipio' utilizando la columna 'muni_codi'
        // Se seleccionan todas las columnas de 'tb_comuna' y la columna 'muni_nomb' de 'tb_municipio'
        // La consulta devuelve una colección de objetos que representan los registros obtenidos
        // La consulta se realiza utilizando el constructor de consultas de Laravel (DB)
        // Se utiliza el método 'join' para unir las tablas 'tb_comuna' y 'tb_municipio'
        // Se utiliza el método 'select' para especificar las columnas que se desean obtener
        // Se utiliza el método 'get' para ejecutar la consulta y obtener los resultados
        $comuna = DB::table('tb_comuna')
            ->join('tb_municipio', 'tb_comuna.muni_codi', '=', 'tb_municipio.muni_codi')
            ->select('tb_comuna.*', 'tb_municipio.muni_nomb')
            ->get();


        // Retorna la vista 'comuna.index' y pasa los registros obtenidos como una variable llamada 'comunas'
        return view('comuna.index', ['comunas' => $comuna]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $municipios = DB::table('tb_municipio')
            ->orderBy('muni_nomb')
            ->get();
        return view('comuna.new', ['municipios' => $municipios]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $comuna = new Comuna();
        $comuna->comu_nomb = $request->name;
        $comuna->muni_codi = $request->code;
        $comuna->save();

        $comunas = DB::table('tb_comuna')
            ->join('tb_municipio', 'tb_comuna.muni_codi', '=', 'tb_municipio.muni_codi')
            ->select('tb_comuna.*', 'tb_municipio.muni_nomb')
            ->get();
        return view('comuna.index', ['comunas' => $comunas]);
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
        // Busca la comuna por su ID
        $comuna = Comuna::find($id);
        $comuna->delete();

        // Realiza una consulta a la base de datos para obtener los registros de la tabla 'tb_comuna'
        $comunas = DB::table('tb_comuna')
            ->join('tb_municipio', 'tb_comuna.muni_codi', '=', 'tb_municipio.muni_codi')
            ->select('tb_comuna.*', 'tb_municipio.muni_nomb')
            ->get();
        // Retorna la vista 'comuna.index' y pasa los registros obtenidos como una variable llamada 'comunas'
        return view('comuna.index', ['comunas' => $comunas]);
    }
}
