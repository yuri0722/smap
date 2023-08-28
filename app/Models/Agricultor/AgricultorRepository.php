<?php namespace App\Models\Agricultor;

use DB;

class AgricultorRepository
{
    private $agricultor;

    public function __construct(Agricultor $agricultor){
        $this->agricultor = $agricultor;
    }

    public function listarTodos($paginas = 15, $campoOrder = 'id', $order = 'asc'){
        return $this->agricultor->orderBy($campoOrder, $order)->paginate($paginas);
    }

    public function pesquisa($busca,$paginas=15)
    {
        $pessoas = DB::table('pessoas')->whereraw("unaccent(lower(nome)) LIKE '%".$busca."%'")->pluck('id');
        return $this->agricultor->whereIn("pessoa_id",$pessoas)->paginate($paginas);
    }

    public function findOrFail($id){
        return $this->agricultor->findOrFail($id);
    }

    public function store($dados)
    {
        return $this->agricultor->create($dados);
    }

    public function update($dados)
    {
        $this->agricultor = $dados;
        return $this->agricultor->save();
    }

    public function countAgricultor(){
        return $this->castracao->count();
    }
}
