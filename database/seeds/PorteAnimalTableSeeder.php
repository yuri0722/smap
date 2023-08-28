<?php use Illuminate\Database\Seeder;

use App\Models\Animal\PorteAnimal;

class PorteAnimalTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(PorteAnimal::class)->create(
            [
                'nome'=>'Micro',
            ]
        );
        factory(PorteAnimal::class)->create(
            [
                'nome'=>'Pequeno',
            ]
        );
        factory(PorteAnimal::class)->create(
            [
                'nome'=>'Médio',
            ]
        );
        factory(PorteAnimal::class)->create(
            [
                'nome'=>'Grande',
            ]
        );
        factory(PorteAnimal::class)->create(
            [
                'nome'=>'Gigante',
            ]
        );

    }
}
