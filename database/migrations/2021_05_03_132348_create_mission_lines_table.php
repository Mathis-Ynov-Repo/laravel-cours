<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMissionLinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mission_lines', function (Blueprint $table) {
            $table->uuid(column: 'id')->primary();
            $table->uuid(column: 'mission_id')->nullable();
            $table->string(column: 'title')->nullable();
            $table->integer(column: 'quantity')->nullable();
            $table->integer(column: 'price')->nullable();
            $table->string(column: 'unity')->nullable();
            $table->foreign('mission_id')->references('id')->on('missions')->onDelete('cascade');
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
        Schema::dropIfExists('mission_lines');
    }
}
