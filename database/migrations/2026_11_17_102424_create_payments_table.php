<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ticket_id')->constrained()->onDelete('cascade');
            $table->decimal('amount', 8, 2);
            $table->enum('payment_method', ['E-Dahab', 'Zaad', 'Cash', 'Card'])->default('Zaad');
            $table->enum('status', ['Paid', 'Pending', 'Failed'])->default('Paid');
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('payments');
    }
};