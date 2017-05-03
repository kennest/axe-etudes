<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EtablissementSeeder extends Seeder
{

    private function randDate()
    {
        return Carbon::createFromDate(null, rand(1, 12), rand(1, 28));
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('etablissements')->delete();

            $date = $this->randDate();
            DB::table('etablissements')->insert(array(
                'titre' => 'Institut de technologie' ,
                'sigle' => 'ITES' ,
                'telephone' => '47064447' ,
                'logo' => '1tov9mocrGKWadMEgsIOE7Vzgc5DTmtz0TUTGjYA1.png' ,
                'email' => 'kennyoulai@gmail.com',
                'password' => bcrypt('jjks'),
                'code'=>'jjks',
                'actif'=>1,
                'type_id'=>1,
                'created_at' => $date,
                'updated_at' => $date
            ));
            DB::table('etablissements')->insert(array(
                'titre' => 'Institut des Arts' ,
                'sigle' => 'INSAC' ,
                'telephone' => '08505550' ,
                'logo' => 'tov9mocrGKWadMEgsIOE7Vzgc5DTmtz0TUTGjYA1.png' ,
                'email' => 'davisoulai@gmail.com',
                'password' => bcrypt('jjks'),
                'code'=>'jjks',
                'actif'=>1,
                'type_id'=>1,
                'created_at' => $date,
                'updated_at' => $date
            ));
    }
}
