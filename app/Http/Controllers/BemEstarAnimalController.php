<?php namespace App\Http\Controllers;

use App\Models\Animal\AnimalRepository;
use App\Models\Pessoa\PessoaRepository;
use Illuminate\Http\Request;

class BemEstarAnimalController extends Controller
{
    private $pessoaRepository;
    private $animalRepository;

    public function __construct(AnimalRepository $ar,PessoaRepository $pessoaRepository)
    {
        $this->animalRepository=$ar;
        $this->pessoaRepository = $pessoaRepository;
    }

    public function index(){
        $countAnimal = $this->animalRepository->countAnimal();
        $countCastracao = $this->animalRepository->countCastracao();
        $countNaoCastracado = $this->animalRepository->counNaoCastracado();
        $countPessoa = $this->pessoaRepository->countPessoa();
        $countEmpresa = $this->pessoaRepository->countEmpresa();
        $countDog = $this->animalRepository->countAnimal(1);
        $countCat = $this->animalRepository->countAnimal(2);
        return view('bemestaranimal.index',compact('countAnimal','countCastracao','countPessoa','countEmpresa','countDog','countCat','countNaoCastracado') );
    }
}
