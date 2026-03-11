<?php

namespace App\Policies;

use App\Models\Order;
use App\Models\User;

class OrderPolicy
{
    public function viewAny(User $user): bool {
        return $user->isAdmin() || $user->customer_id !== null;
    }

    public function view(User $user, Order $order): bool {
        return $user->isAdmin() || $order->customer_id === $user->customer_id;
    }

    public function create(User $user): bool {
        return $user->isAdmin() || $user->customer_id !== null;
    }

    public function update(User $user, Order $order): bool {
        return $user->isAdmin() || $order->customer_id === $user->customer_id;
    }

    public function delete(User $user, Order $order): bool {
        return $user->isAdmin() || $order->customer_id === $user->customer_id;
    }
}