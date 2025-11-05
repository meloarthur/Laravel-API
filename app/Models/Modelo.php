<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modelo extends Model
{
    use HasFactory;
    protected $fillable = ['marca_id','nome','imagem','numero_portas','lugares','air_bag','abs'];

    public function rules(){
        return [
            'marca_id' => 'required',
            'nome' => 'required',
            'imagem' => 'required',
            'numero_portas' => 'required',
            'lugares' => 'required',
            'air_bag' => 'required',
            'abs' => 'required'
        ];
    }

    public function feedback(){
        return [
            'required' => 'O campo :attribute é obrigatório'
        ];

    }
}
