<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('quote_id');
            $table->string('employee');
            $table->decimal('employee_rate_per_hour', 8, 2);
            $table->decimal('normal_hours', 8, 2)->nullable();
            $table->decimal('overtime_hours', 8, 2)->nullable();
            $table->decimal('doubletime_hours', 8, 2)->nullable();
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
        Schema::dropIfExists('wages');
    }
}
