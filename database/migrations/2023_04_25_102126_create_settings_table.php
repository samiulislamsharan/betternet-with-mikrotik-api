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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('router_ip');
            $table->string('router_username');
            $table->string('router_password');
            $table->string('mail_server')->nullable();
            $table->string('mail_username')->nullable();
            $table->string('mail_password')->nullable();
            $table->integer('mail_port')->nullable();
            $table->integer('mail_from_address')->nullable();
            $table->integer('mail_from_name')->nullable();
            $table->string('app_name')->nullable();
            $table->string('db')->nullable();
            $table->string('db_username')->nullable();
            $table->string('db_password')->nullable();
            $table->string('timezone')->nullable();
            $table->string('currency')->nullable();
            $table->unsignedInteger('bill_at')->default(0)->nullable();
            $table->unsignedInteger('disconnect_at')->default(0)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
