<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // $request->route()->getAction()['slug'];
        $user = $request->user();
        if(!$user->is_ativo){
            session::flash('error','Seu login não está ativo, favor consultar a informática!');
            Auth::logout();
            return redirect(route('login'));
        }
        if($user->is_admin){
            return $next($request);
        }else{
            Session::flash('error','Você não tem acesso a página solicitada! Contate o administrador do sistema.');
          //  return redirect()->back();
            return redirect(route('smap'));
        }
    }
}
