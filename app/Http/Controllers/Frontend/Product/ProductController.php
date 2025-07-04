<?php

namespace App\Http\Controllers\Frontend\Product;

use App\Http\Controllers\FrontendController;

use App\Repositories\SystemRepository;

use App\Services\Product\ProductCatalogueService;
use App\Services\Product\ProductService;
use App\Services\WidgetService;

class ProductController extends FrontendController
{   
    protected $productCatalogueService;
    protected $productService;
    protected $widgetService;

    public function __construct(    
        SystemRepository $systemRepository,
        ProductCatalogueService $productCatalogueService,
        ProductService $productService,
        WidgetService $widgetService,
    ) {
        parent::__construct($systemRepository);
        $this->productCatalogueService = $productCatalogueService;
        $this->productService = $productService;
        $this->widgetService = $widgetService;
    }

    public function index($request, $canonical, $id) {
        $config = $this->config();
        $template = 'frontend.product.product.index';
        $systems = $this->getSystem();
        $languageId = $this->language;

        $data = $this->productService->prepareFrontendProductData($id, $languageId, false);
        $product = $data['product'];
        $productCatalogue = $data['productCatalogue'];
        $productRelateds = $this->productService->getRelatedProductsByCategory($productCatalogue->id, $id, $languageId);
        $seo = $data['seo'];
        $keywords = [
            'hot-deal' => ['keyword' => 'hot-deal', 'options' => ['object' => false, 'promotion' => true]],
        ];

        $widgets = $this->widgetService->getWidget($keywords, 1);

        $breadcrumb = $this->productCatalogueService->breadcrumb("ProductCatalogue", "Product", $productCatalogue, $languageId);
        return view('frontend.homepage.layout', compact(
            'template',
            'config',
            'systems',
            'languageId',
            'productCatalogue',
            'product',
            'productRelateds',
            'seo',
            'breadcrumb',
            'widgets'
        ));
    }

    public function config() {
        return [
            'language' => $this->language,
            'js' => [
                'frontend/js/pages/products.js',
                'frontend/js/pages/reviews.js',
            ]
        ];
    }
}