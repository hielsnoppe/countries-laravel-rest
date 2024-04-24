<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CountriesController extends Controller
{
    /**
     * @var array $countries  A list of countries.
     */
    private array $countries;

    public function __construct ()
    {
        /**
         * INFO: This loads all countries from the
         * `/storage/app/countries.json` file and saves them in the `countries`
         * property.
         * In methods you can access the property as $this->countries.
         */
        $json = Storage::disk('local')->get('countries.json');
        $this->countries = json_decode($json);
    }

    /**
     * Reads the `fields` query string parameter from `$request` and returns an
     * array of strings by splitting the contained value at the `,` character.
     */
    private static function getFields (Request $request)
    {
        return explode(',', $request->query('fields'));
    }

    /**
     * Reads the `fullText` query string parameter from `$request` and returns
     * its boolean value.
     */
    private static function getFullText (Request $request): bool
    {
        return filter_var($request->query('fullText'), FILTER_VALIDATE_BOOL);
    }

    /**
     * TODO: Implement this method by completing the tasks marked as TODO.
     */
    public function allCountries (Request $request)
    {
        /**
         * TODO: Use the static self::getFields() method to get the value of
         * the `fields` query string parameter.
         */
        $fields = []; // Change this!

        /**
         * INFO: This function can be used with array_map() to filter a list of
         * countries by their names.
         */
        $filterKeys = function ($country) use ($fields) {
            return filterKeys($country, $fields);
        };

        /**
         * TODO: Use the array_map() function to apply the $filterKeys function
         * from above to $this->countries.
         */
        $countries = []; // Change this!

        /**
         * TODO: Return a response containing the $countries as JSON.
         */
        return null; // Change this!
    }

    /**
     * TODO: Implement this method by completing the tasks marked as TODO.
     */
    public function countriesByName (Request $request, string $name)
    {
        /**
         * TODO: Use the static self::getFullText() method to get the value of
         * the `fullText` query string parameter.
         */
        $fullText = false; // Change this!

        /**
         * INFO: matchCountryNames() returns a function that can be used with
         * array_filter() to filter a list of countries by their names.
         */
        $matchNames = matchCountryNames($name, $fullText);

        /**
         * TODO: Use the array_filter() function to filter $this->countries
         * using the $matchNames function from above.
         */
        $countries = []; // Change this!

        /**
         * INFO: We need this in order to re-index the array after filtering.
         * Otherwise, JSON would encode this as an object instead as an array.
         */
        $countries = array_values($countries);

        /**
         * TODO: Return a response containing the $countries as JSON.
         */
        return null; // Change this!
    }
}
