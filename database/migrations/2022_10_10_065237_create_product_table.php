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
        Schema::create('product', function (Blueprint $table) {
            $table->id();
            $table->foreignId('userid')
            ->constrained('users') 
            ->onUpdate('No Action')
            ->onDelete('cascade');
          //  $table->foreign('userid')->refrences('id')->on('users') ->onUpdate('No Action')->onDelete('cascade');
            $table->string('name');
            $table->string('price');
            $table->softDeletes(); // deleted_at
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
        Schema::dropIfExists('product');
    }
};
