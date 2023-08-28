<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;


class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //php artisan db:seed --class=UserTableSeeder
        factory('App\User')->create(
            ['name'=>'Danilo Luiz',
                'email'=>'daniloaluiz@gmail.com',
                'cpf'=>'03293380999',
                'is_admin'=>1,
                'password'=>'123456'
            ]
        );
        factory('App\User')->create(
            ['name'=>'ROBERTO DE ABREU BENTO',
                'email'=>'robertoabreubento@gmail.com',
                'cpf'=>'05430851981',
                'is_admin'=>1,
                'password'=>'05430851981',
            ]
        );
        factory('App\User')->create(
            ['name'=>'LUIZ FERNANDO DE SOUZA',
                'email'=>'luizagrogrp@gmail.com',
                'cpf'=>'10219486913',
                'is_admin'=>0,
                'password'=>'10219486913',
            ]
        );



    }
}
