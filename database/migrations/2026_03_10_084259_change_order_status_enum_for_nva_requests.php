<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("
            ALTER TABLE orders
            MODIFY status ENUM(
                'draft',
                'submitted',
                'in_review',
                'approved',
                'rejected',
                'completed'
            ) NOT NULL DEFAULT 'draft'
        ");
    }

    public function down(): void
    {
        DB::statement("
            ALTER TABLE orders
            MODIFY status ENUM(
                'new',
                'processing',
                'completed',
                'cancelled'
            ) NOT NULL DEFAULT 'new'
        ");
    }
};