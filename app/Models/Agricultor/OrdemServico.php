<?php namespace App\Models\Agricultor;

use Illuminate\Database\Eloquent\Model;

class OrdemServico extends Model
{
    protected $fillable = ['agricultor_id','ordem_servico_tipo_id','ordem_servico_sub_tipo_id','horas_solicitadas',
        'horas_empenhadas','data_agendamento','data_servico','observacao','ponto_referencia','status'];

    public function Agricultor()
    {
        return $this->belongsTo(Agricultor::class,'agricultor_id');
    }

    public function OrdemServicoTipo()
    {
        return $this->belongsTo(OrdemServicoTipo::class,'ordem_servico_tipo_id');
    }

    public function OrdemServicoSubTipo()
    {
        return $this->belongsTo(Agricultor::class,'ordem_servico_sub_tipo_id');
    }

    public function getStatusNomeAttribute()
    {
        if ($this->status=="A"){
            return "Aberto";
        }elseif ($this->status=="E"){
            return "Esperando";
        }else{
            return "Finalizada";
        }
    }



}
