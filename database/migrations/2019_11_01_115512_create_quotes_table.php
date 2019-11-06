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
            $table->decimal('petrol_cost_per_litre', 8, 2);
            $table->decimal('petrol_quantity', 8, 2);
            $table->decimal('electricity_cost_per_unit', 8, 2);
            $table->decimal('electricity_quantity', 8, 2);
            $table->longText('scope_of_work');
            $table->decimal('total_expenses', 8, 2);
            $table->decimal('total_materials', 8, 2);
            $table->decimal('total_wages', 8, 2);
            $table->decimal('other_expenses', 8, 2);
            $table->decimal('consumables', 8, 2);
            $table->decimal('quote_total_excl', 8, 2);
            $table->decimal('quote_tax', 8, 2);
            $table->decimal('quote_total', 8, 2);
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
