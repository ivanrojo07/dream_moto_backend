<?php

use Illuminate\Database\Seeder;

class VersionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('version_moto')->insert([
        	
			[
				"nombre"=>"125",
				"modelo_id"=>"1",
			],
			
			[
				"nombre"=>"250",
				"modelo_id"=>"1",
			],
			
			[
				"nombre"=>"500",
				"modelo_id"=>"1",
			],
			
			[
				"nombre"=>"500 SPRINT",
				"modelo_id"=>"1",
			],

			[
				"nombre"=>"125",
				"modelo_id"=>"2"
			],
			
			[
				"nombre"=>"250",
				"modelo_id"=>"2"
			],
			
			[
				"nombre"=>"500 SPRINT",
				"modelo_id"=>"2"
			],
			

        ]);
    }
}
