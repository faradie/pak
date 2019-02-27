<?php

use Illuminate\Database\Seeder;
use Flynsarmy\CsvSeeder\CsvSeeder;

class itemSeeder extends CsvSeeder
{
	public function __construct()
	{
		$this->table = 'items';
		$this->filename = base_path().'/database/seeds/csvs/items.csv';
        $this->mapping = [
            0 => 'id',
            1 => 'item_name',
            2 => 'unitResult',
            3 => 'point',
            4 => 'assessmentLimits',
            5 => 'executor',
            6 => 'physicalEvidence',
            7 => 'type',
        ];
	}
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // // Recommended when importing larger CSVs
        // DB::disableQueryLog();

        // // Uncomment the below to wipe the table clean before populating
        // DB::table($this->table)->truncate();
        $this->mapping = [
            0 => 'id',
            1 => 'item_name',
            2 => 'unitResult',
            3 => 'point',
            4 => 'assessmentLimits',
            5 => 'executor',
            6 => 'physicalEvidence',
            7 => 'type',
        ];

    	parent::run();
    }
}
