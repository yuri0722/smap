<?php namespace App\Models\User;

use App\Models\SmapTraitModel;
use App\User;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
use Mail;
use DB;

class UserRepository
{
    use SmapTraitModel;

    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function listarTodos($paginas = 20)
    {
        return  $this->user->where('is_ativo','=',true)->sortable('id')->paginate($paginas);
    }

    public function listarInativos($paginas = 20)
    {
        return  $this->user->where('is_ativo','=',false)->sortable('id')->paginate($paginas);
    }


    public function findOrFail($id)
    {
        return $this->user->findOrFail($id);
    }

    public function store(array $dados)
    {
        $dados["name"] = $this->nomePadrao($dados["name"]);
        $dados["cpf"] = $this->soNumero($dados["cpf"]);
        if($this->user->create($dados)){
            return true;
        }
    }


    public function update($dados)
    {
        if(!$dados['is_admin']) {
            $dados['is_admin']=0;
        }else{
            $dados['is_admin']=1;
        }
        $dados["name"] = $this->nomePadrao($dados["name"]);
        $dados["cpf"] = $this->soNumero($dados["cpf"]);
        $this->user = $dados;

        if( $this->user->save()){
            return true;
        }
    }

    public function uparImagens($idUser, $imagem)
	{
        if( $imagem ){
            /**
             * Não foi possível usar "Y_m_dHis" para nomear o arquivo por que o método, "$diretorio -> read()" no
             * método nomeImagemMimiatura(), não consegue retornar o nome da foto com nome muito longo
             */
            $nomeArquivo = date("H_i_s").'.'.$imagem->extension();
            //$nomeArquivo = date("Y_m_dHis").'.'.$imagem->extension();
            $caminho = "img/users/".$idUser."/";

            $exif = @exif_read_data($imagem);
            $img = Image::make( $imagem->getRealPath() );
            if($exif && isset($exif['Orientation'])) {
                $orientation = $exif['Orientation'];
                if($orientation != 1){
                    $deg = 0;
                    switch ($orientation) {
                        case 3:
                            $deg = 180;
                            break;
                        case 6:
                            $deg = 270;
                            break;
                        case 8:
                            $deg = 90;
                            break;
                    }
                    if ($deg) {
                        $img->rotate($deg);
                    }
                } // if there is some rotation necessary
            }
            File::exists($caminho."m/") or File::makeDirectory($caminho."m/", 0777, true);
            File::exists($caminho."l/") or File::makeDirectory($caminho."l/", 0777, true);
            File::exists($caminho."p/") or File::makeDirectory($caminho."p/", 0777, true);

            $img->fit(800, 600, function ($constraint) {
                $constraint->upsize();
            });

            $user = $this->findOrFail($idUser);
            if ($user->nomeFotoPerfil() != '') {
                @unlink($caminho."m/".$user->nomeFotoPerfil() );
                @unlink($caminho."l/".$user->nomeFotoPerfil() );
                @unlink($caminho."p/".$user->nomeFotoPerfil() );
            }

            if($img->save($caminho."m/".$nomeArquivo, 100) ){
                $img->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $img->save($caminho."l/".$nomeArquivo, 100);

                $img->resize(60, null, function ($constraint) {
                    $constraint->aspectRatio();
                });

                $img->save($caminho."p/".$nomeArquivo, 100);

                return true;

            }


        }

        return ['success' => true];
    }

    function correctImageOrientation($filename) {
        if (function_exists('exif_read_data')) {
            $exif = exif_read_data($filename);
            if($exif && isset($exif['Orientation'])) {
                $orientation = $exif['Orientation'];
                if($orientation != 1){
                    $img = imagecreatefromjpeg($filename);
                    $deg = 0;
                    switch ($orientation) {
                        case 3:
                            $deg = 180;
                            break;
                        case 6:
                            $deg = 270;
                            break;
                        case 8:
                            $deg = 90;
                            break;
                    }
                    if ($deg) {
                        $img = imagerotate($img, $deg, 0);
                    }
                    imagejpeg($img, $filename, 95);
                } // if there is some rotation necessary
            } // if have the exif orientation info
        } // if function exists
    }

