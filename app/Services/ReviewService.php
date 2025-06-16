<?php 

namespace App\Services;
use App\Services\Interfaces\ReviewServiceInterface;
use App\Services\BaseService;

use App\Repositories\ReviewRepository;

use Illuminate\Support\Facades\DB;

use App\Classes\ReviewNestedset;

class ReviewService extends BaseService implements ReviewServiceInterface {
    protected $reviewRepository;

    public function __construct(ReviewRepository $reviewRepository) {
        $this->reviewRepository = $reviewRepository;
    }

    public function paginate($request) {
        $perpage = $request->input('perpage');
        $page = $request->integer('page');
        $condition = [
            'keyword' => addslashes($request->input('keyword')),
        ];
        $extend['path'] = '/review/index';
        $extend['fieldSearch'] = ['c.name', 'reviews.description', 'score'];
        $join = [
            [
                'table' => 'customers as c', 
                'on' => [['reviews.customer_id', 'c.id']]
            ],
        ];
        $reviews = $this->reviewRepository->paginate(
            $this->paginateSelect(),
            $condition,
            $perpage,
            $page,
            $extend,
            ['reviews.id', 'ASC'],
            $join,
        );

        if ($reviews) {
            return response()->json([
                'status' => 'success',
                'data' => $reviews,
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
            $this->reviewRepository->create($payload);
    
            $reviewNestedSet = new ReviewNestedset([
                'table' => 'reviews',
                'reviewable_type' => $payload['reviewable_type'],
            ]);
    
            $reviewNestedSet->Get();
            $reviewNestedSet->Recursive(0, $reviewNestedSet->Set());
            $reviewNestedSet->Action();
    
            DB::commit();
    
            return response()->json([
                'status' => 'success',
                'message' => __('messages.notifications.create_success'),
            ], 200);
    
        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json([
                'status' => 'error',
                'message' => __('messages.notifications.create_error'),
            ], 500);
        }
    }

    public function delete($id) {
        DB::beginTransaction();
    
        try {
            $review = $this->reviewRepository->findById($id);
            $this->reviewRepository->delete($id);
    
            $reviewNestedSet = new ReviewNestedset([
                'table' => 'reviews',
                'reviewable_type' => $review->reviewable_type,
            ]);
    
            $reviewNestedSet->Get();
            $reviewNestedSet->Recursive(0, $reviewNestedSet->Set());
            $reviewNestedSet->Action();
    
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

    private function paginateSelect() {
        return [
            'reviews.id',
            'customer_id',
            'reviewable_id',
            'reviewable_type',
            'c.name', 
            'c.email', 
            'score',
            'reviews.description', 
            'c.phone',
            'reviews.created_at'
        ];
    }
}