<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('uuid', 50)->unique();
            $table->foreignIdFor(\App\Models\User::class, 'user_id');
            $table->string('event_name', 500);
            $table->tinyInteger('status');
            $table->text('event_description', 1000)->nullable();
            $table->timestamp('event_date')->nullable();

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
        Schema::dropIfExists('events');
    }
};