    public function buscaPorNome($campo, $param, $paginacao = 'N', $paginas=10)
    {
        if($paginacao == 'S'){
            $lista = $this->user->where($campo, 'ilike', '%'.$param.'%')->paginate($paginas);
        }else{
            $lista = $this->user->where($campo, 'ilike', '%'.$param.'%')->get();
        }
        return $lista;
    }

    public function buscaPorPessoaId($pessoa_id)
    {
        return $this->user->where("pessoa_id", '=', $pessoa_id)->first();
    }

    public function buscaPorLogin($login)
    {
        return $this->user->where("login", '=', $login)->first();
    }

    public function validaMatricula($matricula,$pessoa_id)
    {
        $funcionario = DB::table('funcionarios')->select("funcionarios.matricula")
            ->where("pessoa_id", "=",  $pessoa_id)
            ->where("matricula", "=",  $matricula)
            ->where("is_ativo",true)
            ->count();
        if($funcionario>0){
            return true;
        }else{
            return false;
        }
    }

    public function buscaPorCpf($cpf)
    {
        $cpf = $this->soNumero($cpf);

        $user = $this->user->where("cpf", '=', $cpf)->first();
        if(isset($user->id)){
            if(!isset($user->celular)){
                $user->celular=$user->Pessoa->celular;
                if(isset($user->celular)){
                    $user->save();
                }
            }
        }
        return $user;
    }

    public function pesquisa($busca,$paginas=10)
    {
        $busca = strtolower($this->nomePadrao($busca));
        $pessoas = DB::table('pessoas')->whereraw("unaccent(lower(nome)) LIKE '%".$busca."%'")->pluck('id');

        $users = $this->user->whereraw("unaccent(lower(name)) LIKE '%".$busca."%'")
            ->orWhere("ramal", '=', $busca)
            ->orWhereIn("pessoa_id",$pessoas)
            ->sortable('id')->paginate($paginas);

        return $users;
    }

    public function pesquisaComRamal($busca,$paginas=10)
    {
        if(is_numeric($busca)){
            $users = $this->user->where("ramal", '=', $busca)
                ->where('is_ativo',true)
               ->paginate($paginas);
        }else{

        $busca = strtolower($this->nomePadrao($busca));
        $setors = DB::table('setors')->whereraw("unaccent(lower(nome)) LIKE '%".$busca."%'")->pluck('id');
        $locals = DB::table('locals')->whereraw("unaccent(lower(nome)) LIKE '%".$busca."%'")->pluck('id');

        $funcionario_locals= DB::table('funcionario_local')->whereIn('local_id',$locals)->pluck('funcionario_id');
        $funcionarios = DB::table('funcionarios')->where("is_ativo",true)
            ->whereIn('setor_id',$setors)->orWhereIn("id",$funcionario_locals)->pluck('pessoa_id');

        $users = $this->user->whereraw("unaccent(lower(name)) LIKE '%".$busca."%'")
            //->where("name", 'ilike', "%".$busca."%")
            ->where('ramal','<>','0')
            ->whereNotNull("ramal")
            ->orWhereIn("pessoa_id",$funcionarios)
            ->where('is_ativo',true)
            ->paginate($paginas);
        }
        return $users;
    }

    public function usuarioSemPessoa()
    {
        return $this->user->whereNull("pessoa_id")
            ->orWhereNull("login")
            ->get();
    }

    public function usuarioSemLdap()
    {
        return $this->user->whereNull("smbpass")
            ->orderBy("name", "asc")
            ->get();
    }

    public function todosComCPF()
    {
        return $this->user->whereNotNull("cpf")
            ->get();
    }

