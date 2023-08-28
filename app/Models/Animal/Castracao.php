<?php namespace App\Models\Animal;

use Illuminate\Database\Eloquent\Model;

class Castracao extends Model
{
    protected $fillable = ['animal_id','anestesia','anestesia_descricao','doente_recente','doente_recente_descricao','convulsao','diarreia_vomito','sensibilidade_medicamento','sensibilidade_medicamento_descricao',
        'alimentacao_normal','vermifugado','vacinado','comportamento_anormal','comportamento_anormal_descricao',
        'falhas_nos_pelos','secrecao_vaginal','secrecao_olhos','coceira','ecc','tpc','temperatura','bpm','pulso','fr','mucosas','hidratacao','observacao','castrado'];

    public function Animal()
    {
        return $this->belongsTo(Animal::class,'animal_id');
    }

}
