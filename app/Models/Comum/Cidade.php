<?php namespace App\Models\Comum;

use Illuminate\Database\Eloquent\Model;

class Cidade extends Model
{
    protected $fillable = ['nome','estado_id','ibge'];

    public function Estado()
    {
        return $this->belongsTo(Estado::class);
    }
}
