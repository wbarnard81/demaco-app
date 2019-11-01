<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quotes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('customer');
            $table->decimal('petrol_quantity');
            $table->decimal('electricity_quantity');
            $table->longText('sow');
            $table->decimal('other_expenses');
            $table->decimal('consumables');
            $table->timestamps();
        });
        DB::update("ALTER TABLE quotes AUTO_INCREMENT = 1000;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quotes');
    }
}
