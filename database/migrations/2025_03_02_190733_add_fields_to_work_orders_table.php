<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\WorkOrder;
use Illuminate\Support\Carbon;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('work_orders', function (Blueprint $table) {
            if (!Schema::hasColumn('work_orders', 'work_order_id')) {
                $table->string('work_order_id')->after('id')->nullable();
            }

            if (!Schema::hasColumn('work_orders', 'product_name')) {
                $table->string('product_name')->after('content')->nullable();
            }

            if (!Schema::hasColumn('work_orders', 'quantity')) {
                $table->integer('quantity')->after('product_name')->default(0);
            }

            if (!Schema::hasColumn('work_orders', 'production_deadline')) {
                $table->date('production_deadline')->after('quantity')->nullable();
            }

            if (!Schema::hasColumn('work_orders', 'status')) {
                $table->string('status')->after('production_deadline')->default('pending');
            }

            if (!Schema::hasColumn('work_orders', 'responsible_operator')) {
                $table->string('responsible_operator')->after('status')->nullable();
            }
        });

        $workOrders = WorkOrder::whereNull('work_order_id')->orWhere('work_order_id', '')->get();
        foreach ($workOrders as $index => $workOrder) {
            $date = Carbon::now()->format('Ymd');
            $workOrder->work_order_id = 'WO' . $date . str_pad($index + 1, 3, '0', STR_PAD_LEFT);
            $workOrder->saveQuietly();
        }

        if (!Schema::hasTable('work_orders_work_order_id_unique')) {
            Schema::table('work_orders', function (Blueprint $table) {
                $table->unique('work_order_id');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('work_orders', function (Blueprint $table) {
            if (Schema::hasColumn('work_orders', 'work_order_id')) {
                $table->dropUnique(['work_order_id']);
                $table->dropColumn('work_order_id');
            }

            $columns = [
                'product_name',
                'quantity',
                'production_deadline',
                'status',
                'responsible_operator'
            ];

            $existingColumns = [];
            foreach ($columns as $column) {
                if (Schema::hasColumn('work_orders', $column)) {
                    $existingColumns[] = $column;
                }
            }

            if (!empty($existingColumns)) {
                $table->dropColumn($existingColumns);
            }
        });
    }
};
