<?php
namespace App\Services;
use App\Models\SiteSetting;
use Illuminate\Support\Facades\Cache;

class SettingService {
    public static function get($key, $default = null) {
        $settings = Cache::rememberForever('settings_all', function () {
            return SiteSetting::pluck('value', 'key')->all();
        });
        return $settings[$key] ?? $default;
    }

    public static function flush() {
        Cache::forget('settings_all');
    }
}
