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
        Schema::create('equipment', function (Blueprint $table) {
            $table->id();
            $table->string('asset_code', 20)->unique();
            $table->string('name', 150);
            $table->text('specification')->nullable();
            $table->enum{case 'baik', 'rusak_ringan', 'rusak_berat'};
            $table->foreignId('kategori_id')->constrained('kategoris')->restrictOnDelete();
            $table->integer('stok')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bukus');
    }
};
