<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuoteWagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quote_wages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('quote_id');
            $table->unsignedBigInteger('employee_id');
            $table->integer('employee_no');
            $table->string('employee_name');
            $table->decimal('employee_rateph');
            $table->decimal('employee_dtHours');
            $table->decimal('employee_ntHours');
            $table->decimal('employee_overtimeHours');
            $table->decimal('line_total');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quote_wages');
    }
}
