<?php

if (!function_exists('safe_icon')) {
    function safe_icon($icon): string {
        if (empty($icon)) return '';
        $icon = trim($icon);

        if (str_starts_with($icon, '<')) {
            if (preg_match('/^<i\s+class\s*=\s*["\'][^"\']*["\'][^>]*><\/i>\s*$/i', $icon)
                && !preg_match('/\son\w+\s*=|javascript:/i', $icon)) {
                return $icon;
            }
            return '';
        }

        if (str_starts_with($icon, 'fa') && preg_match('/^[a-z0-9\-\s]+$/i', $icon)) {
            return '<i class="' . e($icon) . ' text-gold-base"></i>';
        }

        if (str_starts_with($icon, 'bi') && preg_match('/^bi\s+bi-[a-z0-9\-\s]+$/i', $icon)) {
            return '<i class="' . e($icon) . ' text-gold-base"></i>';
        }

        return e($icon);
    }
}