<?php namespace App\Models\Veiculo;



use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class VeiculoRepository
{
    private $veiculo;

    public function __construct(Veiculo $veiculo)
    {
        $this->veiculo=$veiculo;
    }

    public function listarTodos($paginas = 15, $campoOrder = 'id', $order = 'asc'){
        return $this->veiculo->orderBy($campoOrder, $order)->paginate($paginas);
    }

    public function pesquisa($busca,$paginas=15)
    {
        return $this->veiculo->where("nome","%".$busca."%")->paginate($paginas);
    }

    public function findOrFail($id){
        return $this->veiculo->findOrFail($id);
    }

    public function store($dados)
    {
        return $this->veiculo->create($dados);
    }

    public function update($dados)
    {
        $this->veiculo = $dados;
        return $this->veiculo->save();
    }

    public function countVeiculo(){
        return $this->veiculo->count();
    }

    public function uparImagens($id, $imagem)
    {
        if(!empty($imagem)){
            $qtd = count($imagem);
            for ($i = 0; $i < $qtd; $i++) {
                // $nomeArquivo = date("H_i_s").'.'.$imagem[$i]->extension();
                $nomeArquivo = Str::random(10).'.'.$imagem[$i]->extension();
                $caminho = "img/veiculos/".$id."/";

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
        $caminho = "img/veiculos/".$id."/";
        unlink($caminho."m/".$foto);
        unlink($caminho."p/".$foto);
        return true;
    }

}
