<?php

namespace App\Interfaces;

interface CustomerRepositoryInterface
{
    public function all();

    public function findById(int $customerId);

    public function update(int $customerId);

    public function delete(int $customerId);
}
