<?php

/**
 * Returns a list of all names of a country.
 * 
 * @param object $country  The country.
 * 
 * @return string[]  An array with names.
 */
function allNames (object $country)
{
    $literals = fn($name) => [ $name->common, $name->official ];
    $names = $literals($country->name);

    if (isset($country->name->nativeName)) {
        foreach ($country->name->nativeName as $lang => $name) {
            array_push($names, ...$literals($name));
        }
    }
    
    return array_unique($names);
}

/**
 * Filters an associative array or object by a list of keys.
 * 
 * @param array|object $obj  The array or object to be filtered.
 * @param string[] $keys  The list of keys.
 * 
 * @return array  An array with the provided keys and matching values from the
 * provided array or object.
 */
function filterKeys (array|object $obj, array $keys)
{
    $result = [];

    foreach ($obj as $key => $value) {

        if (in_array($key, $keys)) {
            $result[$key] = $value;
        }
    }

    return $result;
}

/**
 * Returns a function that can be used with array_filter() to filter a list of
 * countries by their names.
 * 
 * @param string $name  The name to match against.
 * @param bool $fullText  Whether a full match is required or partial matches
 * are accepted. Defaults to false.
 * 
 * @return \Closure(object $country): bool
 */
function matchCountryNames (string $name, bool $fullText=false)
{
    $matchName = function (string $countryName) use ($name, $fullText) {
        return $fullText ?
            strtolower($countryName) == $name :
            str_contains(strtolower($countryName), $name);
    };

    return function (object $country) use ($matchName) {
        foreach (allNames($country) as $name) {
            if ($matchName($name)) return true;
        }
        return false;
    };
}