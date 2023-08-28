<?php

namespace App\Http\Controllers;

use App\Models\Comum\CidadeRepository;
use Illuminate\Http\Request;

class CidadeController extends Controller
{
    private $cidadeRepository;

    public function __construct(CidadeRepository $cidadeRepository)
    {
        $this->cidadeRepository=$cidadeRepository;
    }

    public function filtro($busca,$campoId, $campoNome, $campoSelect){
        $cidades = $this->cidadeRepository->filtroPorNome($busca);

        if(!empty($cidades)){
            echo "<ul>";
            foreach($cidades as $cidade){
                echo "<li onclick=\"document.getElementsByName('".$campoId."')[0].value = '".$cidade->id."'; document.getElementsByName('".$campoNome."')[0].value = '".$cidade->nome."'; document.getElementById('".$campoSelect."').style.display = 'none'; \" style='cursor:pointer;' class=\"list-group-item  \">".$cidade->nome."</li>";
            }
            echo "</ul>";
        }
        exit;
    }
}
