<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('request_number')->nullable()->after('user_id');
            $table->string('service_type')->nullable()->after('request_number');
            $table->string('position_title')->nullable()->after('service_type');
            $table->unsignedInteger('vacancies_count')->default(1)->after('position_title');
            $table->string('employment_type')->nullable()->after('vacancies_count');
            $table->string('location')->nullable()->after('employment_type');
            $table->decimal('salary_from', 10, 2)->nullable()->after('location');
            $table->decimal('salary_to', 10, 2)->nullable()->after('salary_from');
            $table->text('description')->nullable()->after('salary_to');
            $table->timestamp('submitted_at')->nullable()->after('notes');
            $table->timestamp('processed_at')->nullable()->after('submitted_at');
        });


        if (Schema::hasColumn('orders', 'order_number')) {
            DB::table('orders')->update([
                'request_number' => DB::raw('order_number')
            ]);
        }

        $orders = DB::table('orders')->select('id', 'request_number')->get();

        foreach ($orders as $order) {
            if (empty($order->request_number)) {
                DB::table('orders')
                    ->where('id', $order->id)
                    ->update([
                        'request_number' => 'REQ-' . str_pad((string) $order->id, 5, '0', STR_PAD_LEFT)
                    ]);
            }
        }

        if (Schema::hasColumn('orders', 'status')) {
            DB::table('orders')->where('status', 'new')->update(['status' => 'draft']);
            DB::table('orders')->where('status', 'processing')->update(['status' => 'in_review']);
            DB::table('orders')->where('status', 'completed')->update(['status' => 'completed']);
            DB::table('orders')->where('status', 'cancelled')->update(['status' => 'rejected']);
        }

        Schema::table('orders', function (Blueprint $table) {
            if (Schema::hasColumn('orders', 'order_number')) {
                $table->dropUnique(['order_number']);
                $table->dropColumn('order_number');
            }

            if (Schema::hasColumn('orders', 'total_amount')) {
                $table->dropColumn('total_amount');
            }
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->unique('request_number');
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('order_number')->nullable()->after('user_id');
            $table->decimal('total_amount', 10, 2)->default(0)->after('status');
        });

        DB::table('orders')->update([
            'order_number' => DB::raw('request_number')
        ]);

        DB::table('orders')->where('status', 'draft')->update(['status' => 'new']);
        DB::table('orders')->where('status', 'in_review')->update(['status' => 'processing']);
        DB::table('orders')->where('status', 'completed')->update(['status' => 'completed']);
        DB::table('orders')->where('status', 'rejected')->update(['status' => 'cancelled']);

        Schema::table('orders', function (Blueprint $table) {
            $table->unique('order_number');

            $table->dropUnique(['request_number']);
            $table->dropColumn([
                'request_number',
                'service_type',
                'position_title',
                'vacancies_count',
                'employment_type',
                'location',
                'salary_from',
                'salary_to',
                'description',
                'submitted_at',
                'processed_at',
            ]);
        });
    }
};