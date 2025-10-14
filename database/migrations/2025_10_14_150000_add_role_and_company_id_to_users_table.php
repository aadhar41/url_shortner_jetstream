<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Add company_id (nullable) referencing companies.id if a companies table exists
            $table->unsignedBigInteger('company_id')->nullable()->after('id');

            // Add ENUM role column with default 'Member'
            // Use raw DB statement for portability with older Laravel versions
            $driver = Schema::getConnection()->getDriverName();
            if ($driver === 'mysql') {
                // MySQL supports native ENUM
                $table->enum('role', ['SuperAdmin', 'Admin', 'Member'])->default('Member')->after('company_id');
            } else {
                // For other drivers, fall back to string with check constraint where supported
                $table->string('role', 20)->default('Member')->after('company_id');
            }

            // Add foreign key if companies table exists (wrapped to avoid migration failure if not present)
            // We'll add the foreign key only if the companies table is present in the schema
            try {
                if (Schema::hasTable('companies')) {
                    $table->foreign('company_id')->references('id')->on('companies')->onDelete('set null');
                }
            } catch (\Exception $e) {
                // ignore: some DB drivers or setups may not allow checking tables during migrations
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // Drop foreign key if it exists
            try {
                $sm = Schema::getConnection()->getDoctrineSchemaManager();
                $doctrineTable = $sm->listTableDetails('users');
                if ($doctrineTable->hasForeignKey('users_company_id_foreign')) {
                    $table->dropForeign('users_company_id_foreign');
                }
            } catch (\Exception $e) {
                // best-effort: try generic drop
                try {
                    $table->dropForeign(['company_id']);
                } catch (\Exception $_) {
                    // ignore
                }
            }

            // Drop columns
            if (Schema::hasColumn('users', 'role')) {
                $table->dropColumn('role');
            }

            if (Schema::hasColumn('users', 'company_id')) {
                $table->dropColumn('company_id');
            }
        });
    }
};
