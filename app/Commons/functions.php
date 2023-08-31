<?php

namespace App\Commons;

$singletons = [];

$isset = function (string $name) use ($singletons) {
    if (isset($singletons['helpers']) && $singletons['helpers'] instanceof Helpers) {
        $helpers = $singletons['helpers'];
    } else {
        $helpers = $singletons['helpers'] = new Helpers;
    }

    if (isset($singletons[$name])) {
    }
};

/**
 * @return \App\Commons\Helpers
 */
function helpers()
{
    if (isset($singletons['helpers']) && $singletons['helpers'] instanceof Helpers) {
        return $singletons['helpers'];
    }

    return $singletons['helpers'] = new Helpers;
}

function parseInt($value)
{
    return helpers()->parseInt($value);
}

function isJson(string $string)
{
    return helpers()->isJson($string);
}

/**
 * @param mixed $haystack
 * @param mixed $needle
 * @param mixed $default
 * @return mixed
 */
function coalesce()
{
    return helpers()->coalesce(...func_get_args());
}
