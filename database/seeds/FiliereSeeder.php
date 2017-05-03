<?php
/**
 * Created by PhpStorm.
 * User: davis
 * Date: 20/03/17
 * Time: 21:30
 */

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FiliereSeeder extends Seeder
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
        DB::table('filieres')->delete();

        $date = $this->randDate();
        DB::table('filieres')->insert(array(
            'titre' => 'IDA' ,
            'created_at' => $date,
            'updated_at' => $date
        ));

        DB::table('filieres')->insert(array(
            'titre' => 'RIT' ,
            'created_at' => $date,
            'updated_at' => $date
        ));

        DB::table('filieres')->insert(array(
            'titre' => 'RHCOM' ,
            'created_at' => $date,
            'updated_at' => $date
        ));

        DB::table('filieres')->insert(array(
            'titre' => 'MINES' ,
            'created_at' => $date,
            'updated_at' => $date
        ));
    }
}