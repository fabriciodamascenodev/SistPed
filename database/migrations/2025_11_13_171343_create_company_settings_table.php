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
        Schema::create('company_settings', function (Blueprint $table) {
            $table->id();
            $table->string('company_name'); 
            $table->string('trade_name')->nullable(); 
            $table->string('cnpj')->unique(); 
            $table->string('logo')->nullable(); 
            $table->string('cep')->nullable(); 
            $table->string('address'); 
            $table->string('complement')->nullable(); 
            $table->string('district'); 
            $table->string('city'); 
            $table->string('state', 2); 
            $table->string('phone'); 
            $table->string('responsible')->nullable(); 
            $table->string('website')->nullable(); 
            $table->string('email')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_settings');
    }
};
