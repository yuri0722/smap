<?php namespace App\Models\Comum;


use App\Models\SmapTraitModel;

class CidadeRepository
{
    private $cidade;
    use SmapTraitModel;

    public function __construct(Cidade $cidade)
    {
        $this->cidade= $cidade;
    }

    public function listarTodos($paginas = 20, $campoOrder = 'id', $order = 'asc'){
        return $this->cidade->orderBy($campoOrder, $order)->paginate($paginas);
    }

    public function findOrFail($id)
    {
        return $this->cidade->findOrFail($id);
    }

    public function pesquisa($busca,$paginas=10)
    {
        return $this->cidade->where("nome","ILIKE", "%".$busca."%")->orderBy('nome','asc')->paginate($paginas);
    }

    public function filtroPorNome($busca)
    {
        $busca = strtolower($this->nomePadrao($busca));
        return $this->cidade->whereraw("unaccent(lower(nome)) LIKE '%".$busca."%'")->get();
    }
}
