<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppRepositoryProvider extends ServiceProvider
{   

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {   
        $bindings = [
            'User\\UserRepositoryInteface' => 'User\\UserRepository',
            'User\\UserCatalogueRepositoryInteface' => 'User\\UserCatalogueRepository',
            'Post\\PostRepositoryInteface' => 'Post\\PostRepository',
            'Post\\PostCatalogueRepositoryInteface' => 'Post\\PostCatalogueRepository',
            'Product\\ProductRepositoryInteface' => 'Product\\ProductRepository',
            'Product\\ProductCatalogueRepositoryInteface' => 'Product\\ProductCatalogueRepository',
            'Attribute\\AttributeRepositoryInteface' => 'Attribute\\AttributeRepository',
            'Attribute\\AttributeCatalogueRepositoryInteface' => 'Attribute\\AttributeCatalogueRepository',
            'LanguageRepositoryInteface' => 'LanguageRepository',
            'RouterRepositoryInteface' => 'RouterRepository',
            'PermissionRepositoryInteface' => 'PermissionRepository',
        ];

        foreach($bindings as $interface => $implementation) {
            $this->app->bind("App\\Repositories\\Interfaces\\$interface", "App\\Repositories\\$implementation");
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
