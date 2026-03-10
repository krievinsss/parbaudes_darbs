<?php

namespace App\Http\Requests;

use App\Models\Order;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreOrderRequest extends FormRequest
{
    public function authorize(): bool {
        return auth()->check();
    }

    public function rules(): array {
        return [
            'customer_id' => ['required', 'integer', 'exists:customers,id'],
            'request_number' => ['required', 'string', 'max:100', 'unique:orders,request_number'],
            'service_type' => ['required', Rule::in(Order::SERVICE_TYPES)],
            'status' => ['required', Rule::in(Order::STATUSES)],
            'position_title' => ['required', 'string', 'max:255'],
            'vacancies_count' => ['required', 'integer', 'min:1', 'max:10000'],
            'employment_type' => ['nullable', Rule::in(Order::EMPLOYMENT_TYPES)],
            'location' => ['nullable', 'string', 'max:255'],
            'salary_from' => ['nullable', 'numeric', 'min:0'],
            'salary_to' => ['nullable', 'numeric', 'min:0', 'gte:salary_from'],
            'description' => ['nullable', 'string', 'max:5000'],
            'notes' => ['nullable', 'string', 'max:2000'],
            'submitted_at' => ['nullable', 'date'],
            'processed_at' => ['nullable', 'date', 'after_or_equal:submitted_at'],
        ];
    }
}