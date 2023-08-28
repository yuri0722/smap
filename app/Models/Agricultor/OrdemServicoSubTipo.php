<?php namespace App\Models\Agricultor;

use Illuminate\Database\Eloquent\Model;

class OrdemServicoSubTipo extends Model
{
    protected $fillable = ['nome','ordem_servico_tipo_id'];


    public function OrdemServicoTipo()
    {
        return $this->belongsTo(OrdemServicoTipo::class,'ordem_servico_tipo_id');
    }

}
