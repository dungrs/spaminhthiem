<?php 

namespace App\Services;
use App\Services\Interfaces\SourceServiceInterface;
use App\Services\BaseService;

use App\Repositories\SourceRepository;
use App\Repositories\RouterRepository;

use Illuminate\Support\Facades\DB;

class SourceService extends BaseService implements SourceServiceInterface {

    protected $sourceRepository;
    protected $routerRepository;

    public function __construct(SourceRepository $sourceRepository, RouterRepository $routerRepository) {
        $this->sourceRepository = $sourceRepository;
        $this->routerRepository = $routerRepository;
    }

    public function paginate($request) {
        $perpage = $request->input('perpage') ?? 1;
        $page = $request->integer('page');
        $condition = [
            'keyword' => addslashes($request->input('keyword')),
            'publish' => $request->integer('publish'),
        ];
        $extend['path'] = '/source/index';
        $extend['fieldSearch'] = ['name', 'description', 'keyword'];
        $sources = $this->sourceRepository->paginate(
            $this->paginateSelect(),
            $condition,
            $perpage,
            $page,
            $extend,
            ['id', 'DESC'],
        );

        if ($sources) {
            return response()->json([
                'status' => 'success',
                'data' => $sources,
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
            $sources = $this->sourceRepository->create($payload);
            if ($sources) {
                DB::commit();
                return response()->json([
                    'status' => 'success',
                    'message' => __('messages.notifications.create_success'),
                    'data' => $sources,
                ], 200);
            }

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
            $sources = $this->sourceRepository->update($id, $payload);
            if ($sources) {
                DB::commit();
                return response()->json([
                    'status' => 'success',
                    'message' => __('messages.notifications.update_success'),
                    'data' => $sources,
                ], 200);
            }

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
            $sources = $this->sourceRepository->delete($id);
    
            if ($sources) {
                DB::commit();
                return response()->json([
                    'status' => 'success',
                    'message' => __('messages.notifications.delete_success'),
                ], 200);
            }
    
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => 'error',
                'message' => __('messages.notifications.delete_error')
            ], 500);
        }
    }

    public function getSourceDetails($id) {
        $source = $this->sourceRepository->findById($id);
        return $this->jsonResponse($source);
    }
    
    public function getAll($ajax = true) {
        $source = $this->sourceRepository->all();
        if ($ajax) {
            return $this->jsonResponse($source);
        } else {
            return $source;
        }
    }
    
    private function jsonResponse($data){
        if ($data) {
            return response()->json([
                'status' => 'success',
                'data' => $data,
            ], 200);
        }
    
        return response()->json([
            'status' => 'error',
            'message' => 'Lấy dữ liệu không thành công.',
        ], 404);
    }

    private function paginateSelect() {
        return [
            'id',
            'name',
            'description',
            'publish',
            'keyword',
        ];
    }
}