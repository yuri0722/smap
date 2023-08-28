<?php namespace App\Http\Controllers;

use App\Http\Requests\AnimalRequest;
use App\Http\Requests\CastracaoRequest;
use App\Http\Requests\PesquisaRequest;
use App\Models\Animal\AnimalRepository;
use App\Models\Animal\EspecieAnimalRepository;
use App\Models\Animal\PorteAnimalRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AnimalController extends Controller
{
    private $animalRepository;
    private $porteAnimalRepository;
    private $especieAnimalRepository;
    public function __construct(AnimalRepository $ar,PorteAnimalRepository $par,EspecieAnimalRepository $ear)
    {
        $this->animalRepository=$ar;
        $this->especieAnimalRepository=$ear;
        $this->porteAnimalRepository = $par;
    }

    public function index(){
      $animals = $this->animalRepository->listarTodos();
        return view('animal.index',compact('animals') );
    }

    public function castrado($castrado){
        $animals = $this->animalRepository->listarCastrados($castrado);
        return view('animal.index',compact('animals') );
    }

    public function por_especie($especie_id){
        $animals = $this->animalRepository->listarPorEspecie($especie_id);
        return view('animal.index',compact('animals') );
    }
    
	// função acrescentada para visualizar animal antes de deletar - Yuri
	public function show($id){
		
		$especieAnimal = $this->especieAnimalRepository->listaSelect();
        $porteAnimal= $this->porteAnimalRepository->listaSelect();
        if($id){
            $animal= $this->animalRepository->findOrFail($id);
            return view('animal.show',compact('animal','especieAnimal','porteAnimal'));
        }else{
            return view('animal.show',compact('especieAnimal','porteAnimal'));
        }
    }
	
	public function edit($id=null){
        $especieAnimal = $this->especieAnimalRepository->listaSelect();
        $porteAnimal= $this->porteAnimalRepository->listaSelect();
        if($id){
            $animal= $this->animalRepository->findOrFail($id);
            return view('animal.edit',compact('animal','especieAnimal','porteAnimal'));
        }else{
            return view('animal.edit',compact('especieAnimal','porteAnimal'));
        }
    }
	
	// função acrescentada para deletar animal - Yuri
	public function destroy($id){
		
		$animal = $this->animalRepository->findOrFail($id);
		
		$animal->is_ativo = False;
		
		$animal->save();
		
		return redirect(route('bemestar.animal'));
    }

    public function castracao($id){
        $animal= $this->animalRepository->findOrFail($id);
        if(isset($animal->Castracao)){
            $castracao = $this->animalRepository->findCastracao($animal->Castracao->id);
            return view('animal.castracao',compact('animal','castracao'));
        }else{
            return view('animal.castracao',compact('animal'));

        }
    }

    public function castracao_print($id){
        $castracao= $this->animalRepository->findCastracao($id);
        return view('animal.castracao_print',compact('castracao'));
    }
	
    public function pesquisa(PesquisaRequest $request){
        $busca = $request->busca;
        $animals = $this->animalRepository->pesquisa($busca);
        return view('animal.index',compact('animals','busca'));		
    }

    public function update($id,AnimalRequest $request)
    {
        $animalRepository = $this->animalRepository->findOrFail($id);
        $animalRepository->fill($request->all());
        $this->animalRepository->uparImagens($id, $request->imagem);
        if($this->animalRepository->update($animalRepository)){
            session::flash('success','Animal editado com sucesso!');
            return redirect(route('bemestar.animal'));
        }
    }

    public function store(AnimalRequest $request)
    {
        $dados = $request->all();
        if ($this->animalRepository->store($dados)) {
            session::flash('success','Animal cadastrado com sucesso!');
            return redirect(route('bemestar.animal'));
        }
    }

    public function castrar(CastracaoRequest $request)
    {
        $dados = $request->all();
        if ($this->animalRepository->castrar($dados)) {
            session::flash('success','Formulário de castração salvo com sucesso!');
            return redirect(route('bemestar.animal'));
        }
    }

    public function castrar_update($id,CastracaoRequest $request)
    {
        $castracao = $this->animalRepository->findCastracao($id);
        $castracao->fill($request->all());
        if($this->animalRepository->castrar_update($castracao)){
            session::flash('success','Formulário de castração editado com sucesso!');
            return redirect(route('bemestar.animal'));
        }
    }

    public function deletarImagem($id, $foto)
    {
        if ($this->animalRepository->deletarImagem($id,$foto)) {
            session::flash('success','Imagem Deletada com sucesso!');
            return redirect(route('bemestar.animal.edit',$id));
        }
    }
}
