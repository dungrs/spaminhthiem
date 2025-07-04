<?php 

namespace App\Services;
use App\Services\Interfaces\ReviewServiceInterface;
use App\Services\BaseService;

use App\Repositories\ReviewRepository;
use App\Repositories\ReviewLikeRepository;

use Illuminate\Support\Facades\DB;

use App\Classes\ReviewNestedset;

class ReviewService extends BaseService implements ReviewServiceInterface {
    protected $reviewRepository;
    protected $reviewLikeRepository;

    public function __construct(
        ReviewRepository $reviewRepository,
        ReviewLikeRepository $reviewLikeRepository,
        ) {
        $this->reviewRepository = $reviewRepository;
        $this->reviewLikeRepository = $reviewLikeRepository;
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

    public function toggleLike($request) {
        DB::beginTransaction();

        try {
            $payload = $request->only(['review_id', 'customer_id']);

            $liked = $this->reviewLikeRepository->findByCondition([
                ['review_id', '=', $payload['review_id']],
                ['customer_id', '=', $payload['customer_id']]
            ]);

            $reviewId = $payload['review_id'];
            $customerId = $payload['customer_id'];

            if ($liked) {
                // Unlike
                $this->reviewLikeRepository->deleteByCondition([
                    ['review_id', '=', $reviewId],
                    ['customer_id', '=', $customerId],
                ]);

                $this->reviewRepository->updateByWhere([['id', '=', $reviewId]], [
                    'like_count' => DB::raw('like_count - 1')
                ]);

                $message = 'Bỏ thích thành công';
                $liked = false;
            } else {
                // Like
                $this->reviewLikeRepository->create($payload);

                $this->reviewRepository->updateByWhere([['id', '=', $reviewId]], [
                    'like_count' => DB::raw('like_count + 1')
                ]);

                $message = 'Đã thích đánh giá';
                $liked = true;
            }

            DB::commit();

            return [
                'status' => 'success',
                'message' => $message,
                'liked' => $liked,
            ];
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