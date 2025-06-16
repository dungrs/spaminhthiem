<?php

namespace App\Http\Controllers\Ajax\Customer;

use App\Http\Controllers\BackendController;

use App\Services\Customer\CustomerService;

use App\Http\Requests\Customer\StoreCustomerRequest;
use App\Http\Requests\Customer\UpdateCustomerRequest;

use Illuminate\Http\Request;

class CustomerController extends BackendController
{   
    protected $customerService; 

    public function __construct(CustomerService $customerService) {
        $this->customerService = $customerService;
    }
    
    public function filter(Request $request) {
        $customers = $this->customerService->paginate($request);
        return $customers;
    } 

    public function create(StoreCustomerRequest $request) {
        $this->authorize('modules', 'user.create');
        $response = $this->customerService->create($request);
        return $response;
    }

    public function edit($id) {
        $customer = $this->customerService->getCustomerDetails($id);
        return $customer;
    }

    public function update(UpdateCustomerRequest $request, $id) {
        $this->authorize('modules', 'user.update');
        $response = $this->customerService->update($request, $id);
        return $response;
    }

    public function delete($id) {
        $this->authorize('modules', 'user.destroy');
        $response = $this->customerService->delete($id);
        return $response;
    }
}
