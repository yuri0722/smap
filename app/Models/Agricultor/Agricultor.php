<?php namespace App\Models\Agricultor;

use App\Models\Pessoa\Pessoa;
use Illuminate\Database\Eloquent\Model;

class Agricultor extends Model
{
    protected $fillable = ['pessoa_id','numero_sindicato','numero_epagri','numero_cidasc','numero_bloco_notas','beneficio_governo',
        'numero_animais','renda_anual','nr_agro_familia','engenho_farinha','engenho_cana','producao','observacao'];

    public function Pessoa()
    {
        return $this->belongsTo(Pessoa::class,'pessoa_id');
    }

}
