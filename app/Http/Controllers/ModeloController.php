<?php

namespace App\Http\Controllers;

use App\Models\Modelo;
use Illuminate\Http\Request;

class ModeloController extends Controller
{
    public function __construct(Modelo $modelo)
    {
        $this->modelo = $modelo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $modelos = $this->modelo->all();
        return $modelos;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $modelo = $this->modelo->create($request->all());
        return $modelo;
    }

    /**
     * Display the specified resource.
     *
     * @param  Integer $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $modelo = $this->modelo->find($id);

        if ($modelo === null)
            return ['erro' => 'Recurso pesquisado não existe'];

        return $modelo;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Modelo  $modelo
     * @return \Illuminate\Http\Response
     */

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Integer $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $modelo = $this->modelo->find($id);

        if ($modelo === null)
            return ['erro' => 'Recurso solicitado não existe'];

        $modelo->update($request->all());
        return $modelo;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Integer $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $modelo = $this->modelo->find($id);

        if ($modelo === null)
            return ['erro' => 'Recurso solicitado não existe'];

        $modelo->delete();
        return ['msg' => 'Modelo removido com sucesso!'];
    }
}
