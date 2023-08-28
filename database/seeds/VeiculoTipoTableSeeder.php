<?php

use Illuminate\Database\Seeder;
use App\Models\Veiculo\VeiculoTipo;

class VeiculoTipoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //php artisan db:seed --class=VeiculoTipoTableSeeder
        //Automóvel,Caminhão, Caminhão Caçamba,Trator (não tem placa),Retro-escavadeira,Escavadeira
        factory(VeiculoTipo::class)->create(
            [
                'nome'=>'Automóvel',
            ]
        );
        factory(VeiculoTipo::class)->create(
            [
                'nome'=>'Caminhão',
            ]
        );
        factory(VeiculoTipo::class)->create(
            [
                'nome'=>'Caminhão Caçamba',
            ]
        );
        factory(VeiculoTipo::class)->create(
            [
                'nome'=>'Trator',
            ]
        );
        factory(VeiculoTipo::class)->create(
            [
                'nome'=>'Retroescavadeira',
            ]
        );
        factory(VeiculoTipo::class)->create(
            [
                'nome'=>'Escavadeira',
            ]
        );
    }
}
