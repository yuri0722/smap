<?php namespace App\Models\Pessoa;

use App\Models\SmapTraitModel;
use DB;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class PessoaRepository
{
    private $pessoa;
    use SmapTraitModel;

    public function __construct(Pessoa $pessoa)
    {
        $this->pessoa= $pessoa;
    }

    public function listarTodos($paginas = 20, $campoOrder = 'id', $order = 'asc'){
        return $this->pessoa->orderBy($campoOrder, $order)->paginate($paginas);
    }

    public function listarTodosEmpresas($paginas = 20){
        return $this->pessoa->where('pessoa_tipo','J')->sortable('id')->paginate($paginas);
    }
    public function listarTodosPessoas($paginas = 20){
        return $this->pessoa->where('pessoa_tipo','F')->sortable('id')->paginate($paginas);
    }
    public function findOrFail($id)
    {
        return $this->pessoa->findOrFail($id);
    }

    public function pesquisa($busca,$paginas=10)
    {
        if(is_numeric($busca)){
           $pessoas = $this->pessoa->where("cpf", $busca)->sortable('id')->paginate($paginas);

        }else{
            $pessoas = $this->pessoa
                ->where("nome","ILIKE", "%".$busca."%")
                ->sortable('id')
                ->paginate($paginas);

        }
        return $pessoas;
    }

    public function store($dados)
    {
        $dados["nome"] = $this->nomePadrao($dados["nome"]);
        $dados["cpf"] = $this->soNumero($dados["cpf"]);
        $dados["cnpj"] = $this->soNumero($dados["cnpj"]);
         return $this->pessoa->create($dados);

    }

    public function update($dados,$id=null)
    {
       $dados["nome"] = $this->nomePadrao($dados["nome"]);
       $this->pessoa = $dados;
       return $this->pessoa->save();
    }

    public function findCpf($cpf = null)
    {
        return $this->pessoa->where("cpf", $cpf)->first();
    }

    public function findCnpj($cnpj = null)
    {
        return $this->pessoa->where("cnpj", $cnpj)->first();
    }

    public function filtroPorNome($busca)
    {
        return $this->pessoa->where("nome","ilike","%$busca%")->get();
    }

    public function countPessoa()
    {
        return $this->pessoa->where('pessoa_tipo','F')->count();
    }

    public function countEmpresa()
    {
        return $this->pessoa->where('pessoa_tipo','J')->count();
    }

    public function uparImagens($id, $imagem)
    {
        if(!empty($imagem)){
            $qtd = count($imagem);
            for ($i = 0; $i < $qtd; $i++) {
                // $nomeArquivo = date("H_i_s").'.'.$imagem[$i]->extension();
                $nomeArquivo = Str::random(10).'.'.$imagem[$i]->extension();
                $caminho = "img/pessoas/".$id."/";

                $img = Image::make($imagem[$i]->getRealPath());

                File::exists($caminho."m/") or File::makeDirectory($caminho."m/", 0777, true);
                File::exists($caminho."p/") or File::makeDirectory($caminho."p/", 0777, true);
                $img->resize(800, null, function ($constraint) {
                    $constraint->aspectRatio();
                });

                if($img->save($caminho."m/".$nomeArquivo, 100) ){
                    $img->resize(150, null, function ($constraint) {
                        $constraint->aspectRatio();
                    });
                    if(!$img->save($caminho."p/".$nomeArquivo, 100) ){
                        //return false;
                    }
                }

            }
            return true;
        }else{
            return false;
        }

    }

    public function deletarImagem($id,$foto)
    {
        $caminho = "img/pessoas/".$id."/";
        unlink($caminho."m/".$foto);
        unlink($caminho."p/".$foto);
        return true;
    }

}
