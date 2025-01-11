<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Models\Lawyer;
use App\Services\NotificationService;
use Illuminate\Support\Facades\DB;

class SearchLawyerController  extends Controller
{
 
    public function getActiveLawyers(Request $request)
    {
        $locale = app()->getLocale(); 

        $arrangeByRate = $request->input('rate', null);

        $lawyersQuery = Lawyer::with(['languages', 'legal_fields' => function ($query) {
            $query->where('is_activate', 1);
        }])
        ->whereIn('type', [1, 3]);

        if ($arrangeByRate !== null) {
            $lawyersQuery->orderBy('rate', 'desc');
        }

        $lawyers = $lawyersQuery->get()->map(function ($lawyer) use ($locale) {
            return [
                'name' => $lawyer->name,
                'email' => $lawyer->email,
                'title' => $lawyer->title,
                'type' => $lawyer->type === 1 ? 'lawyer' : ($lawyer->type === 3 ? 'advisor' : null),
                'rate' => $lawyer->rate,
                'img' => $lawyer->img ? url($lawyer->img) : null,
                'country' => $lawyer->country->name,
                'languages' => $lawyer->languages->map(function ($language) {
                    return $language->getOriginal('name'); 
                }),
                'legal_fields' => $lawyer->legal_fields->map(function ($legalField) use ($locale) {
                    return $legalField->translate($locale)->name; 
                }),
            ];
        });

        return response()->json([
            'success' => true,
            'message' => 'Lawyers retrieved successfully.',
            'data' => $lawyers,
        ]);
    }

    public function getActiveCompanies(Request $request)
    {
        $locale = app()->getLocale(); 

        $arrangeByRate = $request->input('rate', null);

        $companiesQuery = Lawyer::with(['languages', 'legal_fields' => function ($query) {
            $query->where('is_activate', 1);
        }])
        ->where('type', 2);

        if ($arrangeByRate !== null) {
            $companiesQuery->orderBy('rate', 'desc');
        }

        $compaines = $companiesQuery->get()->map(function ($company) use ($locale) {
            return [
                'name' => $company->name,
                'email' => $company->email,
                'title' => $company->title,
                'type' => $company->type === 2 ? 'company' : null,
                'rate' => $company->rate,
                'img' => $company->img ? url($company->img) : null,
                'country' => $company->country->name,
                'languages' => $company->languages->map(function ($language) {
                    return $language->getOriginal('name'); 
                }),
                'legal_fields' => $company->legal_fields->map(function ($legalField) use ($locale) {
                    return $legalField->translate($locale)->name; 
                }),
            ];
        });

        return response()->json([
            'success' => true,
            'message' => 'Companies retrieved successfully.',
            'data' => $compaines,
        ]);
    }

}
