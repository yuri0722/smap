<?php namespace App\Http\Controllers;

use App\Http\Requests\PesquisaRequest;
use App\Models\Pessoa\PessoaRepository;
use Illuminate\Http\Request;

class PescaController extends Controller
{
    private $pessoaRepository;

    public function __construct(PessoaRepository $pessoaRepository)
    {
        $this->pessoaRepository=$pessoaRepository;
    }

    public function index(){
        return view('pessoa.index' );
    }

    public function edit($id=null){
        dd('chegou');
        if($id){
            $pessoa= $this->pessoaRepository->findOrFail($id);
            return view('pessoa.edit',compact('pessoa'));
        }else{
            return view('pessoa.edit');
        }
    }

    public function pesquisa(PesquisaRequest $request){
        $busca = $request->busca;
        $pessoas = $this->pessoaRepository->pesquisa($busca);
        // dd($pessoas);
        return view('pessoa.index',compact('pessoas','busca'));
    }

    public function update($id,Request $request)
    {
        $pessoaRepository = $this->pessoaRepository->findOrFail($id);
        $pessoaRepository->fill($request->all());
        if($this->pessoaRepository->update($pessoaRepository)){
            return redirect(route('pessoa.index'));
        }
    }

    public function store(Request $request)
    {
        $dados = $request->all();
        if ($this->pessoaRepository->store($dados)) {
            return redirect(route('pessoa.index'));
        }
    }
}
