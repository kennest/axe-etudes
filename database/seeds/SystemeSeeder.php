<?php
/**
 * Created by PhpStorm.
 * User: davis
 * Date: 11/04/17
 * Time: 09:51
 */


use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SystemeSeeder extends Seeder
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
        DB::table('systemes')->delete();

        $date = $this->randDate();
        DB::table('systemes')->insert(array(
            'titre' => 'LMD' ,
            'created_at' => $date,
            'updated_at' => $date
        ));

        DB::table('systemes')->insert(array(
            'titre' => 'INGENIEUR' ,
            'created_at' => $date,
            'updated_at' => $date
        ));

        DB::table('etablissement_systeme')->insert(array(
            'systeme_id' => 1 ,
            'etablissement_id'=>1,
            'created_at' => $date,
            'updated_at' => $date
        ));
    }
}