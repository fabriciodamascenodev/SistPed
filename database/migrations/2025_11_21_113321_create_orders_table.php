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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained()->cascadeOnDelete();
            // Forma de Pagamento (cash = à vista, billed = faturado)
            $table->string('payment_method');
            // Total do Pedido
            $table->decimal('total_amount', 10, 2)->nullable();   
            // Status (opcional, mas recomendado)
            $table->string('status')->default('pending');         
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
