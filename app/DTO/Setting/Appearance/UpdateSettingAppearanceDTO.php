<?php

namespace App\DTO\Setting\Appearance;

class UpdateSettingAppearanceDTO
{
    public function __construct(
        public int $navbar_color_default,
        public int $navbar_icon_color_default,
        public int $side_menu_color_default_not_selected_item,
        public int $side_menu_color_default_selected_item,
        public int $side_menu_color_default_not_selected_icon,
        public int $side_menu_color_default_selected_icon,
        public ?string $navbar_color_code,
        public ?string $navbar_icon_color_code,
        public ?string $side_menu_color_code_not_selected_item,
        public ?string $side_menu_color_code_selected_item,
        public ?string $side_menu_color_code_not_selected_icon,
        public ?string $side_menu_color_code_selected_icon
    ) {}

    public static function fromRequest(array $data): self
    {
        return new self(
            navbar_color_default: $data['navbarColorDefault'],
            navbar_icon_color_default: $data['navbarIconColorDefault'],
            side_menu_color_default_not_selected_item: $data['sideMenuColorDefaultNotSelectedItem'],
            side_menu_color_default_selected_item: $data['sideMenuColorDefaultSelectedItem'],
            side_menu_color_default_not_selected_icon: $data['sideMenuColorDefaultNotSelectedIcon'],
            side_menu_color_default_selected_icon: $data['sideMenuColorDefaultSelectedIcon'],
            navbar_color_code: $data['navbarColorCode'],
            navbar_icon_color_code: $data['navbarIconColorCode'],
            side_menu_color_code_not_selected_item: $data['sideMenuColorCodeNotSelectedItem'],
            side_menu_color_code_selected_item: $data['sideMenuColorCodeSelectedItem'],
            side_menu_color_code_not_selected_icon: $data['sideMenuColorCodeNotSelectedIcon'],
            side_menu_color_code_selected_icon: $data['sideMenuColorCodeSelectedIcon'],
        );
    }

    public function toArray(): array
    {
        return [
            'navbar_color_default' => $this->navbar_color_default,
            'navbar_icon_color_default' => $this->navbar_icon_color_default,
            'side_menu_color_default_not_selected_item' => $this->side_menu_color_default_not_selected_item,
            'side_menu_color_default_selected_item' => $this->side_menu_color_default_selected_item,
            'side_menu_color_default_not_selected_icon' => $this->side_menu_color_default_not_selected_icon,
            'side_menu_color_default_selected_icon' => $this->side_menu_color_default_selected_icon,
            'navbar_color_code' => $this->navbar_color_code,
            'navbar_icon_color_code' => $this->navbar_icon_color_code,
            'side_menu_color_code_not_selected_item' => $this->side_menu_color_code_not_selected_item,
            'side_menu_color_code_selected_item' => $this->side_menu_color_code_selected_item,
            'side_menu_color_code_not_selected_icon' => $this->side_menu_color_code_not_selected_icon,
            'side_menu_color_code_selected_icon' => $this->side_menu_color_code_selected_icon,
        ];
    }
}
