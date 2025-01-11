<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\Language;
use App\Models\LegalField;


class CountryController  extends Controller
{
 
    public function getCountries()
    {
        $countries = Country::active()->get();

        return response()->json([
            'success' => true,
            'message' => 'Countries returend successfully.',
            'data' => $countries,
        ]);
    }

    public function getCeties()
    {
        $countries = City::active()->get();

        return response()->json([
            'success' => true,
            'message' => 'Ceties returend successfully.',
            'data' => $countries,
        ]);
    }

    public function getCitiesByCountry($id)
    {
        $cities = City::with('translations')
            ->where('country_id', $id)
            ->active() 
            ->get();

        if ($cities->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'No cities found for this country.',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'cities found for this country.',
            'data' => $cities,
        ]);
    }

    public function getLanguages()
    {
        $languages = Language::active()->get(['id', 'name', 'locale', 'is_activate']);

        $filteredLanguages = $languages->map(function ($language) {
            return [
                'id' => $language->id,
                'name' => $language->getAttributes()['name'], // Fetch raw name from database
                'locale' => $language->locale,
                'is_activate' => $language->is_activate,
            ];
        });

        return response()->json([
            'success' => true,
            'message' => 'Languages returned successfully.',
            'data' => $filteredLanguages,
        ]);
    }

    public function getLegalField()
    {
        $legalFileds = LegalField::active()->get();

        return response()->json([
            'success' => true,
            'message' => 'legalFileds returend successfully.',
            'data' => $legalFileds,
        ]);
    }
}
