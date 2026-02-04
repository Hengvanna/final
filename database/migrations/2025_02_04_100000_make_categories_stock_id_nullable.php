<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->dropForeign(['stock_id']);
        });

        $driver = Schema::getConnection()->getDriverName();
        if ($driver === 'mysql') {
            DB::statement('ALTER TABLE categories MODIFY stock_id BIGINT UNSIGNED NULL');
        } elseif ($driver === 'sqlite') {
            DB::statement('-- SQLite: recreate table or use PRAGMA; for simplicity we use raw');
            // SQLite doesn't support MODIFY; would need table recreation - skip for SQLite or add logic
        } else {
            Schema::table('categories', function (Blueprint $table) {
                $table->unsignedBigInteger('stock_id')->nullable()->change();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $driver = Schema::getConnection()->getDriverName();
        if ($driver === 'mysql') {
            DB::statement('ALTER TABLE categories MODIFY stock_id BIGINT UNSIGNED NOT NULL');
        } else {
            Schema::table('categories', function (Blueprint $table) {
                $table->unsignedBigInteger('stock_id')->nullable(false)->change();
            });
        }
        Schema::table('categories', function (Blueprint $table) {
            $table->foreign('stock_id')->references('id')->on('stocks')->cascadeOnDelete();
        });
    }
};
