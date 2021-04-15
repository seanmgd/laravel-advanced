<?php


namespace App\Repositories;

use App\Customer;
use App\Interfaces\CustomerRepositoryInterface;
use Illuminate\Support\Collection;

class CustomerRepository implements CustomerRepositoryInterface
{
    public function all(): Collection
    {
//        return Customer::orderBy('name')
//            ->where('active', 1)
//            ->with('user')
//            ->get()
//            ->map(function ($customer) {
//                return $customer->format();
//            });

        return Customer::orderBy('name')
            ->where('active', 1)
            ->with('user')
            ->get()
            ->map->format();
    }

    public function findById(int $customerId): array
    {
        return Customer::where('id', $customerId)
            ->where('active', 1)
            ->with('user')
            ->firstOrFail()
            ->format();
    }

    public function update(int $customerId): void
    {
        $customer = Customer::where('id', $customerId)->firstOrFail();

        $customer->update(request()->only('name'));
    }

    public function delete(int $customerId): void
    {
        Customer::where('id', $customerId)->delete();
    }
}
