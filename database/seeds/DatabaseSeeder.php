<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $this->call(EtablissementSeeder::class);
         $this->call(FiliereSeeder::class);
         $this->call(SystemeSeeder::class);
         $this->call(NiveauSeeder::class);
         $this->call(FraisSeeder::class);
         $this->call(TypeSeeder::class);
    }
}
