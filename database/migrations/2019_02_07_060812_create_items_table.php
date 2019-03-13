<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->string('id')->unique()->primary();
            $table->string('item_name',255);
            $table->string('unitResult');
            $table->decimal('point', 8, 4);
            $table->string('assessmentLimits');
            $table->string('executor');
            $table->string('physicalEvidence');
            $table->string('type');
            $table->longText('info');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('items');
    }
}
