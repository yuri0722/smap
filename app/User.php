<?php namespace App;

use App\Models\Pessoa\Pessoa;
use App\Models\SmapTraitModel;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Kyslik\ColumnSortable\Sortable;
use App\Models\Access;

class User extends Authenticatable
{
    use Notifiable,SmapTraitModel,Sortable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'pessoa_id','name','cargo', 'email', 'password','login','is_ativo','cpf',
        'is_motorista','md_animal','md_agro','md_pesca','md_sim'];
    /**
     * @var array
     */
    public $sortable = ['id', 'name', 'email','pessoa_id','is_motorista'];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
	
	public function accesses()
    {
        // Não esqueça de usar a classe Access: use App\Models\Access;
        return $this->hasMany(Access::class);
    }

    public function registerAccess()
    {
        // Cadastra na tabela accesses um novo registro com as informações do usuário logado + data e hora
        return $this->accesses()->create([
            'user_id'   => $this->id,
            'datetime'  => date('Y-m-d h:i:sa'),
        ]);
    }

    public function setPasswordAttribute($password){
        if(isset($password)){
            $this->attributes['password'] =  Hash::make($password);
        }
    }

    public function nomeFotoPerfil(){
        $foto = $this->buscaImagensApresenta('users',$this->id);
        return $foto[0];
    }

    public function Pessoa()
    {
        return $this->belongsTo(Pessoa::class,'pessoa_id');
    }

    public function getModulosAttribute()
    {
        $modulos ="";
       // 'md_animal','md_agro','md_pesca','md_sim'
        if ($this->md_animal) {
            $modulos .=' <i class="fa fa-paw" title="Bem estar Animal"></i>';
        }
        if ($this->md_agro) {
            $modulos .=' <i class="fa fa-carrot" title="Agricultura"></i>';
        }
        if ($this->md_pesca) {
            $modulos .=' <i class="fa fa-fish" title="Pesca"></i>';
        }
        if ($this->md_sim) {
            $modulos .=' <i class="fa fa-industry" title="SIM"></i>';
        }
       return $modulos;
    }
}
