<?php namespace App\Models\Imovel;

use Illuminate\Database\Eloquent\Model;

class Imovel extends Model
{

    protected $fillable = ['pessoa_id','user_id','bairro_id','matricula','inscricao_incra','area','area_construida','rural',
        'tem_car','lat','lon','endereco','imovel_id_sistema','complemento','ativo'];

}
