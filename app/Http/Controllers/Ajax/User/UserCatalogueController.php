<?php

namespace App\Http\Controllers\Ajax\User;

use App\Http\Controllers\BackendController;

use App\Services\User\UserCatalogueService;

use App\Http\Requests\User\StoreUserCatalogueRequest;
use App\Http\Requests\User\UpdateUserCatalogueRequest;

use Illuminate\Http\Request;

class UserCatalogueController extends BackendController
{   
    protected $userCatalogueService; 

    public function __construct(UserCatalogueService $userCatalogueService) {
        $this->userCatalogueService = $userCatalogueService;
    }

    public function filter(Request $request) {
        $userCatalogues = $this->userCatalogueService->paginate($request);
        return $userCatalogues;
    } 

    public function create(StoreUserCatalogueRequest $request) {
        $this->authorize('modules', 'user.catalogue.create');
        $response = $this->userCatalogueService->create($request);
        return $response;
    }

    public function edit($id) {
        $userCatalogue = $this->userCatalogueService->getUserCatalogueDetails($id);
        return $userCatalogue;
    }

    public function update(UpdateUserCatalogueRequest $request, $id) {
        $this->authorize('modules', 'user.catalogue.update');
        $response = $this->userCatalogueService->update($request, $id);
        return $response;
    }

    public function delete($id) {
        $this->authorize('modules', 'user.catalogue.destroy');
        $response = $this->userCatalogueService->delete($id);
        return $response;
    }
}