    public function todosComUID()
    {
        return $this->user->whereNotNull("uid")->where('is_ativo',true)->orderBy("name", "asc")->get();
    }

    public function todosSemUID()
    {
        return $this->user->whereNull("uid")->orderBy("name", "asc")->get();
    }

    public function todosComRamal()
    {
        return $this->user->whereNotNull("ramal")->where('ramal','<>','0')->paginate(15);
    }

    public function criarLogin($nome,$ultimoNome)
    {
        $continuar = true;
        $count =0;
        while($continuar==true){

            $user = $this->user->where("login", '=', $nome.".".$ultimoNome)->first();
            if(!isset($user->login)){
                $continuar = false;
                return $nome.".".$ultimoNome;
            }else{
                $count++;
                $ultimoNome = $ultimoNome.$count;
            }
        }

    }

    public function filtroPorNome($busca)
    {
        $busca = strtolower($this->nomePadrao($busca,false));
        $pessoas = DB::table('pessoas')->whereraw("unaccent(lower(nome)) LIKE '".$busca."%'")->pluck('id');
        $pessoas2 = DB::table('pessoas')->whereraw("unaccent(lower(nome)) LIKE '%".$busca."%'")->pluck('id');

        $users = $this->user->whereIn("pessoa_id",$pessoas)->get();
        $users2 = $this->user->whereIn("pessoa_id",$pessoas2)->get();
        $merged = $users->merge($users2);
        return $merged;
    }

    public function gestores()
    {
        return $this->user->where("is_gestor_rh",true)->get();
    }

    public function tecnicos()
    {
       return $this->user->where("is_tecnico",true)->get();
    }

    public function listaTecnicos()
    {
        return $this->user->where("is_tecnico",true)->where("is_ativo",true)->orderBy("name", "asc")->pluck('name','id');

    }

    public function filtroGestoresRhPorNome($busca)
    {
        return $this->user->where("name","ilike","%$busca%")->where("is_gestor_rh",true)->get();
    }

    public function filtroTecnicosPorNome($busca)
    {
        return $this->user->where("name","ilike","%$busca%")->where("is_tecnico",true)->get();
    }

    public function primeira_senha($user){

        if($this->validaEmail($user["para"]) ){
            Mail::send('emails.primeira_senha', ['nome' => $user["name"], 'email' => $user["para"], 'senha' => $user["primeira_senha"]],
                function ($m) use ($user) {
                    $m->from('dev@garopaba.sc.gov.br', 'Desenvolvimento de Sistemas - Garopaba');
                    $m->to($user["para"], $user["name"])->subject("Notificação de primeiro acesso");
                });
            return true;
        }else{
           return false;

        }
    }

    public function countAtivos()
    {
        return $this->user->where("is_ativo", true)->count();

    }

    public function countInativos()
    {
        return $this->user->where("is_ativo", false)->count();

    }

    public function countSemPermissao(){
        return DB::table('users')
            ->whereNotExists(function ($query) {
                $query->select(DB::raw(1))
                    ->from('user_permissao_internet')
                    ->whereRaw('user_permissao_internet.user_id = users.id')
                    ->where('users.is_ativo','=',true);
            })
            ->count();
    }

    public function usersLogadoss()
    {

        $logados = DB::table('sessions')->select("user_id","last_activity","user_agent","ip_address")
            ->whereNotNull("user_id")->orderBy("last_activity", "DESC")->paginate(20);
        foreach ($logados as $logado){
            $agente =  $logado->user_agent;
            $agente = explode("(", $agente);
            $agente = $agente[1];
            $agente = explode(")", $agente);
            $nomeDispositivo = $agente[0];

            $user = $this->findOrFail($logado->user_id);
            $logado->name = $user->Pessoa->nome;
            $logado->user_agent = $nomeDispositivo;
            $logado->localLogado = $user->localLogado();
            $logado->localDefault = $user->localDefault();

            $logado->last_activity = date('d/m/Y H:i:s', $logado->last_activity);

        }
        return $logados;
    }

