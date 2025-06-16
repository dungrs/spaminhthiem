<?php 

namespace App\Services\Customer;
use App\Services\Interfaces\Customer\CustomerCatalogueServiceInterface;
use App\Services\BaseService;

use App\Repositories\Customer\CustomerCatalogueRepository;

use Illuminate\Support\Facades\DB;

class CustomerCatalogueService extends BaseService implements CustomerCatalogueServiceInterface {

    protected $customerCatalogueRepository;

    public function __construct(CustomerCatalogueRepository $customerCatalogueRepository) {
        $this->customerCatalogueRepository = $customerCatalogueRepository;
    }

    public function paginate($request) {
        $perpage = $request->input('perpage') ?? 2;
        $page = $request->integer('page');
        $condition = [
            'keyword' => addslashes($request->input('keyword')),
            'publish' => $request->integer('publish'),
        ];
        $extend['path'] = '/customer/catalogue/index';
        $extend['fieldSearch'] = ['name', 'description'];
        $join = [];
        $customerCatalogues = $this->customerCatalogueRepository->paginate(
            $this->paginateSelect(),
            $condition,
            $perpage,
            $page,
            $extend,
            ['id', 'DESC'],
            $join,
            ['customers']
        );

        if ($customerCatalogues) {
            return response()->json([
                'status' => 'success',
                'data' => $customerCatalogues,
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
            $customerCatalogue = $this->createCustomerCatalogue($request);
            if ($customerCatalogue) {
                DB::commit();
                return response()->json([
                    'status' => 'success',
                    'message' => __('messages.notifications.create_success'),
                ], 200);
            }

        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();
            return response()->json([
                'status' => 'error',
                'message' => __('messages.notifications.create_error')
            ], 500);
        }
    }

    public function update($request, $id) {
        DB::beginTransaction();

        try {
            $flag = $this->updateCustomerCatalogue($request, $id);
            if ($flag) {
                DB::commit();
                return response()->json([
                    'status' => 'success',
                    'message' => __('messages.notifications.update_success'),
                ], 200);
            }

        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();
            return response()->json([
                'status' => 'error',
                'message' => __('messages.notifications.update_error')
            ], 500);
        }
    }

    private function createCustomerCatalogue($request) {
        $payload = $request->only($this->payload());
        return $this->customerCatalogueRepository->create($payload);
    }

    private function updateCustomerCatalogue($request, $id) {
        $payload = $request->only($this->payload());
        return $this->customerCatalogueRepository->update($id, $payload);
    }

    private function payload() {
        return ['phone', 'email', 'name', 'description'];
    }

    public function delete($id) {
        DB::beginTransaction();
    
        try {
            $customerCatalogue = $this->customerCatalogueRepository->findById($id);
            if ($customerCatalogue && $customerCatalogue->customers()->count() > 0) {
                return response()->json([
                    'status' => 'error',
                    'message' => __('messages.customer_catalogue.notifications.delete_error_customers_exist')
                ], 400);
            }
    
            $customerCatalogues = $this->customerCatalogueRepository->delete($id);
            if ($customerCatalogues) {
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

    public function getCustomerCatalogueDetails($id) {
        $customerCatalogue = $this->customerCatalogueRepository->findById($id);
        if ($customerCatalogue) {
            return response()->json([
                'status' => 'success',
                'data' => $customerCatalogue,
            ], 200);
        }
    }


    private function paginateSelect() {
        return [
            'id',
            'name',
            'description',
            'publish',
        ];
    }
}
