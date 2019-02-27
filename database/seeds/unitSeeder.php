<?php

use Illuminate\Database\Seeder;
use Flynsarmy\CsvSeeder\CsvSeeder;

class unitSeeder extends CsvSeeder
{
	public function __construct()
	{
		$this->table = 'units';
		$this->filename = base_path().'/database/seeds/csvs/unit_kerja.csv';
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
			1 => 'workUnit',
			2 => 'position',
		];

		parent::run();
	}
}
