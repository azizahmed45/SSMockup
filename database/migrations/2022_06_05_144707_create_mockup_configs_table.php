<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMockupConfigsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mockup_configs', function (Blueprint $table) {
            $table->id();
            $table->integer('left')->default(0);
            $table->integer('top')->default(0);
            $table->integer('right')->default(0);
            $table->integer('bottom')->default(0);
            $table->unsignedBigInteger('mockup_id')->nullable();
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
        Schema::dropIfExists('mockup_configs');
    }
}
