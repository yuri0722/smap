<?php

namespace App\Listeners;

use App\User;
 
class UserEventSubscriber
{
    /**
     * Handle user login events.
     */
    public function onUserLogin($event)
    {
        // Registra o acesso do usuário logado
        auth()->user()->registerAccess();
    }
 
 
    /**
     * Handle user logout events.
     */
    public function onUserLogout($event)
    {
        // Se quiser implementar algo pós logout é neste estágio
        //dd($event);
        auth()->user()->registerAccess();
    }
 
 
    /**
     * Register the listeners for the subscriber.
     *
     * @param  Illuminate\Events\Dispatcher  $events
     */
    public function subscribe($events)
    {
        $events->listen(
            'Illuminate\Auth\Events\Login',
            'App\Listeners\UserEventSubscriber@onUserLogin'
        );
 
        $events->listen(
            'Illuminate\Auth\Events\Logout',
            'App\Listeners\UserEventSubscriber@onUserLogout'
        );
    }
 
}