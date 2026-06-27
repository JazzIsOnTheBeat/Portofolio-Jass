<?php

if (!function_exists('safe_icon')) {
    function safe_icon($icon): string {
        if (empty($icon)) return '';
        $icon = trim($icon);

        // Raw HTML <i> tag — validate it's clean (no event handlers, only class attr)
        if (str_starts_with($icon, '<')) {
            if (preg_match('/^<i\s+class\s*=\s*["\'][^"\']*["\'][^>]*><\/i>\s*$/i', $icon)
                && !preg_match('/\son\w+\s*=|javascript:/i', $icon)) {
                return $icon;
            }
            return '';
        }

        // Font Awesome class string (fa-brands fa-laravel, fab fa-laravel, etc.)
        if (str_starts_with($icon, 'fa') && preg_match('/^[a-z0-9\-\s]+$/i', $icon)) {
            return '<i class="' . e($icon) . ' text-gold-base"></i>';
        }

        // Bootstrap Icons class string (bi bi-laptop, bi bi-code-slash, etc.)
        if (str_starts_with($icon, 'bi') && preg_match('/^bi\s+bi-[a-z0-9\-\s]+$/i', $icon)) {
            return '<i class="' . e($icon) . ' text-gold-base"></i>';
        }

        // Plain text fallback — escaped
        return e($icon);
    }
}