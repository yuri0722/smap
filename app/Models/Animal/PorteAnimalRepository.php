<?php namespace App\Models\Animal;


class PorteAnimalRepository
{
    private $porteAnimal;

    public function __construct(PorteAnimal $porteAnimal)
    {
        $this->porteAnimal = $porteAnimal;
    }

    public function listarTodos($paginas = 15, $campoOrder = 'id', $order = 'asc'){
        return $this->porteAnimal->orderBy($campoOrder, $order)->paginate($paginas);
    }


    public function pesquisa($busca,$paginas=15)
    {
        return $this->porteAnimal->where("nome","ilike","%$busca%")->paginate($paginas);
    }

    public function findOrFail($id){
        return $this->porteAnimal->findOrFail($id);
    }

    public function store($dados)
    {
        return $this->porteAnimal->create($dados);
    }

    public function update($dados)
    {
        $this->porteAnimal = $dados;
        return $this->porteAnimal->save();
    }

    public function filtroPorNome($busca)
    {
        return $this->porteAnimal->where("nome","ilike","%$busca%")->get();
    }

    public function listaSelect(){
        $tipos = $this->porteAnimal->orderBy('id', 'asc')->pluck('nome','id');
        return $tipos->prepend(' Selecione o Porte',0);
    }

}
