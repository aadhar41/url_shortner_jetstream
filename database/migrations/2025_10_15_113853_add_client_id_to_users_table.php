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
        Schema::table('users', function (Blueprint $table) {
            // Adds a nullable foreign key column named 'client_id' referencing the 'companies' table.
            // We use 'foreignId' which is shorthand for unsignedBigInteger.
            // onDelete('set null') means if a company is deleted, this user's client_id is set to null.
            $table->foreignId('client_id')
                  ->nullable()
                  ->constrained('users') // Assuming 'users' table holds clients; change if needed
                  ->onDelete('set null')
                  // Placing it after 'company_id' if that column already exists, for clarity.
                  ->after('company_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Drop the foreign key constraint first
            $table->dropConstrainedForeignId('client_id');
            // Then drop the column
            $table->dropColumn('client_id');
        });
    }
};
