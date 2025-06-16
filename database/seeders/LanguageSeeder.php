<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Language;
use Illuminate\Support\Facades\Hash;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Language::create([
            'name' => 'Vietnam',
            'canonical' => 'vn',
        ]);

        Language::create([
            'name' => 'Korean',
            'canonical' => 'kr',
        ]);

        Language::create([
            'name' => 'English',
            'canonical' => 'en',
        ]);
    }
}
