<?php namespace App\Models\Veiculo;

use App\Models\SmapTraitModel;
use Illuminate\Database\Eloquent\Model;

class Veiculo extends Model
{
    use SmapTraitModel;

    protected $fillable = ['nome','veiculo_tipo_id','quilometragem','placa','marca','modelo','cor','ano','observacao'];

    public function VeiculoTipo()
    {
        return $this->belongsTo(VeiculoTipo::class,'veiculo_tipo_id');
    }

    public function imagens()
    {
        return $this->buscaImagensApresenta('veiculos',$this->id);
    }

}
