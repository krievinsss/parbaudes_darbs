<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public const STATUSES = [
        'draft',
        'submitted',
        'in_review',
        'approved',
        'rejected',
        'completed',
    ];

    public const SERVICE_TYPES = [
        'vacancy_registration',
        'candidate_selection',
        'training_request',
        'employment_support',
        'layoff_support',
    ];

    public const EMPLOYMENT_TYPES = [
        'full_time',
        'part_time',
        'fixed_term',
        'internship',
        'remote',
        'hybrid',
    ];

    protected $fillable = [
        'customer_id',
        'user_id',
        'request_number',
        'service_type',
        'status',
        'position_title',
        'vacancies_count',
        'employment_type',
        'location',
        'salary_from',
        'salary_to',
        'description',
        'notes',
        'submitted_at',
        'processed_at',
    ];

    protected function casts(): array {
        return [
            'salary_from' => 'decimal:2',
            'salary_to' => 'decimal:2',
            'submitted_at' => 'datetime',
            'processed_at' => 'datetime',
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
            ->when($filters['customer_id'] ?? null, fn (Builder $q, $customerId) => $q->where('customer_id', $customerId))
            ->when($filters['service_type'] ?? null, fn (Builder $q, $serviceType) => $q->where('service_type', $serviceType));
    }

    public static function serviceTypeOptions(): array {
        return [
            'vacancy_registration' => 'Vakances reģistrācija',
            'candidate_selection' => 'Kandidātu atlase',
            'training_request' => 'Apmācību pieprasījums',
            'employment_support' => 'Nodarbinātības atbalsts',
            'layoff_support' => 'Atbalsts kolektīvās atlaišanas gadījumā',
        ];
    }

    public static function statusOptions(): array {
        return [
            'draft' => 'Melnraksts',
            'submitted' => 'Iesniegts',
            'in_review' => 'Izskatīšanā',
            'approved' => 'Apstiprināts',
            'rejected' => 'Noraidīts',
            'completed' => 'Pabeigts',
        ];
    }

    public static function employmentTypeOptions(): array {
        return [
            'full_time' => 'Pilna slodze',
            'part_time' => 'Nepilna slodze',
            'fixed_term' => 'Noteikts termiņš',
            'internship' => 'Prakse',
            'remote' => 'Attālināti',
            'hybrid' => 'Hibrīds',
        ];
    }
}