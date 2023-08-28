<?php namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    protected $fillable = [
        'nome', 'descricao'
    ];

}
