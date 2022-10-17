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
        Schema::create('prod-cat', function (Blueprint $table) {
            $table->id();
            $table->foreignId('prod')
            ->constrained('product') 
            ->onUpdate('No Action')
            ->onDelete('cascade');
            $table->foreignId('cat')
            ->constrained('category') 
            ->onUpdate('No Action')
            ->onDelete('restrict');
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
        Schema::dropIfExists('prod-cat');
    }
};
