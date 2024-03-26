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
        Schema::create('tenants', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('database_name')->unique();
            $table->string('email');
            $table->string('api_key')->nullable();
            $table->string('address')->nullable();
            $table->string('contact_no')->nullable();
            $table->string('logo')->nullable();
            $table->string('url')->nullable();
            $table->string('established_year')->nullable();
            $table->string('pan_no')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tenants');
    }
};
