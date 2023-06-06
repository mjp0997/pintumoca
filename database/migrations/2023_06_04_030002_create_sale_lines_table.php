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
        Schema::create('sale_line', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sale_id')->index()->constrained('sales');
            $table->foreignId('stock_id')->index()->constrained('stocks');
            $table->decimal('price', 12, 2);
            $table->integer('quantity');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sale_line');
    }
};
