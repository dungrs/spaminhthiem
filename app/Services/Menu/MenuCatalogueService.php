<?php 

namespace App\Services\Menu;

use App\Services\Interfaces\Menu\MenuCatalogueServiceInterface;
use App\Services\BaseService;

use App\Repositories\Menu\MenuCatalogueRepository;

use Illuminate\Support\Facades\DB;

class MenuCatalogueService extends BaseService implements MenuCatalogueServiceInterface {
    protected $menuCatalogueRepository;

    public function __construct(MenuCatalogueRepository $menuCatalogueRepository) {
        $this->menuCatalogueRepository = $menuCatalogueRepository;
    }

    public function paginate($request) {
        $perpage = $request->input('perpage');
        $page = $request->integer('page');
        $condition = [
            'keyword' => addslashes($request->input('keyword')),
            'publish' => $request->integer('publish'),
        ];
        $extend['path'] = '/menu/catalogue/index';
        $extend['fieldSearch'] = ['name', 'keyword'];

        $menuCatalogues = $this->menuCatalogueRepository->paginate(
            $this->paginateSelect(),
            $condition,
            $perpage,
            $page,
            $extend,
            ['menu_catalogues.id', 'DESC'],
        );

        if ($menuCatalogues) {
            return response()->json([
                'status' => 'success',
                'data' => $menuCatalogues,
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
            $payload = $request->only('name', 'keyword');
            $menuCatalogue = $this->menuCatalogueRepository->create($payload);

            DB::commit();
            return response()->json([
                'status' => 'success',
                'message' => __('messages.notifications.create_success'),
                'data' => $menuCatalogue,
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();
            return response()->json([
                'status' => 'error',
                'message' => __('messages.notifications.create_error')
            ], 500);
        }
    }

    public function delete($id) {
        DB::beginTransaction();
    
        try {
            $this->menuCatalogueRepository->delete($id);

            DB::commit();
            return response()->json([
                'status' => 'success',
                'message' => __('messages.notifications.delete_success'),
            ], 200);
    
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => 'error',
                'message' => __('messages.notifications.delete_error')
            ], 500);
        }
    }

    public function getMenuCatalogues() {
        return $this->menuCatalogueRepository->all();
    }

    public function getMenuCatalogueById($id) {
        return $this->menuCatalogueRepository->findById($id);
    }

    private function paginateSelect() {
        return [
            'menu_catalogues.id',
            'menu_catalogues.name',
            'menu_catalogues.keyword',
            'menu_catalogues.publish',
        ];
    }
}