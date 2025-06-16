<?php 

namespace App\Services;

use App\Services\Interfaces\PermissionServiceInterface;
use App\Services\BaseService;

use App\Repositories\PermissionRepository;

use Illuminate\Support\Facades\DB;

class PermissionService extends BaseService implements PermissionServiceInterface {

    protected $permissionRepository;

    public function __construct(PermissionRepository $permissionRepository) {
        $this->permissionRepository = $permissionRepository;
    }

    public function paginate($request) {
        $perpage = $request->input('perpage', 2);
        $page = $request->integer('page');

        $condition = [
            'keyword' => addslashes($request->input('keyword')),
        ];
    
        $extend['path'] = '/permission/index';
        $extend['fieldSearch'] = ['name', 'canonical'];
    
        $permissions = $this->permissionRepository->paginate(
            $this->paginateSelect(),
            $condition,
            $perpage,
            $page,
            $extend,
            ['id', 'DESC'],
        );

        if ($permissions) {
            return response()->json([
                'status' => 'success',
                'data' => $permissions,
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => "Lấy dữ liệu không thành công!"
            ], 500);
        }
    }

    public function create($request) {
        DB::beginTransaction();
    
        try {
            $payload = $request->except('_token');
            $flag = $this->permissionRepository->create($payload);
            if ($flag) {
                DB::commit();
                return response()->json([
                    'status' => 'success',
                    'message' => __('messages.notifications.create_success'),
                    'data' => $flag,
                ], 201);
            }
    
            throw new \Exception(__('messages.notifications.create_error'));
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => 'error',
                'message' => __('messages.notifications.create_error')
            ], 500);
        }
    }
    
    public function update($request, $id) {
        DB::beginTransaction();
    
        try {
            $payload = $request->except('_token');
            $flag = $this->permissionRepository->update($id, $payload);
            if ($flag) {
                DB::commit();
                return response()->json([
                    'status' => 'success',
                    'message' => __('messages.notifications.update_success'),
                    'data' => $flag,
                ], 200);
            }
    
            throw new \Exception(__('messages.notifications.no_changes'));
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => 'error',
                'message' => __('messages.notifications.update_error')
            ], 500);
        }
    }
    
    public function delete($id) {
        DB::beginTransaction();
    
        try {
            $flag = $this->permissionRepository->delete($id);
    
            if ($flag) {
                DB::commit();
                return response()->json([
                    'status' => 'success',
                    'message' => __('messages.notifications.delete_success'),
                ], 200);
            }
    
            throw new \Exception(__('messages.notifications.not_found'));
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => 'error',
                'message' => __('messages.notifications.delete_error')
            ], 500);
        }
    }

    public function getPermissionDetails($id) {
        $permission = $this->permissionRepository->findById($id);
        if ($permission) {
            return response()->json([
                'status' => 'success',
                'data' => $permission,
            ], 200);
        }
    }

    private function paginateSelect() {
        return [
            'id',
            'name',
            'canonical',
        ];
    }
}
