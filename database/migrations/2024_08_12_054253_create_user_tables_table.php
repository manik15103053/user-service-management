<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user_tables', function (Blueprint $table) {
            $table->id();
            $table->string('username');
            $table->unsignedBigInteger('service_id')->nullable();
            $table->timestamps();
            // $table->foreign('service_id')->references('id')->on('service_name');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_tables');
    }
};
