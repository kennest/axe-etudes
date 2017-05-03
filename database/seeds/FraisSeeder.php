<?php
/**
 * Created by PhpStorm.
 * User: davis
 * Date: 20/03/17
 * Time: 21:31
 */

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FraisSeeder extends Seeder
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
        DB::table('frais')->delete();

        $date = $this->randDate();
        DB::table('frais')->insert(array(
            'frais' => 200000 ,
            'scolarite' => 700000 ,
            'niveau_id' => 1 ,
            'etablissement_id'=>1,
            'created_at' => $date,
            'updated_at' => $date
        ));
        DB::table('frais')->insert(array(
            'frais' => 300000 ,
            'scolarite' => 900000 ,
            'niveau_id' => 2,
            'etablissement_id'=>2,
            'created_at' => $date,
            'updated_at' => $date
        ));

    }
}