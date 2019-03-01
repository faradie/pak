<?php

use Illuminate\Database\Seeder;
use Flynsarmy\CsvSeeder\CsvSeeder;

class AdministrationSeeder extends CsvSeeder
{
	public function __construct()
	{
		$this->table = 'item_administrations';
		$this->filename = base_path().'/database/seeds/csvs/administration.csv';
	}
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->mapping = [
    		0 => 'id',
    		1 => 'item_name',
    	];

    	parent::run();
    }
}
