<?php

namespace Database\Seeders;

use App\Models\Enterprise;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingAppearanceSeeder extends Seeder
{
    public function run(): void
    {
        $enterprises = Enterprise::all();

        foreach ($enterprises as $enterprise) {
            DB::table('setting_appearance')->insert([
                'enterprise_id' => $enterprise->id,

                'title_page_color_default' => 1,
                'navbar_color_default' => 1,
                'navbar_icon_color_default' => 1,
                'side_menu_color_default' => 1,
                'side_menu_color_default_not_selected_item' => 1,
                'side_menu_color_default_selected_item' => 1,
                'side_menu_color_default_not_selected_icon' => 1,
                'side_menu_color_default_selected_icon' => 1,

                'title_page_color_code' => null,
                'navbar_color_code' => null,
                'navbar_icon_color_code' => null,
                'side_menu_color_code' => null,
                'side_menu_color_code_not_selected_item' => null,
                'side_menu_color_code_selected_item' => null,
                'side_menu_color_code_not_selected_icon' => null,
                'side_menu_color_code_selected_icon' => null,

                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
