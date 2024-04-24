<?php

use App\Http\Controllers\CountriesController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

/**
 * TODO: Create a new route for `GET /all` requests.
 * Send requests to the `allCountries` method from the `CountriesController`.
 */
// ...

/**
 * TODO: Create a new route for `GET /name/{name}` requests.
 * Send requests to the `countriesByName` method from the `CountriesController`.
 */
// ...