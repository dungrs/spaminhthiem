<?php 

namespace App\Services\User;
use App\Services\Interfaces\User\UserServiceInterface;
use App\Services\BaseService;

use App\Repositories\User\UserRepository;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserService extends BaseService implements UserServiceInterface {

    protected $userRepository;

    public function __construct(UserRepository $userRepository) {
        $this->userRepository = $userRepository;
    }

    public function paginate($request) {
        $perpage = $request->input('perpage', 2);
        $page = $request->integer('page');

        $condition = [
            'keyword' => addslashes($request->input('keyword')),
            'where' => []
        ];

        $publish = $request->integer('publish');

        if (!empty($publish)) {
            $condition['where'][] = ['users.publish', '=', $publish];
        }

        $join = [
            [   
                'table' => 'user_catalogues as uc', 
                'on' => [['uc.id', 'users.user_catalogue_id']]
            ],
        ];
    
        $extend['path'] = '/user/index';
        $extend['fieldSearch'] = ['users.name', 'users.phone', 'users.description', 'users.email'];
    
        $users = $this->userRepository->paginate(
            $this->paginateSelect(),
            $condition,
            $perpage,
            $page,
            $extend,
            ['id', 'DESC'],
            $join,
            ['user_catalogues']
        );

        if ($users) {
            return response()->json([
                'status' => 'success',
                'data' => $users,
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
            $payload['birthday'] = convertDateToDatabaseFormat($payload['birthday']);
            $payload['password'] = Hash::make($payload['password']);
    
            $member = $this->userRepository->create($payload);
    
            if ($member) {
                DB::commit();
                return response()->json([
                    'status' => 'success',
                    'message' => __('messages.notifications.create_success'),
                    'data' => $member,
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
            $payload['birthday'] = convertDateToDatabaseFormat($payload['birthday']);
    
            $member = $this->userRepository->update($id, $payload);
            if ($member) {
                DB::commit();
                return response()->json([
                    'status' => 'success',
                    'message' => __('messages.notifications.update_success'),
                    'data' => $member,
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
            $member = $this->userRepository->delete($id);
    
            if ($member) {
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

    public function getUserDetails($id) {
        $user = $this->userRepository->findById($id);
        if ($user) {
            return response()->json([
                'status' => 'success',
                'data' => $user,
            ], 200);
        }
    }

    private function paginateSelect() {
        return [
            'users.id',
            'users.name',
            'users.description',
            'users.email',
            'users.phone',
            'users.birthday',
            'users.publish',
            'users.address',
            'users.province_id',
            'users.district_id',
            'users.ward_id',
            'users.image',
            'users.user_catalogue_id',
            'uc.name as user_catalogue_name'
        ];
    }
}
