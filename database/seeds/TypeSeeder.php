<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    private function randDate()
    {
        return Carbon::createFromDate(null, rand(1, 12), rand(1, 28));
    }

    public function run()
    {
        DB::table('types')->delete();

        $date = $this->randDate();
        DB::table('types')->insert(array(
            'titre' => 'UNIVERSITE PRIVE',
            'created_at' => $date,
            'updated_at' => $date
        ));

        DB::table('types')->insert(array(
            'titre' => 'UNIVERSITE PUBLIQUE',
            'created_at' => $date,
            'updated_at' => $date
        ));

        DB::table('types')->insert(array(
            'titre' => 'MATERNELLE ET PRIMAIRE',
            'created_at' => $date,
            'updated_at' => $date
        ));

        DB::table('types')->insert(array(
            'titre' => 'SECONDAIRE',
            'created_at' => $date,
            'updated_at' => $date
        ));

        DB::table('types')->insert(array(
            'titre' => 'GRANDE ECOLE',
            'created_at' => $date,
            'updated_at' => $date
        ));

    }
}
