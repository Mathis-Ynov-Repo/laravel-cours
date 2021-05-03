<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContributionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contributions', function (Blueprint $table) {
            $table->uuid(column: 'id')->primary();
            $table->integer(column: 'price')->nullable();
            $table->string(column: 'title')->nullable();
            $table->text(column: 'comment')->nullable();
            $table->uuid(column: 'organisation_id')->nullable();
            $table->foreign('organisation_id')->references('id')->on('organisations');

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
        Schema::dropIfExists('contributions');
    }
}
