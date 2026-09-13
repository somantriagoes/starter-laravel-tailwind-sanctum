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
        Schema::create('prices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained(
                table: 'products',
                indexName: 'price_product_id'
            )->onDelete('restrict')
                ->onUpdate('cascade');
            $table->double('hpp', 10, 2)->default(0.00);
            $table->smallInteger('created_by')->default(0);
            $table->smallInteger('updated_by')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prices');
    }
};
