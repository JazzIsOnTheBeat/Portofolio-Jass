<?php
namespace App\Services;
use App\Models\SiteSetting;
use Illuminate\Support\Facades\Cache;

class SettingService {
    public static function get($key, $default = null) {
        return Cache::rememberForever('setting_' . $key, function () use ($key, $default) {
            $setting = SiteSetting::where('key', $key)->first();
            return $setting ? $setting->value : $default;
        });
    }
}
