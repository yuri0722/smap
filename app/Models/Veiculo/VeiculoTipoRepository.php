<?php namespace App\Models\Veiculo;


class VeiculoTipoRepository
{
    private $veiculoTipo;

    public function __construct(VeiculoTipo $veiculoTipo)
    {
        $this->veiculoTipo = $veiculoTipo;
    }

    public function listarTodos($paginas = 15, $campoOrder = 'id', $order = 'asc'){
        return $this->veiculoTipo->orderBy($campoOrder, $order)->paginate($paginas);
    }


    public function pesquisa($busca,$paginas=15)
    {
        return $this->veiculoTipo->where("nome","ilike","%$busca%")->paginate($paginas);
    }

    public function findOrFail($id){
        return $this->veiculoTipo->findOrFail($id);
    }

    public function store($dados)
    {
        return $this->veiculoTipo->create($dados);
    }

    public function update($dados)
    {
        $this->veiculoTipo = $dados;
        return $this->veiculoTipo->save();
    }

    public function filtroPorNome($busca)
    {
        return $this->veiculoTipo->where("nome","ilike","%$busca%")->get();
    }

    public function listaSelect(){
        $tipos = $this->veiculoTipo->orderBy('nome', 'asc')->pluck('nome','id');
        return $tipos->prepend(' Selecione Tipo',0);
    }
}
