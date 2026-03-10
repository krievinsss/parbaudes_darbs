<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public const STATUSES = ['new', 'processing', 'completed', 'cancelled'];

    protected $fillable = [
        'customer_id',
        'user_id',
        'order_number',
        'status',
        'total_amount',
        'notes',
    ];

    protected function casts(): array {
        return [
            'total_amount' => 'decimal:2',
        ];
    }

    public function customer() {
        return $this->belongsTo(Customer::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function scopeFilter(Builder $query, array $filters): Builder {
        return $query
            ->when($filters['status'] ?? null, fn (Builder $q, $status) => $q->where('status', $status))
            ->when($filters['customer_id'] ?? null, fn (Builder $q, $customerId) => $q->where('customer_id', $customerId));
    }
}