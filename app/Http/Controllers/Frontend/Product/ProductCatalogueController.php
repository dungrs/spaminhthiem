<?php

namespace App\Http\Controllers\Frontend\Product;

use App\Http\Controllers\FrontendController;
use App\Repositories\Product\ProductCatalogueRepository;
use App\Repositories\SystemRepository;

use App\Services\Product\ProductCatalogueService;
use App\Services\Product\ProductService;
use App\Services\Attribute\AttributeService;
use App\Services\PromotionService;

class ProductCatalogueController extends FrontendController
{   
    protected $productCatalogueRepository;
    protected $productCatalogueService;
    protected $productService;
    protected $attributeService;
    protected $promotionService;

    public function __construct(    
        ProductCatalogueRepository $productCatalogueRepository,
        ProductCatalogueService $productCatalogueService,
        ProductService $productService,
        AttributeService $attributeService,
        PromotionService $promotionService,
        SystemRepository $systemRepository,
    ) {
        parent::__construct($systemRepository);
        $this->productCatalogueRepository = $productCatalogueRepository;
        $this->productCatalogueService = $productCatalogueService;
        $this->productService = $productService;
        $this->attributeService = $attributeService;
        $this->promotionService = $promotionService;
    }

    public function index($request, $page, $id) {
        $config = $this->config();
        $systems = $this->getSystem();
        $template = 'frontend.product.catalogue.index';
        $languageId = $this->language;

        $productCatalogue = $this->productCatalogueService->getProductCatalogueDetails($id, $languageId);

        $filters = null;
        if (!is_null($productCatalogue->attribute)) {
            $filters = $this->attributeService->getFilterList(json_decode($productCatalogue->attribute, true), $languageId);
        }
    
        $seo = seo($productCatalogue, $page);
        $breadcrumb = $this->productCatalogueService->breadcrumb("ProductCatalogue", "Product", $productCatalogue, $languageId);
    
        return view('frontend.homepage.layout', compact(
            'template',
            'config',
            'systems',
            'seo',
            'languageId',
            'breadcrumb',
            'productCatalogue',
            'filters',
        ));
    }
    
    public function config() {
        return [
            'language' => $this->language,
            'js' => [
                'backend/js/library.js',
                'frontend/js/pages/products.js',
                'frontend/js/pages/product_catalogues.js',
            ]
        ];
    }
}