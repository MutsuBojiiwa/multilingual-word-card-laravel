<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\LocaleMaster;

class LocaleMasterSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $locales = [
            ['key' => 'ja'],
            ['key' => 'en'],
            ['key' => 'fr'],
        ];

        foreach ($locales as $locale) {
            LocaleMaster::create($locale);
        }
    }
}
