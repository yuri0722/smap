<?php  use Illuminate\Database\Seeder;

use App\Models\Comum\Estado;

class EstadoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('estados')->truncate();

        factory(Estado::class)->create(
            ['id'=> 12,
                'nome'=>'ACRE',
                'sigla'=> 'AC'
            ]
        );

        factory(Estado::class)->create(
            ['id'=> 27,
                'nome'=>'ALAGOAS',
                'sigla'=> 'AL'
            ]
        );

        factory(Estado::class)->create(
            ['id'=> 13,
                'nome'=>'AMAZONAS',
                'sigla'=> 'AM'
            ]
        );

        factory(Estado::class)->create(
            ['id'=> 16,
                'nome'=>'AMAPA',
                'sigla'=> 'AP'
            ]
        );

        factory(Estado::class)->create(
            ['id'=> 29,
                'nome'=>'BAHIA',
                'sigla'=> 'BA'
            ]
        );

        factory(Estado::class)->create(
            ['id'=> 23,
                'nome'=>'CEARA',
                'sigla'=> 'CE'
            ]
        );

        factory(Estado::class)->create(
            ['id'=> 53,
                'nome'=>'DISTRITO FEDERAL',
                'sigla'=> 'DF'
            ]
        );

        factory(Estado::class)->create(
            ['id'=> 32,
                'nome'=>'ESPIRITO SANTO',
                'sigla'=> 'ES'
            ]
        );

        factory(Estado::class)->create(
            ['id'=> 99,
                'nome'=>'EXTERIOR',
                'sigla'=> 'EX'
            ]
        );

        factory(Estado::class)->create(
            ['id'=> 52,
                'nome'=>'GOIAS',
                'sigla'=> 'GO'
            ]
        );

        factory(Estado::class)->create(
            ['id'=> 21,
                'nome'=>'MARANHAO',
                'sigla'=> 'MA'
            ]
        );

        factory(Estado::class)->create(
            ['id'=> 31,
                'nome'=>'MINAS GERAIS',
                'sigla'=> 'MG'
            ]
        );

        factory(Estado::class)->create(
            ['id'=> 50,
                'nome'=>'MATO GROSSO DO SUL',
                'sigla'=> 'MS'
            ]
        );

        factory(Estado::class)->create(
            ['id'=> 51,
                'nome'=>'MATO GROSSO',
                'sigla'=> 'MT'
            ]
        );

        factory(Estado::class)->create(
            ['id'=> 15,
                'nome'=>'PARA',
                'sigla'=> 'PA'
            ]
        );

        factory(Estado::class)->create(
            ['id'=> 25,
                'nome'=>'PARAIBA',
                'sigla'=> 'PB'
            ]
        );

        factory(Estado::class)->create(
            ['id'=> 26,
                'nome'=>'PERNAMBUCO',
                'sigla'=> 'PE'
            ]
        );

        factory(Estado::class)->create(
            ['id'=> 22,
                'nome'=>'PIAUI',
                'sigla'=> 'PI'
            ]
        );

        factory(Estado::class)->create(
            ['id'=> 41,
                'nome'=>'PARANA',
                'sigla'=> 'PR'
            ]
        );

        factory(Estado::class)->create(
            ['id'=> 33,
                'nome'=>'RIO DE JANEIRO',
                'sigla'=> 'RJ'
            ]
        );

        factory(Estado::class)->create(
            ['id'=> 24,
                'nome'=>'RIO GRANDE DO NORTE',
                'sigla'=> 'RN'
            ]
        );

        factory(Estado::class)->create(
            ['id'=> 11,
                'nome'=>'RONDONIA',
                'sigla'=> 'RO'
            ]
        );

        factory(Estado::class)->create(
            ['id'=> 14,
                'nome'=>'RORAIMA',
                'sigla'=> 'RR'
            ]
        );

        factory(Estado::class)->create(
            ['id'=> 43,
                'nome'=>'RIO GRANDE DO SUL',
                'sigla'=> 'RS'
            ]
        );

        factory(Estado::class)->create(
            ['id'=> 42,
                'nome'=>'SANTA CATARINA',
                'sigla'=> 'SC'
            ]
        );

        factory(Estado::class)->create(
            ['id'=> 28,
                'nome'=>'SERGIPE',
                'sigla'=> 'SE'
            ]
        );

        factory(Estado::class)->create(
            ['id'=> 35,
                'nome'=>'SAO PAULO',
                'sigla'=> 'SP'
            ]
        );

        factory(Estado::class)->create(
            ['id'=> 17,
                'nome'=>'TOCANTINS',
                'sigla'=> 'TO'
            ]
        );

    }
}
