<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('missions', function (Blueprint $table) {
            $table->uuid(column: 'id')->primary();
            $table->string(column: 'reference')->nullable();
            $table->uuid(column: 'organisation_id')->nullable();
            $table->string(column: 'title')->nullable();
            $table->string(column: 'comment')->nullable();
            $table->integer(column: 'deposit')->nullable();
            $table->date(column: 'ended_at')->nullable();
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
        Schema::dropIfExists('missions');
    }
}
