<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carro extends Model
{
    use HasFactory;
    protected $fillable = ['modelo_id','placa','disponivel','km'];

    public function rules(){
        return [
            'modelo_id' => 'required',
            'placa' => 'required|unique:carros',
            'disponivel' => 'required',
            'km' => 'required'
        ];
    }

    public function feedback(){
        return [
            'required' => 'O campo :attribute é obrigatório',
            'placa.unique' => 'A placa informada já existe'
        ];
    }
}
