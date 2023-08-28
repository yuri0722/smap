<?php

use Illuminate\Database\Seeder;
use App\Models\User\Grupo;
class GrupoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Grupo::class)->create(
            [
                'nome'=>'Técnico',
            ]
        );
        factory(Grupo::class)->create(
            [
                'nome'=>'Veterinario',
            ]
        );
        factory(Grupo::class)->create(
            [
                'nome'=>'Fiscal',
            ]
        );
    }
}
