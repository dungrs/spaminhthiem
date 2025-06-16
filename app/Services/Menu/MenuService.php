<?php 

namespace App\Services\Menu;
use App\Services\Interfaces\Menu\MenuServiceInterface;
use App\Services\BaseService;

use App\Repositories\Menu\MenuRepository;
use App\Repositories\Menu\MenuCatalogueRepository;
use App\Repositories\Menu\MenuLanguageRepository;
use App\Repositories\RouterRepository;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

use App\Classes\Nestedsetbie;

class MenuService extends BaseService implements MenuServiceInterface {
    protected $menuRepository;
    protected $menuCatalogueRepository;
    protected $menuLanguageRepository;
    protected $routerRepository;
    protected $nestedSet;

    public function __construct(
        MenuRepository $menuRepository, 
        MenuCatalogueRepository $menuCatalogueRepository, 
        MenuLanguageRepository $menuLanguageRepository, 
        RouterRepository $routerRepository
        ) {
        $this->menuRepository = $menuRepository;
        $this->menuCatalogueRepository = $menuCatalogueRepository;
        $this->menuLanguageRepository = $menuLanguageRepository;
        $this->routerRepository = $routerRepository;
    }

    public function save($request) {
        DB::beginTransaction();
    
        try {
            $payload = $request->only('menu', 'menu_catalogue_id');
            $languageId = session('currentLanguage')->id;
            $newMenus = [];
    
            $this->menuRepository->deleteByCondition([
                ['menu_catalogue_id', '=', $payload['menu_catalogue_id']],
                ['user_id', '=', Auth::id()]
            ]);
    
            if (count($payload['menu']['name'])) {
                foreach ($payload['menu']['name'] as $key => $value) {
                    $menuId = $payload['menu']['id'][$key] ?? null;
                    $menuArray = [
                        'order' => $payload['menu']['order'][$key],
                        'menu_catalogue_id' => $payload['menu_catalogue_id'],
                        'user_id' => Auth::id(),
                    ];
    
                    $menuSave = $this->menuRepository->updateOrCreate(
                        ['id' => $menuId],
                        $menuArray
                    );
    
                    $payloadLanguage = [
                        'language_id' => $languageId,
                        'name' => $value,
                        'menu_id' => $menuSave->id,
                        'canonical' => $payload['menu']['canonical'][$key],
                    ];
    
                    $this->menuRepository->updateOrCreatePivot(
                        $menuSave,
                        ['language_id' => $languageId],
                        $payloadLanguage,
                        'languages'
                    );
    
                    $newMenus[] = $menuSave;
                }
    
                $this->initialize($languageId);
                $this->nestedSet();
            }
    
            DB::commit();
            return response()->json([
                'status' => 'success',
                'message' => __('messages.notifications.create_success'),
                'data' => $newMenus
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => 'error',
                'message' => __('messages.notifications.create_error'),
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function getMenu($request) {
        $payload = $request->input();

        if (empty($payload['model']) || empty($payload['modelParent'])) {
            return response()->json([
                'status' => 'error',
                'message' => 'Thiếu thông tin model hoặc modelParent.'
            ], 422);
        }

        $model = Str::snake($payload['model']);
        $modelParent = $payload['modelParent'];
        $table = "{$model}s";
        $tableLang = "{$model}_languages";

        $condition = [
            ["tb2.language_id", '=', session('currentLanguage')->id],
            ["{$table}.publish", "=", 2],
        ];

        if (!empty($payload['keyword'])) {
            $condition[] = ["tb2.name", 'LIKE', '%' . $payload['keyword'] . '%'];
        }

        $repositoryInstance = resolveInstance($payload['model'], $modelParent, 'Repositories', 'Repository');

        $object = $repositoryInstance->findByCondition(
            $condition,
            true,
            [
                [
                    'table' => "{$tableLang} as tb2",
                    'on' => [["tb2.{$model}_id", "{$table}.id"]]
                ]
            ],
            ["{$table}.id" => 'DESC'],
            [
                "{$table}.*",
                'tb2.name',
                'tb2.canonical',
                'tb2.language_id',
            ]
        );

        return response()->json([
            'status' => 'success',
            'data' => $object,
        ], 200);
    }

    public function getMenuDetails($id) {
        $languageId = session('currentLanguage')->id ?? null;
    
        $menus = $this->menuRepository->findByCondition(
            [
                ['menu_catalogue_id', '=', $id],
                ['language_id', '=', $languageId]
            ],
            true,
            [
                [
                    'table' => 'menu_languages',
                    'on' => [['menu_languages.menu_id', 'menus.id']]
                ],
                [
                    'table' => 'menu_catalogues',
                    'on' => [['menu_catalogues.id', 'menus.menu_catalogue_id']]
                ],
            ],
            ['menus.order' => 'ASC'],
            ['menus.*', 'menu_languages.*', 'menu_catalogues.name as menu_catalogue_name']
        );
    
        $menuList = !empty($menus) ? recursive($menus, 0) : [];
    
        $menuCatalogue = $this->menuCatalogueRepository->findById($id);
    
        return [
            'menuList' => $menuList,
            'menuCatalogue' => $menuCatalogue,
            'languageId' => $languageId,
        ];
    }
    
    public function queryMenuWithCondition($condition, $flag = true) {
        return $this->menuRepository->findByCondition(
            $condition,
            $flag,
            [
                [
                    'table' => 'menu_languages',
                    'on' => [['menu_languages.menu_id', 'menus.id']],
                ],
            ],
            ['lft' => 'ASC'],
        );
    }

    public function getDetails($id) {
        $languageId = session('currentLanguage')->id ?? null;
        $condition = [
            ['menus.id', '=', $id],
            ['language_id', '=', $languageId]
        ];
        return $this->queryMenuWithCondition($condition);
    }
    
    public function getAndConvertMenu($id, $menuCatalogueId) {
        $languageId = session('currentLanguage')->id ?? null;
        $condition = 
            [
                ['parent_id', '=', $id],
                ['language_id', '=', $languageId],
                ['menus.menu_catalogue_id', '=', $menuCatalogueId]
            ]
        ;
        $menus = $this->queryMenuWithCondition($condition);

        return [
            'name'      => $menus->pluck('name')->toArray(),
            'canonical' => $menus->pluck('canonical')->toArray(),
            'order'     => $menus->pluck('order')->toArray(),
            'id'        => $menus->pluck('id')->toArray(),
        ];
    }

    public function dragUpdate(array $menus = [], $parentId = 0, $menuCatalogueId = 0, $order = 1) {
        $languageId = session('currentLanguage')->id ?? null;
        foreach($menus as $menu) {
            $payload = [
                'parent_id' => $parentId,
                'menu_catalogue_id' => $menuCatalogueId,
                'order' => $order
            ];

            $updateMenu = $this->menuRepository->updateAndGetData($menu['id'], $payload);
            if (!$updateMenu) {
                return response()->json([
                    'status' => false,
                ], 500);
            }

            if (isset($menu['children']) && count($menu['children']) > 0) {
                if (!$this->dragUpdate($menu['children'], $menu['id'], $menuCatalogueId, 1)) {
                    return response()->json([
                        'status' => false,
                    ], 500);
                }
            }

            $order++;
        }

        $this->initialize($languageId);
        $this->nestedSet();
    
        return response()->json([
            'status' => true,
        ], 200);
    }

    public function saveChildren($request, $id) {
        DB::beginTransaction();
    
        try {
            $payload = $request->only('menu');
            $languageId = session('currentLanguage')->id;
            $menu = $this->menuRepository->findById($id);
            
            $this->menuRepository->deleteChildren($menu->id);
    
            if (count($payload['menu']['name'])) {
                $newMenus = [];
                
                foreach($payload['menu']['name'] as $key => $value) {
                    $menuArray = [
                        'parent_id' => $menu->id,
                        'order' => $payload['menu']['order'][$key],
                        'menu_catalogue_id' => $menu->menu_catalogue_id,
                        'user_id' => Auth::id(),
                    ];
    
                    $menuSave = $this->menuRepository->create($menuArray);
                    $newMenus[] = $menuSave;
    
                    $payloadLanguage = [
                        'language_id' => $languageId,
                        'name' => $value,
                        'menu_id' => $menuSave->id,
                        'canonical' => $payload['menu']['canonical'][$key]
                    ];
    
                    $this->menuRepository->createPivot($menuSave, $payloadLanguage, 'languages');
                }
    
                $this->initialize($languageId);
                $this->nestedSet();
            }
    
            DB::commit();
            return response()->json([
                'status' => 'success',
                'message' => __('messages.notifications.create_success'),
                'data' => $newMenus
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => 'error',
                'message' => __('messages.notifications.create_error'),
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function getMenuByCatalogue($id) {
        $condition = [
            ['menu_catalogue_id', '=', $id],
            ['parent_id', '=', 0],
            ['language_id', '=', session('currentLanguage')->id]
        ];
        $menu = $this->queryMenuWithCondition($condition, false);
        return $menu;
    }

    public function findMenuItemTranslate($menus, int $menuCatalogueId = 1, $languageId = 1) {
        $output = [];
    
        if (count($menus)) {
            foreach ($menus as $menu) {
                $canonical = $menu->canonical;
                $router = $this->routerRepository->findByCondition([
                    ['canonical', '=', $canonical],
                ]);
        
                $translations = collect();
        
                if ($router == null) {
                    $primary = $menu->languages()
                        ->where('language_id', $languageId)
                        ->where('menu_catalogue_id', $menuCatalogueId)
                        ->join('menus', 'menus.id', '=', 'menu_languages.menu_id')
                        ->join('menu_catalogues', 'menu_catalogues.id', '=', 'menus.menu_catalogue_id')
                        ->first([
                            'menu_languages.language_id',
                            'menu_languages.name',
                            'menu_languages.canonical'
                        ]);
        
                    if ($primary) {
                        $translations->put($languageId, $primary);
                    }
        
                    $others = $menu->languages()
                        ->where('menu_catalogue_id', $menuCatalogueId)
                        ->where('language_id', '!=', $languageId)
                        ->join('menus', 'menus.id', '=', 'menu_languages.menu_id')
                        ->join('menu_catalogues', 'menu_catalogues.id', '=', 'menus.menu_catalogue_id')
                        ->get([
                            'menu_languages.language_id',
                            'menu_languages.name',
                            'menu_languages.canonical'
                        ])->keyBy('language_id');
        
                    $translations = $translations->merge($others);
                } else {
                    $controllers = explode('\\', $router->controllers);
                    $model = str_replace('Controller', '', end($controllers));
                    $parts = $this->extractControllerPath($router->controllers);
                    $repositoryInterfaceNamespace = "\App\Repositories\\{$parts}Repository";
        
                    if (!class_exists($repositoryInterfaceNamespace)) {
                        return response()->json(['error' => 'Repository not found.'], 404);
                    }
        
                    $repositoryInterface = app($repositoryInterfaceNamespace);
                    $alias = Str::snake($model) . '_languages';
        
                    $object = $repositoryInterface->findByWhereHas(
                        [['canonical', '=', $canonical]],
                        'languages',
                        $alias
                    );
        
                    if ($object) {
                        $primary = $object->languages()
                            ->where($alias . '.language_id', $languageId)
                            ->first([
                                "$alias.language_id",
                                "$alias.name",
                                "$alias.canonical"
                            ]);
        
                        if ($primary) {
                            $translations->put($languageId, $primary);
                        }
        
                        $others = $object->languages()
                            ->where($alias . '.language_id', '!=', $languageId)
                            ->get([
                                "$alias.language_id",
                                "$alias.name",
                                "$alias.canonical"
                            ])->keyBy('language_id');
        
                        $translations = $translations->merge($others);
                    }
                }
        
                $menu->translations = $translations;
                $output[] = $menu;
            }
        }

    
        return $output;
    }

    public function saveTranslateMenu($request, $languageId) {
        DB::beginTransaction();
    
        try {
            $data = $request->input('translate')[$languageId];
            foreach($data as $menuId => $item) {
                if (empty($item['name']) && empty($item['canonical'])) {
                    continue;
                }
    
                $this->menuLanguageRepository->updateOrInsert(
                    [
                        'language_id' => $item['language_id'],
                        'menu_id' => $item['menu_id'],
                    ],
                    [
                        'name' => $item['name'],
                        'canonical' => $item['canonical'],
                        'updated_at' => now(),
                    ]
                );
            }
    
            DB::commit();
            return response()->json([
                'status' => 'success',
                'message' => __('messages.notifications.translation_saved_successfully'),
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => 'error',
                'message' => __('messages.notifications.error_saving_translation'),
                'error' => $e->getMessage()
            ], 500);
        }

    }

    private function extractControllerPath($fullClassName) {
        $parts = explode('Frontend\\', $fullClassName, 2);
        if (count($parts) < 2) return null;
    
        $controllerPath = $parts[1];
    
        $controllerPath = preg_replace('/Controller$/', '', $controllerPath);
    
        return $controllerPath;
    }
    
    private function initialize($languageId) {
        $this->nestedSet = new Nestedsetbie([
            'table' => 'menus',
            'foreignkey' => 'menu_id',
            'isMenu' => TRUE,
            'language_id' => $languageId,
        ]);
    }
}