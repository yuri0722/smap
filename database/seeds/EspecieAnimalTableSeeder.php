<?php use Illuminate\Database\Seeder;

use App\Models\Animal\EspecieAnimal;

class EspecieAnimalTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(EspecieAnimal::class)->create(
            [
                'nome'=>'Cão',
            ]
        );
        factory(EspecieAnimal::class)->create(
            [
                'nome'=>'Gato',
            ]
        );
        factory(EspecieAnimal::class)->create(
            [
                'nome'=>'Outros',
            ]
        );
    }
}
