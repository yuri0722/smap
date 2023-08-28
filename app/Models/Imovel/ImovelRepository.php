<?php namespace App\Models\Imovel;


class ImovelRepository
{
    private $imovel;

    public function __construct(Imovel $imovel)
    {
        $this->imovel = $imovel;
    }
}
