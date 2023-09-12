<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDecisionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('decisions', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Reunion::class)->constrained()->onDelete('cascade');
            $table->string('title')->nullable();
            $table->dateTime('date_end_decision')->nullable();
            $table->string('file')->nullable();
            $table->integer('status')->default(0);
            $table->foreignIdFor(\App\Models\User::class)->constrained()->onDelete('cascade');
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
        Schema::dropIfExists('decisions');
    }
}