    public function pesquisa_logados($busca)
    {
        $busca = strtolower($this->nomePadrao($busca));
        $pessoas = DB::table('pessoas')->whereraw("unaccent(lower(nome)) LIKE '%".$busca."%'")->pluck('id');

        $users = $this->user->whereIn("pessoa_id",$pessoas)->pluck('id');

        if (count($users)>=1){
        $logados = DB::table('sessions')->select("user_id","last_activity","user_agent","ip_address")
            ->WhereIn("user_id",$users)
            ->orderBy("last_activity", "DESC")
            ->paginate(20);

        }else{
            $logados = DB::table('sessions')->select("user_id","last_activity","user_agent","ip_address")
                ->where("ip_address","LIKE","%".$busca."%")
                ->whereNotNull("user_id")//->toSql();
                ->orderBy("last_activity", "DESC")
                ->paginate(20);
           // dd($logados);
        }
        foreach ($logados as $logado){
            $agente =  $logado->user_agent;
            $agente = explode("(", $agente);
            $agente = $agente[1];
            $agente = explode(")", $agente);
            $nomeDispositivo = $agente[0];

            $user = $this->findOrFail($logado->user_id);
            $logado->name = $user->Pessoa->nome;
            $logado->user_agent = $nomeDispositivo;
            $logado->localLogado = $user->localLogado();
            $logado->localDefault = $user->localDefault();

            $logado->last_activity = date('d/m/Y H:i:s', $logado->last_activity);

        }
        return $logados;
    }

    public function usersSecretaria($orgao_central_id,$paginas=15)
    {
        $orgaos = DB::table('orgaos')->where("orgao_central_id",$orgao_central_id)->pluck('id');
        $funcionarios = DB::table('funcionarios')->where("is_ativo",true)->whereIn('orgao_id',$orgaos)->pluck('pessoa_id');
        $users = $this->user->whereIn("pessoa_id",$funcionarios)
            ->where('is_ativo',true)->sortable('name')
            ->paginate($paginas);
        return $users;
    }

    public function gestoresSecretaria($orgao_central_id,$paginas=15)
    {
        $orgaos = DB::table('orgaos')->where("orgao_central_id",$orgao_central_id)->pluck('id');
        $funcionarios = DB::table('funcionarios')->where("is_ativo",true)->whereIn('orgao_id',$orgaos)->pluck('pessoa_id');
        return $this->user->whereIn("pessoa_id",$funcionarios)
            ->where('is_ativo',true)->where('is_gestor_rh',true)->sortable('name')->paginate($paginas);
    }

    public function usersSecretariaCount($orgao_central_id)
    {
        $orgaos = DB::table('orgaos')->where("orgao_central_id",$orgao_central_id)->pluck('id');
        $funcionarios = DB::table('funcionarios')->where("is_ativo",true)->whereIn('orgao_id',$orgaos)->pluck('pessoa_id');
        return $this->user->whereIn("pessoa_id",$funcionarios)
            ->where('is_ativo',true)->sortable('name')->count();
    }

    public function pesquisausersSecretaria($busca,$orgao_central_id,$paginas=10)
    {
        $busca = strtolower($this->nomePadrao($busca));
        $orgaos = DB::table('orgaos')->where("orgao_central_id",$orgao_central_id)->pluck('id');
        $funcionarios = DB::table('funcionarios')->where("is_ativo",true)->whereIn('orgao_id',$orgaos)->pluck('pessoa_id');
        $pessoas = DB::table('pessoas')->whereraw("unaccent(lower(nome)) LIKE '%".$busca."%'")->pluck('id');

        return $this->user->whereIn("pessoa_id",$funcionarios)
            ->whereIn("pessoa_id",$pessoas)->sortable('id')->paginate($paginas);
    }

}
