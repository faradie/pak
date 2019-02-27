<?php

use Illuminate\Database\Seeder;
use Flynsarmy\CsvSeeder\CsvSeeder;

class positionSeeder extends CsvSeeder
{
	public function __construct()
	{
		$this->table = 'pk_positions';
		$this->filename = base_path().'/database/seeds/csvs/position.csv';
	}
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Recommended when importing larger CSVs
		// DB::disableQueryLog();

    	$this->mapping = [
    		0 => 'id',
    		1 => 'position',
    		2 => 'group',
    	];

    	parent::run();
    }
}
