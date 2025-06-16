<?php 

namespace App\Services\Customer;
use App\Services\Interfaces\Customer\CustomerServiceInterface;
use App\Services\BaseService;

use App\Repositories\Customer\CustomerRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CustomerService extends BaseService implements CustomerServiceInterface {

    protected $customerRepository;

    public function __construct(CustomerRepository $customerRepository) {
        $this->customerRepository = $customerRepository;
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
            $condition['where'][] = ['customers.publish', '=', $publish];
        }

        $join = [
            [   
                'type' => 'left',
                'table' => 'customer_catalogues as cl', 
                'on' => [['cl.id', 'customers.customer_catalogue_id']]
            ],
        ];
    
        $extend['path'] = '/customer/index';
        $extend['fieldSearch'] = ['customers.name', 'customers.phone', 'customers.description', 'customers.email'];
    
        $customers = $this->customerRepository->paginate(
            $this->paginateSelect(),
            $condition,
            $perpage,
            $page,
            $extend,
            ['id', 'DESC'],
            $join,
            ['customer_catalogues']
        );

        if ($customers) {
            return response()->json([
                'status' => 'success',
                'data' => $customers,
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => "Lấy dữ liệu không thành công!"
            ], 500);
        }
    }

    public function create($request, $isJsonResponse = true) {
        DB::beginTransaction();
    
        try {
            $payload = $request->except('_token');
            $payload['birthday'] = convertDateToDatabaseFormat($payload['birthday']);
            $payload['customer_catalogue_id'] = $request->input('customer_catalogue_id') ?? null;
            $payload['publish'] = 2;
            $payload['password'] = Hash::make($payload['password']);
    
            $member = $this->customerRepository->create($payload);
    
            if ($member) {
                DB::commit();
                if ($isJsonResponse) {
                    return response()->json([
                        'status' => 'success',
                        'message' => __('messages.notifications.create_success'),
                        'data' => $member,
                    ], 201);
                }
                return true;
            }
    
            throw new \Exception(__('messages.notifications.create_error'));
        } catch (\Exception $e) {
            DB::rollBack();
            if ($isJsonResponse) {
                return response()->json([
                    'status' => 'error',
                    'message' => __('messages.notifications.create_error')
                ], 500);
            }
            return false;
        }
    }
    
    public function update($request, $id, $isJsonResponse = true) {
        DB::beginTransaction();
    
        try {
            $payload = $request->except('_token');
    
            $payload['birthday'] = convertDateToDatabaseFormat($payload['birthday']);
    
            if ($request->filled('password')) {
                $payload['password'] = Hash::make($request->input('password'));
            } else {
                unset($payload['password']);
            }
    
            if ($request->hasFile('image')) {
                $customer = $this->customerRepository->findById($id);
                $oldImagePath = public_path($customer->image);
                
                if ($customer->image && file_exists($oldImagePath) && str_starts_with($customer->image, 'frontend/img/customer/')) {
                    @unlink($oldImagePath);
                }
            
                $file = $request->file('image');
                $filename = 'customer_' . time() . '_' . Str::random(6) . '.' . $file->getClientOriginalExtension();
                $path = public_path('frontend/img/customer');
            
                if (!file_exists($path)) {
                    mkdir($path, 0777, true);
                }
            
                $file->move($path, $filename);
                $payload['image'] = 'frontend/img/customer/' . $filename;
            }
    
            $member = $this->customerRepository->update($id, $payload);
    
            if ($member) {
                DB::commit();
                if ($isJsonResponse) {
                    return response()->json([
                        'status' => 'success',
                        'message' => __('messages.notifications.create_success'),
                        'data' => $member,
                    ], 201);
                }
                return true;
            }
    
            throw new \Exception(__('messages.notifications.no_changes'));
        } catch (\Exception $e) {
            DB::rollBack();
            if ($isJsonResponse) {
                return response()->json([
                    'status' => 'error',
                    'message' => __('messages.notifications.create_error')
                ], 500);
            }
            return false;
        }
    }
    
    public function delete($id) {
        DB::beginTransaction();
    
        try {
            $member = $this->customerRepository->delete($id);
    
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

    public function getCustomerDetails($id) {
        $customer = $this->customerRepository->findById($id);
        if ($customer) {
            return response()->json([
                'status' => 'success',
                'data' => $customer,
            ], 200);
        }
    }

    public function customerStatistic() {
        return [
            'totalCustomer' => $this->customerRepository->totalCustomer(),
            'newTotalCustomer' => $this->customerRepository->newCustomersLast7Days(),
        ];
    }

    private function paginateSelect() {
        return [
            'customers.*',
            'cl.name as customer_catalogue_name'
        ];
    }
}
