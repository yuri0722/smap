<?php namespace App\Models\Animal;


class EspecieAnimalRepository
{
    private $especieAnimal;

    public function __construct(EspecieAnimal $especieAnimal)
    {
        $this->especieAnimal = $especieAnimal;
    }

    public function listarTodos($paginas = 15, $campoOrder = 'id', $order = 'asc'){
        return $this->especieAnimal->orderBy($campoOrder, $order)->paginate($paginas);
    }


    public function pesquisa($busca,$paginas=15)
    {
        return $this->especieAnimal->where("nome","ilike","%$busca%")->paginate($paginas);
    }

    public function findOrFail($id){
        return $this->especieAnimal->findOrFail($id);
    }

    public function store($dados)
    {
        return $this->especieAnimal->create($dados);
    }

    public function update($dados)
    {
        $this->especieAnimal = $dados;
        return $this->especieAnimal->save();
    }

    public function filtroPorNome($busca)
    {
        return $this->especieAnimal->where("nome","ilike","%$busca%")->get();
    }

    public function listaSelect(){
        $tipos = $this->especieAnimal->orderBy('nome', 'asc')->pluck('nome','id');
        return $tipos->prepend(' Selecione a Especie',0);
    }

}
