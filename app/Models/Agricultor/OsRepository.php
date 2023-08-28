<?php namespace App\Models\Agricultor;


class OsRepository
{
    private $ordemServico;
    private $tipo;
    private $subTipo;
    public function __construct(OrdemServico $ordemServico, OrdemServicoTipo $tipo, OrdemServicoSubTipo $subTipo)
    {
        $this->ordemServico = $ordemServico;
        $this->tipo = $tipo;
        $this->subTipo = $subTipo;
    }

    public function listarTodos($paginas = 15, $campoOrder = 'id', $order = 'asc'){
        return $this->ordemServico->orderBy($campoOrder, $order)->paginate($paginas);
    }
    public function listarTipos($paginas = 15, $campoOrder = 'id', $order = 'asc'){
        return $this->tipo->orderBy($campoOrder, $order)->paginate($paginas);
    }
    public function listarSubTipos($tipo_id=null){
        if(is_null($tipo_id)){
            return $this->subTipo->orderBy('id', 'asc')->get();
        }
        return $this->subTipo->where('ordem_servico_tipo_id',$tipo_id)->orderBy('id', 'asc')->get();
    }
    public function findOrFail($id)
    {
        return $this->ordemServico->findOrFail($id);
    }

    public function findOrFailTipo($id)
    {
        return $this->tipo->findOrFail($id);
    }

    public function findOrFailSubTipo($id)
    {
        return $this->subTipo->findOrFail($id);
    }

    public function listaSelectTipo(){
        $tipos = $this->tipo->orderBy('id', 'asc')->pluck('nome','id');
        return $tipos->prepend(' Selecione o Tipo',0);
    }

    public function listaSelectSubTipo($tipo_id){
        $tipos = $this->subTipo->where('ordem_servico_tipo_id',$tipo_id)->orderBy('id', 'asc')->pluck('nome','id');
        return $tipos->prepend(' Selecione o Tipo',0);
    }

    public function tipo_store(array $dados)
    {
        return $this->tipo->create($dados);
    }

    public function tipo_update($dados)
    {
        $this->tipo = $dados;
        return $this->tipo->save();
    }
    public function tipo_pesquisa($busca,$paginas=15)
    {
        return $this->tipo->where("nome","ILIKE", "%".$busca."%")->paginate($paginas);
    }
    public function subtipo_store(array $dados)
    {
       // dd($dados);
        return $this->subTipo->create($dados);
    }

    public function subtipo_update($dados)
    {
        $this->subTipo = $dados;
        return $this->subTipo->save();
    }

}
