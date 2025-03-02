<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class WorkOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'work_order_id',
        'product_name',
        'quantity',
        'production_deadline',
        'status',
        'responsible_operator'
    ];

    const STATUS_PENDING = 'pending';
    const STATUS_PROGRESS = 'progress';
    const STATUS_COMPLETED = 'completed';
    const STATUS_CANCELED = 'canceled';

    protected $casts = [
        'production_deadline' => 'date',
        'quantity' => 'integer',
    ];

    /**
     * The "booted" method of the model.
     */
    protected static function booted()
    {
        static::creating(function ($workOrder) {
            // Generate work_order_id if not set
            if (empty($workOrder->work_order_id)) {
                $date = Carbon::now()->format('Ymd');
                $latestWorkOrder = self::where('work_order_id', 'like', 'WO' . $date . '%')
                    ->orderBy('id', 'desc')
                    ->first();

                $sequence = 1;
                if ($latestWorkOrder) {
                    $lastSequence = (int) substr($latestWorkOrder->work_order_id, -3);
                    $sequence = $lastSequence + 1;
                }

                $workOrder->work_order_id = 'WO' . $date . str_pad($sequence, 3, '0', STR_PAD_LEFT);
            }

            // Set default status if not set
            if (empty($workOrder->status)) {
                $workOrder->status = self::STATUS_PENDING;
            }
        });
    }

    /**
     * Validate the status value.
     */
    public function setStatusAttribute($value)
    {
        $allowedStatuses = [
            self::STATUS_PENDING,
            self::STATUS_PROGRESS,
            self::STATUS_COMPLETED,
            self::STATUS_CANCELED,
        ];

        if (!in_array($value, $allowedStatuses)) {
            throw new \InvalidArgumentException('Invalid status value');
        }

        $this->attributes['status'] = $value;
    }
}
