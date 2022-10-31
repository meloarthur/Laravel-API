<?php

namespace App\Http\Controllers;

use App\Models\Carro;
use App\Http\Requests\StoreCarroRequest;
use App\Http\Requests\UpdateCarroRequest;

class CarroController extends Controller
{
    public function __construct(Carro $carro)
    {
        $this->carro = $carro;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $carros = $this->carro->all();
        return response()->json($carros, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCarroRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCarroRequest $request)
    {
        $regras = [
            'modelo_id' => 'required',
            'placa' => 'required|unique:carros',
            'disponivel' => 'required',
            'km' => 'required'
        ];

        $feedback = [
            'required' => 'O campo :attribute é obrigatório',
            'placa.unique' => 'A placa informada já existe'
        ];

        $request->validate($regras, $feedback);

        $carro = $this->carro->create($request->all());
        return response()->json($carro, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  Integer $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $carro = $this->carro->find($id);

        if ($carro === null)
            return response()->json(['erro' => 'Recurso pesquisado não existe'], 404);

        return response()->json($carro, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Carro  $carro
     * @return \Illuminate\Http\Response
     */

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCarroRequest  $request
     * @param  Integer $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCarroRequest $request, $id)
    {
        $carro = $this->carro->find($id);

        if ($carro === null)
            return response()->json(['erro' => 'Recurso solicitado não existe'], 404);

        $carro->update($request->all());

        return response()->json($carro, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Integer $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $carro = $this->carro->find($id);

        if ($carro === null)
            return response()->json(['erro' => 'Recurso solicitado não existe'], 404);

        $carro->delete();

        return response()->json(['msg' => 'Modelo removido com sucesso!'], 200);
    }
}
