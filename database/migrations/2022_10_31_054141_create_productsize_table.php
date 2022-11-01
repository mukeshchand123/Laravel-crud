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
        Schema::create('productsize', function (Blueprint $table) {
            $table->id();
            $table->foreignId('prod_id')
            ->constrained('product') 
            ->onUpdate('No Action')
            ->onDelete('cascade');
            $table->foreignId('size_id')
            ->constrained('size') 
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
        Schema::dropIfExists('productsize');
    }
};
