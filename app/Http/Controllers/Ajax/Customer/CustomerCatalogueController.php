<?php

namespace App\Http\Controllers\Ajax\Customer;

use App\Http\Controllers\BackendController;

use App\Services\Customer\CustomerCatalogueService;

use App\Http\Requests\Customer\StoreCustomerCatalogueRequest;
use App\Http\Requests\Customer\UpdateCustomerCatalogueRequest;

use Illuminate\Http\Request;

class CustomerCatalogueController extends BackendController
{   
    protected $customerCatalogueService; 

    public function __construct(CustomerCatalogueService $customerCatalogueService) {
        $this->customerCatalogueService = $customerCatalogueService;
    }

    public function filter(Request $request) {
        $customerCatalogues = $this->customerCatalogueService->paginate($request);
        return $customerCatalogues;
    } 

    public function create(StoreCustomerCatalogueRequest $request) {
        $this->authorize('modules', 'customer.catalogue.create');
        $response = $this->customerCatalogueService->create($request);
        return $response;
    }

    public function edit($id) {
        $customerCatalogue = $this->customerCatalogueService->getCustomerCatalogueDetails($id);
        return $customerCatalogue;
    }

    public function update(UpdateCustomerCatalogueRequest $request, $id) {
        $this->authorize('modules', 'customer.catalogue.update');
        $response = $this->customerCatalogueService->update($request, $id);
        return $response;
    }

    public function delete($id) {
        $this->authorize('modules', 'customer.catalogue.destroy');
        $response = $this->customerCatalogueService->delete($id);
        return $response;
    }
}
