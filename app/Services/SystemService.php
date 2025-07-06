<?php 

namespace App\Services;

use App\Services\Interfaces\SystemServiceInterface;
use App\Services\BaseService;

use App\Repositories\SystemRepository;
use App\Repositories\LanguageRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SystemService extends BaseService implements SystemServiceInterface {

    protected $systemRepository;
    protected $languageRepository;

    public function __construct(SystemRepository $systemRepository, LanguageRepository $languageRepository) {
        $this->systemRepository = $systemRepository;
        $this->languageRepository = $languageRepository;
    }

    public function create($request) {
        DB::beginTransaction();
    
        try {
            $configs = $request->only(['config', 'language_id']);
            if (count($configs['config'])) {
                foreach ($configs['config'] as $key => $val) {
                    $payload = [
                        'keyword' => $key,
                        'content' => $val,
                        'language_id' => $configs['language_id'],
                        'user_id' => Auth::id(),
                    ];

                    $conditions = [
                        ['keyword', '=', $key],
                        ['language_id', '=', $configs['language_id']],
                        ['user_id', '=', Auth::id()],
                    ];

                    $this->systemRepository->deleteByCondition($conditions);
                    $flag = $this->systemRepository->create($payload);

                    $languages = $this->languageRepository->findById($configs['language_id']);
                }
            }

            if ($flag) {
                DB::commit();
                return response()->json([
                    'status' => 'success',
                    'message' => __('messages.notifications.update_success'),
                    'data' => $languages,
                ], 201);
            }
    
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage(); die();
            return response()->json([
                'status' => 'error',
                'message' => __('messages.notifications.update_error')
            ], 500);
        }
    }

    public function getSystemDetails() {
        $systems = $this->systemRepository->all();
        return $systems;
    }
}
