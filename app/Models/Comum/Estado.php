<?php namespace App\Models\Comum;

use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    protected $fillable = ['nome','sigla'];

    public function cidades(){
        return $this->hasMany(Cidade::class);
    }
}
