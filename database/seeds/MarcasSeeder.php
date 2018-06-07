<?php

use Illuminate\Database\Seeder;

class MarcasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('marca_moto')->insert([
			["nombre"=> "APRILIA"],
			["nombre"=> "BENELLI"],
			["nombre"=> "BETA"],
			["nombre"=> "BMW"],
			["nombre"=> "BUELL"],
			["nombre"=> "BULTACO"],
			["nombre"=> "CAGIVA"],
			["nombre"=> "DAELIM"],
			["nombre"=> "DERBI"],
			["nombre"=> "DUCATI"],
			["nombre"=> "GASGAS"],
			["nombre"=> "GILERA"],
			["nombre"=> "HARLEY DAVIDSON"],
			["nombre"=> "HM"],
			["nombre"=> "HONDA"],
			["nombre"=> "HUSABERG"],
			["nombre"=> "HUSQVARNA"],
			["nombre"=> "HYOSUNG"],
			["nombre"=> "KAWASAKI"],
			["nombre"=> "KEEWAY"],
			["nombre"=> "KTM"],
			["nombre"=> "KYMCO"],
			["nombre"=> "MALAGUTI"],
			["nombre"=> "MECATECNO"],
			["nombre"=> "MONTESA"],
			["nombre"=> "MORINI"],
			["nombre"=> "MOTO GUZZI"],
			["nombre"=> "MOTOR HISPANIA"],
			["nombre"=> "MV AGUSTA"],
			["nombre"=> "OSSA"],
			["nombre"=> "PEUGEOT"],
			["nombre"=> "PIAGGIO"],
			["nombre"=> "RIEJU"],
			["nombre"=> "SHERCO"],
			["nombre"=> "SUZUKI"],
			["nombre"=> "SYM"],
			["nombre"=> "TRIUMPH"],
			["nombre"=> "VESPA"],
			["nombre"=> "YAMAHA"],
			["nombre"=> "MASH"]
		]);
    }
}
