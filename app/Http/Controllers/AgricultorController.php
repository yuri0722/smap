<?php namespace App\Http\Controllers;

use App\Http\Requests\AgricultorRequest;
use App\Http\Requests\PesquisaRequest;
use App\Models\Agricultor\AgricultorRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AgricultorController extends Controller
{
    private $agricultorRepository;

    public function __construct(AgricultorRepository $agricultorRepository)
    {
        $this->agricultorRepository =$agricultorRepository;
    }

    public function index(){
        $agricultors = $this->agricultorRepository->listarTodos();
        return view('agricultor.index',compact('agricultors') );
    }

    public function edit($id=null)
    {
        if($id){
            $agricultor= $this->agricultorRepository->findOrFail($id);
            return view('agricultor.edit',compact('agricultor'));
        }else{
            return view('agricultor.edit');
        }
    }

    public function pesquisa(PesquisaRequest $request){
        $busca = $request->busca;
        $animals = $this->agricultorRepository->pesquisa($busca);
        return view('animal.index',compact('animals','busca'));
    }

    public function update($id,AgricultorRequest $request)
    {
        $agricultorRepository = $this->agricultorRepository->findOrFail($id);
        $agricultorRepository->fill($request->all());
        if($this->agricultorRepository->update($agricultorRepository)){
            session::flash('success','Agricultor editado com sucesso!');
            return redirect(route('agro.agricultor'));
        }
    }

    public function store(AgricultorRequest $request)
    {
        $dados = $request->all();
        if ($this->agricultorRepository->store($dados)) {
            session::flash('success','Agricultor cadastrado com sucesso!');
            return redirect(route('agro.agricultor'));
        }
    }

}
