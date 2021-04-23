<?php

use Illuminate\Database\Seeder;

class VehiclesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('vehicles')->insert([
            'code_car' => "806",
            'model' => "F 350",
            'year' => "2008",
            'in_use' => "0"
        ]);
        DB::table('vehicles')->insert([
            'code_car' => "881",
            'model' => "HIACE",
            'year' => "2009",
            'in_use' => "0"
        ]);
        DB::table('vehicles')->insert([
            'code_car' => "941",
            'model' => "RANGER",
            'year' => "2011",
            'in_use' => "0"
        ]);
        DB::table('vehicles')->insert([
            'code_car' => "997",
            'model' => "CRV",
            'year' => "2012",
            'in_use' => "0"
        ]);
        DB::table('vehicles')->insert([
            'code_car' => "1035",
            'model' => "HIACE",
            'year' => "2012",
            'in_use' => "0"
        ]);
        DB::table('vehicles')->insert([
            'code_car' => "1137",
            'model' => "TIIDA",
            'year' => "2015",
            'in_use' => "0"
        ]);
        DB::table('vehicles')->insert([
            'code_car' => "1138",
            'model' => "TIIDA",
            'year' => "2015",
            'in_use' => "0"
        ]);
        DB::table('vehicles')->insert([
            'code_car' => "1287",
            'model' => "TIIDA",
            'year' => "2017",
            'in_use' => "0"
        ]);
        DB::table('vehicles')->insert([
            'code_car' => "1288",
            'model' => "CRV",
            'year' => "2016",
            'in_use' => "0"
        ]);
        DB::table('vehicles')->insert([
            'code_car' => "1308",
            'model' => "CRAFTER",
            'year' => "2017",
            'in_use' => "0"
        ]);
        DB::table('vehicles')->insert([
            'code_car' => "1321",
            'model' => "LEAF",
            'year' => "2017",
            'in_use' => "0"
        ]);
        DB::table('vehicles')->insert([
            'code_car' => "1357",
            'model' => "PRIUS",
            'year' => "2017",
            'in_use' => "0"
        ]);

    }
}
