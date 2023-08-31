<?php

namespace App\Commons;

class Helpers
{
    public function parseInt(mixed $value)
    {
        return preg_match('/^\d+$/', $value) ? (int) $value : false;
    }

    public function isJson(string $string)
    {
        json_decode($string);
        return json_last_error() === JSON_ERROR_NONE;
    }

    public function coalesce($haystack, $needle, $default = null)
    {
        return optional($haystack)[$needle] ?? optional($haystack)->{$needle} ?? $default;
    }
}
