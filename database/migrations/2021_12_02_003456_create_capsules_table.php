<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCapsulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('capsules', function (Blueprint $table) {
            $table->id();
            $table->string('serial_code')->index()->unique();
            $table->string('capsule_id');
            $table->string('status');
            $table->dateTimeTz('original_launch')->nullable();
            $table->unsignedBigInteger('original_launch_unix')->nullable();
            $table->unsignedInteger('landings')->nullable();
            $table->string('type')->nullable();
            $table->longText('details')->nullable();
            $table->unsignedInteger('reuse_count')->nullable();
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
        Schema::dropIfExists('capsules');
    }
}
