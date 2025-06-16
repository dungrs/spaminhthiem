<?php 

namespace App\Services;
use App\Services\Interfaces\SlideServiceInterface;
use App\Services\BaseService;

use App\Repositories\SlideRepository;

use Illuminate\Support\Facades\DB;

class SlideService extends BaseService implements SlideServiceInterface {

    protected $slideRepository;

    public function __construct(SlideRepository $slideRepository) {
        $this->slideRepository = $slideRepository;
    }

    public function paginate($request) {
        $perpage = $request->input('perpage') ?? 1;
        $page = $request->integer('page');
        $condition = [
            'keyword' => addslashes($request->input('keyword')),
            'publish' => $request->integer('publish'),
        ];
        $extend['path'] = '/slide/index';
        $extend['fieldSearch'] = ['name', 'keyword'];
        $slides = $this->slideRepository->paginate(
            $this->paginateSelect(),
            $condition,
            $perpage,
            $page,
            $extend,
            ['id', 'DESC'],
        );

        if ($slides) {
            return response()->json([
                'status' => 'success',
                'data' => $slides,
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
            $payload = $request->only('name', 'keyword', 'setting', 'short_code');
            $languageId = session('currentLanguage')->id;
            $payload['item'] = $this->handleSlideItem($request, $languageId);
            $slides = $this->slideRepository->create($payload);
            if ($slides) {
                DB::commit();
                return response()->json([
                    'status' => 'success',
                    'message' => __('messages.notifications.create_success'),
                    'data' => $slides,
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
    
    public function convertSlideArray($slides = []) {
        $temp = [];
        $feilds = ["image", "name", "description", "canonical", "alt", "window"];
        foreach ($slides as $slide) {
            foreach ($feilds as $feild) {
                $temp[$feild][] = $slide[$feild];
            }
        }
        return $temp;
    }

    public function update($request, $id) {
        DB::beginTransaction();
        
        try {
            $languageId = session('currentLanguage')->id;
            $slide = $this->slideRepository->findById($id);
            $slideItem = $slide->item;
            unset($slideItem[$languageId]);
            $payload = $request->only('_token', 'name', 'keyword', 'setting', 'short_code');
            $payload['item'] = $this->handleSlideItem($request, $languageId) + $slideItem;
            $flag = $this->slideRepository->update($id, $payload);
            if ($flag) {
                DB::commit();
                return response()->json([
                    'status' => 'success',
                    'message' => __('messages.notifications.update_success'),
                    'data' => $flag,
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
            $slides = $this->slideRepository->delete($id);
            if ($slides) {
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

    public function getSlideDetails($id) {
        $slide = $this->slideRepository->findById($id);
        return $slide;
    }

    private function handleSlideItem($request, $languageId) {
        $slide = $request->input('slide');
        foreach ($slide['image'] as $key => $val) {
            $temp[$languageId][] = [
                'image' => $val,
                'name' => $slide['name'][$key],
                'description' => $slide['description'][$key],
                'canonical' => $slide['canonical'][$key],
                'alt' => $slide['alt'][$key],
                'window' => isset($slide['window'][$key]) ? $slide['window'][$key] : '',
            ];
        }

        return $temp;
    }

    // FRONTEND
    public function getSlideFrontend($conditionKeyword = [], $languageId = 1) {
        $slides = $this->slideRepository->findByCondition(
            [
                ['publish', '=', 2],
                ['keyword', 'IN', $conditionKeyword]
            ],
            true,
            [],
            ['id' => 'desc'],
        );
        $temp = [];
        foreach($slides as $slide) {
            $temp[$slide->keyword]['item'] = $slide->item[$languageId];
            $temp[$slide->keyword]['setting'] = $slide->setting;
        }

        return $temp;
    }

    private function paginateSelect() {
        return [
            'id',
            'name',
            'keyword',
            'item',
            'publish'
        ];
    }
}