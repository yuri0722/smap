<?php namespace App\Http\Controllers;

use App\Http\Requests\AnimalRequest;
use App\Http\Requests\PesquisaRequest;
use App\Http\Requests\VeiculoRequest;
use App\Models\Veiculo\VeiculoRepository;
use App\Models\Veiculo\VeiculoTipoRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class VeiculoController extends Controller
{
    private $veiculoRepository;
    private $tipoRepository;

    public function __construct(VeiculoRepository $veiculoRepository,VeiculoTipoRepository $tipoRepository)
    {
        $this->veiculoRepository = $veiculoRepository;
        $this->tipoRepository=$tipoRepository;
    }

    public function index(){
        $veiculos = $this->veiculoRepository->listarTodos();
        return view('veiculo.index',compact('veiculos') );
    }

    public function edit($id=null){
        $tipos = $this->tipoRepository->listaSelect();
        if($id){
            $veiculo = $this->veiculoRepository->findOrFail($id);
            return view('veiculo.edit',compact('veiculo','tipos'));
        }else{
            return view('veiculo.edit',compact('tipos'));
        }
    }

    public function pesquisa(PesquisaRequest $request){
        $busca = $request->busca;
        $veiculos = $this->veiculoRepository->pesquisa($busca);
        return view('veiculo.index',compact('veiculos','busca'));
    }

    public function update($id,VeiculoRequest $request)
    {
        $veiculoRepository = $this->veiculoRepository->findOrFail($id);
        $veiculoRepository->fill($request->all());
        $this->veiculoRepository->uparImagens($id, $request->imagem);
        if($this->veiculoRepository->update($veiculoRepository)){
            session::flash('success','Veiculo editado com sucesso!');
            return redirect(route('agro.veiculo'));
        }
    }

    public function store(VeiculoRequest $request)
    {
        $dados = $request->all();
        if ($this->veiculoRepository->store($dados)) {
            session::flash('success','Veículo cadastrado com sucesso!');
            return redirect(route('agro.veiculo'));
        }
    }

    public function deletarImagem($id, $foto)
    {
        if ($this->veiculoRepository->deletarImagem($id,$foto)) {
            session::flash('success','Imagem Deletada com sucesso!');
            return redirect(route('agro.veiculo.edit',$id));
        }
    }
}
