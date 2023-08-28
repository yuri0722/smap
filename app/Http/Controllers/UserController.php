<?php namespace App\Http\Controllers;

use App\Http\Requests\PesquisaRequest;
use App\Http\Requests\UserRequest;
use App\Models\User\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index(){
        $users = $this->userRepository->listarTodos();
        return view('user.index', compact('users'));
    }

    public function edit($id=null)
    {
        if($id){
            $user= $this->userRepository->findOrFail($id);
            return view('user.edit',compact('user'));
        }else{
            return view('user.edit');
        }
    }
    public function update($id, UserRequest $request){
        $user = $this->userRepository->findOrFail($id);
        $user->fill($request->all());
        if(!isset($request->is_motorista)){
            $user->is_motorista = '0';
        }
        if(!isset($request->md_animal)){
            $user->md_animal = '0';
        }
        if(!isset($request->md_agro)){
            $user->md_agro = '0';
        }
        if(!isset($request->md_pesca)){
            $user->md_pesca = '0';
        }
        if(!isset($request->md_sim)){
            $user->md_sim = '0';
        }
        if($this->userRepository->update($user,$id)){
            session::flash('success','Usuário salvo com sucesso!');
            return redirect(route('admin.users'));

        }
    }
    public function store(UserRequest $request)
    {
        $dados = $request->all();
        $user = $this->userRepository->store($dados);
        if (isset($user->id)) {
            session::flash('success','Usuário inserido com sucesso!');
            return redirect(route('admin.users'));
        }else{
            session::flash("error", $user);
            return redirect()->back();
        }
    }

    public function pesquisa(PesquisaRequest $request){
        $busca = $request->busca;
        $users = $this->userRepository->pesquisa($busca);
        return view('user.index',compact('users','busca'));
    }

    public function perfil()
    {
        $user = $this->userRepository->findOrFail(Auth::user()->id);
        return view('user.perfil', compact('user') );
    }

    public function perfil_update($id, UserRequest $request)
    {
        $user = $this->userRepository->findOrFail($id);
        $user->fill($request->all());

        if($this->userRepository->update($user)) {
            if (isset($request->imagem)){
                $this->userRepository->uparImagens($id, $request->imagem);
            }
            session::flash('success','Perfil Alterado com sucesso!');
            return redirect(route('smap.perfil'));
        }
    }
}
