<?php

namespace App\Providers;

use DateTime;

use App\Http\ViewComposers\MenuComposer;

use App\Repositories\Menu\MenuCatalogueRepository;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

use App\Models\Language;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $binding = [
            'User\\UserServiceInterface' => 'User\\UserService',
            'User\\UserCatalogueServiceInterface' => 'User\\UserCatalogueService',
            'Post\\PostServiceInterface' => 'Post\\PostService',
            'Post\\PostCatalogueServiceInterface' => 'Post\\PostCatalogueService',
            'Product\\ProductServiceInterface' => 'Product\\ProductService',
            'Product\\ProductCatalogueServiceInterface' => 'Product\\ProductCatalogueService',
            'Attribute\\AttributeServiceInterface' => 'Attribute\\AttributeService',
            'Attribute\\AttributeCatalogueServiceInterface' => 'Attribute\\AttributeCatalogueService',
            'LanguageServiceInterface' => 'LanguageService',
            'RouterServiceInterface' => 'RouterService',
            'PermissionServiceInterface' => 'PermissionService',
        ];

        foreach($binding as $interface => $implementation) {
            $this->app->bind("App\\Services\\Interfaces\\$interface", "App\\Services\\$implementation");
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {   
        // FIX
        $locale = app()->getLocale();
        $language = Language::where('canonical', $locale)->first();

        Validator::extend('custom_date_format', function($attribute, $value, $parameters, $validator) {
            return DateTime::createFromFormat('d/m/Y H:i:s', $value) !== false;
        });
    
        Validator::extend('custom_after_now', function($attribute, $value, $parameters, $validator) {
            $inputDate = DateTime::createFromFormat('d/m/Y H:i:s', $value);
            return $inputDate && $inputDate >= new DateTime();
        });
    
        Validator::extend('custom_after', function($attribute, $value, $parameters, $validator) {
            $startDate = $validator->getData()['start_date'] ?? null;
            if (!$startDate) return false;
    
            $start = DateTime::createFromFormat('d/m/Y H:i:s', $startDate);
            $end = DateTime::createFromFormat('d/m/Y H:i:s', $value);
            return $start && $end && $end > $start;
        });

        $composers = [
            // SystemComposer::class => SystemRepository::class,
            MenuComposer::class => MenuCatalogueRepository::class,
        ];
        
        foreach ($composers as $composerClass => $repositoryClass) {
            View::composer('frontend.homepage.layout', function ($view) use ($composerClass, $repositoryClass, $language) {
                $repository = app($repositoryClass);
                $languageId = $language->id ?? app('App\\Repositories\\LanguageRepository')->findById(1)->id;
                $composer = new $composerClass($repository, $languageId);
                $composer->compose($view);

                if (Auth::guard('customer')->check()) {
                    $customer = Auth::guard('customer')->user();
                    View::share('customer', $customer);
                }
            });
        }
    }
}
