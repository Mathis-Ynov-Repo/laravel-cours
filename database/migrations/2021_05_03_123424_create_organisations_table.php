<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrganisationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organisations', function (Blueprint $table) {
            $table->uuid(column: 'id')->primary();
            $table->string(column: 'slug')->unique();
            $table->string(column: 'email')->nullable();
            $table->string(column: 'name')->nullable();
            $table->string(column: 'phone')->nullable();
            $table->text(column: 'address')->nullable();
            $table->string(column: 'type')->nullable();
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
        Schema::dropIfExists('organisations');
    }
}
