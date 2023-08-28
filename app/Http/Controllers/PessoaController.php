<?php namespace App\Http\Controllers;

use App\Http\Requests\PessoaRequest;
use App\Models\Pessoa\PessoaRepository;
use App\Http\Requests\PesquisaRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PessoaController extends Controller
{

    private $pessoaRepository;

    public function __construct(PessoaRepository $pessoaRepository)
    {
        $this->pessoaRepository = $pessoaRepository;

    }

    public function pessoas(Request $request){
        $this->setLayout($request);
        $pessoas = $this->pessoaRepository->listarTodosPessoas();
        return view('pessoa.pessoas', compact('pessoas'));
    }

    public function empresas(){
        $pessoas = $this->pessoaRepository->listarTodosEmpresas();
        return view('pessoa.empresas', compact('pessoas'));
    }

    public function pesquisa(PesquisaRequest $request){

        $busca = $request->busca;
        $pessoas = $this->pessoaRepository->pesquisa($busca);
        return view('pessoa.index',compact('pessoas','busca'));
    
    }

    public function edit($id=null,Request $request)
    {
        $this->setLayout($request);
        if($id){
            $pessoa= $this->pessoaRepository->findOrFail($id);
            return view('pessoa.edit',compact('pessoa'));
        }else{
            return view('pessoa.edit');
        }
    }

    public function edit_empresa($id=null)
    {
        if($id){
            $pessoa= $this->pessoaRepository->findOrFail($id);
            return view('pessoa.edit_empresa',compact('pessoa'));
        }else{
            return view('pessoa.edit_empresa');
        }
    }
    public function detalhe($id=null)
    {
        $pessoa = $this->pessoaRepository->findOrFail($id);
        $this->pessoaRepository->atualizar($pessoa->cpf,$pessoa->id);
        return view('pessoa.detalhe',compact('pessoa'));
    }

    public function update($id, PessoaRequest $request){
         $pessoa = $this->pessoaRepository->findOrFail($id);
         $pessoa->fill($request->all());

        $this->pessoaRepository->uparImagens($id, $request->imagem);
        if($this->pessoaRepository->update($pessoa,$id)){
             if ($pessoa->pessoa_tipo=="F"){
                 session::flash('success','Pessoa salva com sucesso!');
                 return redirect(route(session::get('nome_rota').'.pessoas'));
             }else{
                 session::flash('success','Empresa salva com sucesso!');
                 return redirect(route('bemestar.empresas'));
             }
         }
    }

    public function store(PessoaRequest $request)
    {
        $dados = $request->all();
        $pessoa = $this->pessoaRepository->store($dados);
        if (isset($pessoa->id)) {
            if ($pessoa->pessoa_tipo=="F"){
                session::flash('success','Pessoa inserida com sucesso!');
                return redirect(route(session::get('nome_rota').'.pessoas'));
            }else{
                session::flash('success','Empresa inserida com sucesso!');
                return redirect(route('bemestar.empresas'));
            }
        }else{
            session::flash("error", $pessoa);
            return redirect()->back();
        }
    }

    public function filtro($busca,$campoId, $campoNome, $campoSelect){
        $pessoas = $this->pessoaRepository->filtroPorNome($busca);

        if(!empty($pessoas)){
            echo "<ul>";
            foreach($pessoas as $pessoa){
                echo "<li onclick=\"document.getElementsByName('".$campoId."')[0].value = '".$pessoa->id."'; document.getElementsByName('".$campoNome."')[0].value = '".$pessoa->nome."'; document.getElementById('".$campoSelect."').style.display = 'none'; \" style='cursor:pointer;' class=\"list-group-item list-group-item-action small\">".$pessoa->nome."</li>";
            }
            echo "</ul>";
        }
        exit;
    }

    public function setLayout(Request $request){
        $nome_rota = $request->route()->getAction()['as'];
        $layout = explode(".", $nome_rota);
        session::flash('nome_rota',$layout[0]);
    }

    public function deletarImagem($id, $foto)
    {
        if ($this->pessoaRepository->deletarImagem($id,$foto)) {
            session::flash('success','Imagem Deletada com sucesso!');
            return redirect(route('bemestar.pessoa.edit',$id));
        }
    }
}
