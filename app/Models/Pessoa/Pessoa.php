<?php namespace App\Models\Pessoa;

use App\Models\Comum\Cidade;
use App\Models\SmapTraitModel;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Pessoa extends Model
{
    use SmapTraitModel,Sortable;

    protected $fillable = ['nome','email','nome_fantasia','pessoa_tipo','cpf','pis','cnpj','data_nascimento',
        'sexo','rg','nacionalidade','telefone','celular',
        'cidade_id','endereco','bairro','complemento','cep','numero','is_agricultor','is_pescador','status'];

    public $sortable = ['id', 'nome', 'email','cpf','cnpj'];


    public function Cidade()
    {
        return $this->belongsTo(Cidade::class,'cidade_id');
    }

    public function imagens()
    {
        return $this->buscaImagensApresenta('pessoas',$this->id);
    }
}
