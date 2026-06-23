<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Contracts\Repositories\SettingRepositoryInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SettingController extends Controller
{
    public function __construct(
        protected SettingRepositoryInterface $settingRepository,
    ) {}

    public function index(): View
    {
        $settings = [
            'general' => $this->settingRepository->getGroup('general'),
            'contact' => $this->settingRepository->getGroup('contact'),
            'email' => $this->settingRepository->getGroup('email'),
            'seo' => $this->settingRepository->getGroup('seo'),
        ];

        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'settings' => 'required|array',
            'settings.*.key' => 'required|string|max:255',
            'settings.*.value' => 'nullable',
            'settings.*.group' => 'required|string|max:100',
        ]);

        foreach ($validated['settings'] as $setting) {
            $this->settingRepository->setValue(
                $setting['key'],
                $setting['value'],
                $setting['group']
            );
        }

        return redirect()->route('admin.settings.index')
            ->with('success', 'Settings updated successfully.');
    }
}
