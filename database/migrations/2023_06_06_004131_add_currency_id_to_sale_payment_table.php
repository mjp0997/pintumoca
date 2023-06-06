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
        Schema::table('sale_payment', function (Blueprint $table) {
            $table->foreignId('currency_id')->after('sale_id')->index()->constrained('currencies');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sale_payment', function (Blueprint $table) {
            $table->dropConstrainedForeignId('currency_id');
        });
    }
};
