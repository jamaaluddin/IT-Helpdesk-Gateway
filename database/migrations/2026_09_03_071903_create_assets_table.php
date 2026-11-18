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
        Schema::create('assets', function (Blueprint $table) {
            $table->id();

            $table->foreignId('asset_type_id')
                ->constrained('asset_types');

            $table->foreignId('office_id')
                ->constrained('offices');

            $table->foreignId('department_id')
                ->nullable()
                ->constrained('departments')
                ->nullOnDelete();

            $table->string('asset_code')->unique();
            $table->string('name');
            $table->string('brand')->nullable();
            $table->string('model')->nullable();
            $table->string('serial_number')->nullable()->unique();

            $table->enum('condition', [
                'good',
                'minor_damage',
                'major_damage',
                'broken',
            ])->default('good');

            $table->enum('status', [
                'available',
                'in_use',
                'maintenance',
                'damaged',
                'retired',
            ])->default('available');

            $table->date('purchase_date')->nullable();
            $table->text('notes')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assets');
    }
};
