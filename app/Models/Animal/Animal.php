<?php namespace App\Models\Animal;

use App\Models\Pessoa\Pessoa;
use App\Models\SmapTraitModel;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Animal extends Model
{
    use SmapTraitModel,Sortable;

	// acrescentado o campo 'is_ativo'
    protected $fillable = ['pessoa_id','porte_id','especie_id','nome','situacao','raca','chip','caracteristicas','pelagem','anos','meses','kilos','gramas','sexo','castrado','vacinado', 'is_ativo'];

    public $sortable = ['id', 'nome', 'pessoa_id','especie_id'];

    public function Especie()
    {
        return $this->belongsTo(EspecieAnimal::class,'especie_id');
    }

    public function Porte()
    {
        return $this->belongsTo(PorteAnimal::class,'porte_id');
    }
    public function Dono()
    {
        return $this->belongsTo(Pessoa::class,'pessoa_id');
    }

    public function Castracao()
    {
        return $this->hasOne(Castracao::class,'animal_id');
    }

    public function imagens()
    {
        return $this->buscaImagensApresenta('animals',$this->id);
    }
}
