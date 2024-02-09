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
        Schema::create('details', function (Blueprint $table) {
            $table->id();
            $table->string('address');
            $table->string('phone');
            $table->date('dob');
            $table->string('pin')->nullable();
            $table->string('router_password');
            $table->string('package_name');
            $table->unsignedInteger('package_price');
            $table->date('package_start');
            $table->unsignedInteger('due');
            $table->string('status')->default('active');
            $table->foreignId('user_id')->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('details');
    }
};
