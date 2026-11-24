<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('berita_acara', function (Blueprint $table) {
            $table->id();

            // Informasi dokumen
            $table->string('document_number')->unique();
            $table->string('title');
            $table->string('document_type');
            $table->date('document_date');

            // Isi dokumen fleksibel
            $table->longText('content');

            // Data opsional
            $table->json('related_parties')->nullable();
            $table->json('signature_blocks')->nullable();

            // Pembuat dokumen
            $table->foreignId('created_by')
                ->constrained('users')
                ->restrictOnDelete();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('berita_acara');
    }
};
