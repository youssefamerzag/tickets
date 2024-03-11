<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up() {
        schema::create('tickets' , function(Blueprint $table){
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('type');
            $table->string('status')->default('Open');
            $table->foreignId('user_id');
            $table->file('file');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
