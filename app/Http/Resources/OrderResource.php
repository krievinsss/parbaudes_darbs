<?php

namespace App\Http\Resources;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'request_number' => $this->request_number,
            'service_type' => $this->service_type,
            'service_type_label' => Order::serviceTypeOptions()[$this->service_type] ?? $this->service_type,
            'status' => $this->status,
            'status_label' => Order::statusOptions()[$this->status] ?? $this->status,
            'position_title' => $this->position_title,
            'vacancies_count' => $this->vacancies_count,
            'employment_type' => $this->employment_type,
            'employment_type_label' => $this->employment_type
                ? (Order::employmentTypeOptions()[$this->employment_type] ?? $this->employment_type)
                : null,
            'location' => $this->location,
            'salary_from' => $this->salary_from,
            'salary_to' => $this->salary_to,
            'description' => $this->description,
            'notes' => $this->notes,
            'submitted_at' => $this->submitted_at?->toDateTimeString(),
            'processed_at' => $this->processed_at?->toDateTimeString(),
            'customer' => new CustomerResource($this->whenLoaded('customer')),
            'user' => $this->whenLoaded('user', function () {
                return [
                    'id' => $this->user->id,
                    'name' => $this->user->name,
                    'email' => $this->user->email,
                ];
            }),
            'created_at' => $this->created_at?->toDateTimeString(),
            'updated_at' => $this->updated_at?->toDateTimeString(),
        ];
    }
}