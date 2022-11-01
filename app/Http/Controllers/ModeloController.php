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

        return response()->json($modelos, 200);
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
        $regras = [
            'marca_id' => 'required',
            'nome' => 'required',
            'imagem' => 'required',
            'numero_portas' => 'required',
            'lugares' => 'required',
            'air_bag' => 'required',
            'abs' => 'required'
        ];

        $feedback = [
            'required' => 'O campo :attribute é obrigatório'
        ];

        $request->validate($regras, $feedback);
        
        $modelo = $this->modelo->create($request->all());

        return response()->json($modelo, 201);;
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
            return response()->json(['erro' => 'Recurso pesquisado não existe'], 404);

        return response()->json($modelo, 200);
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
            return response()->json(['erro' => 'Recurso solicitado não existe'], 404);

        $modelo->update($request->all());

        return response()->json($modelo, 200);
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
            return response()->json(['erro' => 'Recurso solicitado não existe'], 404);

        $modelo->delete();

        return response()->json(['msg' => 'Modelo removido com sucesso!'], 200);
    }
}
