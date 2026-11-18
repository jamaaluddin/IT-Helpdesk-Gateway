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
        Schema::table('tickets', function (Blueprint $table) {
            $table->string('remote_application')
                ->nullable()
                ->after('handling_method');

            $table->string('remote_address')
                ->nullable()
                ->after('remote_application');

            $table->string('remote_password')
                ->nullable()
                ->after('remote_address');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tickets', function (Blueprint $table) {
            $table->dropColumn([
                'remote_application',
                'remote_address',
                'remote_password',
            ]);
        });
    }
};
