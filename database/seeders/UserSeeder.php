<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\User;
use App\Models\Language;

use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        $user = User::create([
            'email' => 'dungnhung1209@gmail.com',
            'password' => Hash::make('dungnhung'),
            'name' => 'Dương Hồng Nhung',
            'user_catalogue_id' => '1'
        ]);

        $language = Language::where('canonical', 'vn')->first();
        
        $user->languageable()->associate($language);
        $user->save();
        $locale = session('backend_locale');
        if (!$locale) {
            $locale = $user->language ? $user->language->canonical : 'vn';
            session(['backend_locale' => $locale]);
        }
    }
}