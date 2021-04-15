<?php

namespace App\Http\Controllers;

use App\Interfaces\CustomerRepositoryInterface;
use Illuminate\Http\RedirectResponse;

class CustomerController extends Controller
{
    /**
     * @var CustomerRepositoryInterface
     */
    private $customerRepository;

    public function __construct(CustomerRepositoryInterface $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    public function index()
    {
        $customers = $this->customerRepository->all();

        return $customers;
    }

    public function show(int $customerId): array
    {
        $customer = $this->customerRepository->findById($customerId);

        return $customer;
    }

    public function update(int $customerId): RedirectResponse
    {
        $this->customerRepository->update($customerId);

        return redirect('/customer/' . $customerId);
    }

    public function destroy(int $customerId): RedirectResponse
    {
        $this->customerRepository->delete($customerId);

        return redirect('/customers')->with('success');
    }
}
