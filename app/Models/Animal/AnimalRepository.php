<?php namespace App\Models\Animal;

use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class AnimalRepository
{
    private $animal;
    private $castracao;

    public function __construct(Animal $animal,Castracao $castracao)
    {
        $this->animal=$animal;
        $this->castracao=$castracao;
    }
    public function listarTodos($paginas = 15){
        return $this->animal->where("is_ativo",true)->sortable('id')->paginate($paginas);
    }

    public function listarCastrados($castrado='S',$paginas = 15){
        return $this->animal->select("animals.*")
            ->join('castracaos', 'animals.id', '=', 'castracaos.animal_id')
            ->where('castracaos.castrado','=',$castrado)
            ->sortable('id')->paginate($paginas);
    }

    public function listarPorEspecie($especie_id,$paginas = 15){
        return $this->animal->where("especie_id",$especie_id)->sortable('id')->paginate($paginas);
    }

	// função alterada para realizar busca por pessoa também
    public function pesquisa($busca,$paginas=15)
    {
		//como estava o retorno da função antes da alteração
		//return $this->animal->where("nome","ilike","%$busca%")->sortable('id')->paginate($paginas);
		
		$pessoas = DB::table('pessoas')
				->where("nome","ilike","%$busca%")
				->select('id');
		
		$array = (array) $pessoas->pluck('id');
		
		//dd($array);
		
		$result = $this->animal->where("nome","ilike","%$busca%")
				->where("is_ativo", true)
				->orWherein("pessoa_id", $array["\x00*\x00items"])->where("is_ativo", true)
				->sortable('id')->paginate($paginas);
		
		return $result;
    }

    public function findOrFail($id){
        return $this->animal->findOrFail($id);
    }
    public function findCastracao($id){
        return $this->castracao->findOrFail($id);
    }
    public function store($dados)
    {
        return $this->animal->create($dados);
    }

    public function update($dados)
    {
        $this->animal = $dados;
        return $this->animal->save();
    }

    public function filtroPorNome($busca)
    {
        return $this->animal->where("nome","ilike","%$busca%")->get();
    }

    public function castrar($dados)
    {
        return $this->castracao->create($dados);
    }

    public function castrar_update($dados)
    {
        $this->castracao = $dados;
        return $this->castracao->save();
    }

    public function countAnimal($especie_id=null){
        if (is_null($especie_id)){
            return $this->animal->count();

        }
        return $this->animal->where("especie_id",$especie_id)->count();
    }

    public function countCastracao(){
        return $this->castracao->where('castrado','=','S')->count();
    }
    public function counNaoCastracado(){
        return $this->castracao->where('castrado','=','N')->count();
    }
    public function uparImagens($id, $imagem)
    {
        if(!empty($imagem)){
            $qtd = count($imagem);
            for ($i = 0; $i < $qtd; $i++) {
                // $nomeArquivo = date("H_i_s").'.'.$imagem[$i]->extension();
                $nomeArquivo = Str::random(10).'.'.$imagem[$i]->extension();
                $caminho = "img/animals/".$id."/";

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
        $caminho = "img/animals/".$id."/";
        unlink($caminho."m/".$foto);
        unlink($caminho."p/".$foto);
        return true;
    }
}
