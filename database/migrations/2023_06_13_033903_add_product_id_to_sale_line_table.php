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
        Schema::table('sale_line', function (Blueprint $table) {
            $table->foreignId('product_id')->after('sale_id')->index()->constrained('products');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints();

        Schema::table('sale_line', function (Blueprint $table) {
            $table->dropConstrainedForeignId('product_id');
        });

        Schema::enableForeignKeyConstraints();
    }
};
