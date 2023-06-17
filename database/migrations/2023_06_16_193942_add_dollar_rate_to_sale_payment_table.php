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
            $table->decimal('dollar_rate', 12, 2)->after('amount')->nullable()->default(0.00);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sale_payment', function (Blueprint $table) {
            $table->dropColumn('dollar_rate');
        });
    }
};
