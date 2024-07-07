<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class LocaleMasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $locales = [
            ['code' => 'Ja', 'name' => '日本語'],
            ['code' => 'En', 'name' => 'English'],
            ['code' => 'Fr', 'name' => 'Français'],
            ['code' => 'Ar', 'name' => 'العربية'],
            ['code' => 'Es', 'name' => 'Español'],
            ['code' => 'Pt', 'name' => 'Português'],
            ['code' => 'De', 'name' => 'Deutsch'],
            ['code' => 'Zh', 'name' => '中文'],
            ['code' => 'Ru', 'name' => 'Русский'],
            ['code' => 'It', 'name' => 'Italiano'],
            ['code' => 'Nl', 'name' => 'Nederlands'],
            ['code' => 'Fi', 'name' => 'Suomi'],
            ['code' => 'Tr', 'name' => 'Türkçe'],
            ['code' => 'No', 'name' => 'Norsk'],
            ['code' => 'Uk', 'name' => 'Українська'],
            ['code' => 'Sv', 'name' => 'Svenska'],
            ['code' => 'Cs', 'name' => 'Čeština'],
            ['code' => 'Da', 'name' => 'Dansk'],
            ['code' => 'Et', 'name' => 'Eesti'],
            ['code' => 'El', 'name' => 'Ελληνικά'],
            ['code' => 'Hu', 'name' => 'Magyar'],
            ['code' => 'Id', 'name' => 'Bahasa Indonesia'],
            ['code' => 'Ko', 'name' => '한국어'],
            ['code' => 'Lv', 'name' => 'Latviešu'],
            ['code' => 'Lt', 'name' => 'Lietuvių'],
            ['code' => 'Pl', 'name' => 'Polski'],
            ['code' => 'Ro', 'name' => 'Română'],
            ['code' => 'Sk', 'name' => 'Slovenčina'],
            ['code' => 'Sl', 'name' => 'Slovenščina'],
            ['code' => 'Bg', 'name' => 'Български'],
        ];

        foreach ($locales as $locale) {
            DB::table('locale_master')->insert([
                'code' => $locale['code'],
                'name' => $locale['name'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
