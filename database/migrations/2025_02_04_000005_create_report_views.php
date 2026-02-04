<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Creates logical report views (not real tables).
     */
    public function up(): void
    {
        $driver = DB::connection()->getDriverName();

        if ($driver === 'mysql') {
            DB::statement('
                CREATE VIEW sale_report AS
                SELECT
                    s.name AS stock_name,
                    COALESCE(SUM(sa.qty), 0) AS total_qty,
                    COALESCE(SUM(sa.total), 0) AS total_amount
                FROM stocks s
                LEFT JOIN sales sa ON s.id = sa.stock_id
                GROUP BY s.id, s.name
            ');
            DB::statement('
                CREATE VIEW stock_report AS
                SELECT
                    name AS stock_name,
                    qty,
                    price,
                    (qty * price) AS stock_value
                FROM stocks
            ');
        } else {
            // SQLite and others
            DB::statement('
                CREATE VIEW sale_report AS
                SELECT
                    s.name AS stock_name,
                    COALESCE(SUM(sa.qty), 0) AS total_qty,
                    COALESCE(SUM(sa.total), 0) AS total_amount
                FROM stocks s
                LEFT JOIN sales sa ON s.id = sa.stock_id
                GROUP BY s.id, s.name
            ');
            DB::statement('
                CREATE VIEW stock_report AS
                SELECT
                    name AS stock_name,
                    qty,
                    price,
                    (qty * price) AS stock_value
                FROM stocks
            ');
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('DROP VIEW IF EXISTS sale_report');
        DB::statement('DROP VIEW IF EXISTS stock_report');
    }
};
