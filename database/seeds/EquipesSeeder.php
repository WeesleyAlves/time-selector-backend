<?php

use Illuminate\Database\Seeder;

class EquipesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $equipes = [
            1 => [
                'id_equipe'=>md5(uniqid(rand(),true)),
                'nome'=>'Time 1',
                'local'=>'Quadra 1',
                'horaEntrada'=>'19:00',
                'horaSaida'=>'19:30',
                'goleiro'=>null,
                'linha1'=>null,
                'linha2'=>null,
                'linha3'=>null,
                'linha4'=>null
            ],
            2 => [
                'id_equipe'=>md5(uniqid(rand(),true)),
                'nome'=>'Time 2',
                'local'=>'Quadra 2',
                'horaEntrada'=>'19:30',
                'horaSaida'=>'20:00',
                'goleiro'=>null,
                'linha1'=>null,
                'linha2'=>null,
                'linha3'=>null,
                'linha4'=>null
            ],
            3 => [
                'id_equipe'=>md5(uniqid(rand(),true)),
                'nome'=>'Time 3',
                'local'=>'Quadra 3',
                'horaEntrada'=>'20:00',
                'horaSaida'=>'20:30',
                'goleiro'=>null,
                'linha1'=>null,
                'linha2'=>null,
                'linha3'=>null,
                'linha4'=>null
            ]
        ];

        DB::table('equipes')->insert($equipes);
    }
}
