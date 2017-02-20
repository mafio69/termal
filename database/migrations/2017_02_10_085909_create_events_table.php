<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedMediumInteger('user_id');
            $table->unsignedTinyInteger('event_type_id');
            $table->unsignedInteger('customer_id')->nullable();
            $table->unsignedInteger('person_id')->nullable();
            $table->unsignedInteger('project_id')->nullable();
            $table->string('phone',20)->nullable();
            $table->string('email',60)->nullable();
            $table->dateTime('event_data');
            $table->string('title',40);
            $table->mediumText('description');
            $table->unsignedTinyInteger('activ')->nullable();
            $table->timestamps();
            $table->softDeletes();
         });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
}
