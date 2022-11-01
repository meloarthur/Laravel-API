<?php

namespace App\Http\Controllers;

use App\Models\Locacao;
use App\Http\Requests\StoreLocacaoRequest;
use App\Http\Requests\UpdateLocacaoRequest;

class LocacaoController extends Controller
{
    public function __construct(Locacao $locacao)
    {
        $this->locacao = $locacao;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $locacoes = $this->locacao->all();

        return response()->json($locacoes, 200);;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreLocacaoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLocacaoRequest $request)
    {
        $regras = [
            'cliente_id' => 'required',
            'carro_id' => 'required|unique:locacoes',
            'data_inicio_periodo' => 'required',
            'data_final_previsto_periodo' => 'required',
            'data_final_realizado_periodo' => 'required',
            'valor_diaria' => 'required',
            'km_inicial' => 'required',
            'km_final' => 'required'
        ];

        $feedback = [
            'required' => 'O campo :attribute é obrigatório',
            'carro_id.unique' => 'O carro informado já está alugado'
        ];

        $request->validate($regras, $feedback);

        $locacao = $this->locacao->create($request->all());

        return response()->json($locacao, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  Integer $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $locacao = $this->locacao->find($id);

        if ($locacao === null)
            return response()->json(['erro' => 'Recurso pesquisado não existe'], 404);

        return response()->json($locacao, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Locacao  $locacao
     * @return \Illuminate\Http\Response
     */

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateLocacaoRequest  $request
     * @param  Integer $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateLocacaoRequest $request, $id)
    {
        $locacao = $this->locacao->find($id);

        if ($locacao === null)
            return response()->json(['erro' => 'Recurso solicitado não existe'], 404);

        $locacao->update($request->all());

        return response()->json($locacao, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Integer $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $locacao = $this->locacao->find($id);

        if ($locacao === null)
            return response()->json(['erro' => 'Recurso solicitado não existe'], 404);

        $locacao->delete();

        return response()->json(['msg' => 'Locação removida com sucesso!'], 200);
    }
}
