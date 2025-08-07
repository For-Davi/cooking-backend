<?php

namespace App\Services;

use App\DTO\Setting\Appearance\UpdateSettingAppearanceDTO;
use App\Repositories\SettingAppearanceRepository;

class SettingAppearanceService
{
    public function __construct(
        private SettingAppearanceRepository $repository
    ) {}

    public function update($request)
    {
        $appearanceDTO = UpdateSettingAppearanceDTO::fromRequest([
            ...$request->only([
                'navbarColorDefault',
                'navbarIconColorDefault',
                'sideMenuColorDefaultNotSelectedItem',
                'sideMenuColorDefaultSelectedItem',
                'sideMenuColorDefaultNotSelectedIcon',
                'sideMenuColorDefaultSelectedIcon',
                'navbarColorCode',
                'navbarIconColorCode',
                'sideMenuColorCodeNotSelectedItem',
                'sideMenuColorCodeSelectedItem',
                'sideMenuColorCodeNotSelectedIcon',
                'sideMenuColorCodeSelectedIcon',
            ]),
        ]);

        return $this->repository->update($request->get('enterprise_id'), $appearanceDTO->toArray());
    }
}
