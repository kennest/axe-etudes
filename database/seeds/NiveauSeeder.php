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

class NiveauSeeder extends Seeder
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
        DB::table('niveaux')->delete();

        $date = $this->randDate();
        DB::table('niveaux')->insert(array(
            'titre' => 'BTS' ,
            'systeme_id'=>2,
            'created_at' => $date,
            'updated_at' => $date
        ));

        DB::table('niveaux')->insert(array(
            'titre' => 'LICENSE' ,
            'systeme_id'=>1,
            'created_at' => $date,
            'updated_at' => $date
        ));

        DB::table('niveaux')->insert(array(
            'titre' => 'MASTER' ,
            'systeme_id'=>1,
            'created_at' => $date,
            'updated_at' => $date
        ));
    }
}