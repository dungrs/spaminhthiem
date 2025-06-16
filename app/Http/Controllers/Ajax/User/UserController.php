<?php

namespace App\Http\Controllers\Ajax\User;

use App\Http\Controllers\BackendController;

use App\Services\User\UserService;

use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;

use Illuminate\Http\Request;

class UserController extends BackendController
{   
    protected $userService; 

    public function __construct(UserService $userService) {
        $this->userService = $userService;
    }
    
    public function filter(Request $request) {
        $users = $this->userService->paginate($request);
        return $users;
    } 

    public function create(StoreUserRequest $request) {
        $this->authorize('modules', 'user.create');
        $response = $this->userService->create($request);
        return $response;
    }

    public function edit($id) {
        $user = $this->userService->getUserDetails($id);
        return $user;
    }

    public function update(UpdateUserRequest $request, $id) {
        $this->authorize('modules', 'user.update');
        $response = $this->userService->update($request, $id);
        return $response;
    }

    public function delete($id) {
        $this->authorize('modules', 'user.destroy');
        $response = $this->userService->delete($id);
        return $response;
    }
}
